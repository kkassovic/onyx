<?php

function router ($rts, $pt)
{
    foreach ($rts as $r)
    {
        if ($pt == $r[0] OR $pt == $r[0] . "/")
        {
                require $r[1];
                return false; //function stop
        }
    }
    if (file_exists ($_SERVER[ 'DOCUMENT_ROOT'] . $pt)) {require $_SERVER[ 'DOCUMENT_ROOT'] . $pt;}
    else {require PAGE404;}
}


function show_err ($status)
{
   
    if ($status == TRUE)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        //error_reporting(E_ERROR);
        error_reporting(E_ALL);
    }
    
    else {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(E_ALL);
    }

}

function chceck_user()
{

    if (isset($_COOKIE[APP_COOKIE]))
    {
        $cookie = $_COOKIE[APP_COOKIE];
        $xdata = new sqldata();
        $xdata->sql_query = "SELECT validity FROM logins WHERE cookie_value = '$cookie'";
        $cookie_db = $xdata-> get_sql_onefigure_data('validity');
        if (isset($cookie_db)) {$platnost = $cookie_db;}
    }
    else
    {
        $platnost = NULL;
    }
    
    
    $now = date("Y-m-d H:i:s");
    
    //ak áno - aká je platný?
    if ($now < $platnost) 
    {
        //ak áno session ID set
        $xdata = new sqldata();
        $xdata->sql_query = "SELECT * FROM logins WHERE cookie_value = '$cookie'";
        $cookie_db = $xdata-> get_sql_row_data();
    
        //session_start();
        $_SESSION["userId"] = strtolower($cookie_db['user']);
        $user = $_SESSION["userId"];
    
        $xdata = new sqldata();
        $xdata->sql_query = "SELECT * FROM users WHERE user_id = '$user'";
        $email = $xdata-> get_sql_row_data("email");
        $email_adresa = $email["email"];
        $_SESSION["userEmail"] = $email_adresa;
    
        $sql = "SELECT full_name FROM users WHERE user_id = '$user'";
        $xdata = new sqldata();
        $xdata->sql_query = $sql;
        $meno = $xdata->get_sql_onefigure_data("full_name");
        $_SESSION["user_name"] = $meno;
    }
    
    else
    {
        session_destroy(); //destroy the session
        header("Location: " . "/no-login");
        //die ("Nie ste prihlásený.");
    }

}


function login_process($user, $password)
{

        //Skontrolovať heslo
        $xdata = new sqldata();
        $xdata->sql_query = "SELECT pwd FROM users WHERE user_id = '$user'";
        $heslo_db = $xdata-> get_sql_onefigure_data ("pwd");



        if ($heslo_db === $password)
        {
            //vygenerovať PIN a login id
            $pin = rand(1000,9999);
            $login_id = rand (1000000,9999999);

            //Uložiť PIN a login id do DB
            $xdata = new sqldata;
            $xdata->sql_query = "INSERT INTO login_pin (user, login_id, pin) 
                VALUES ('$user', '$login_id', '$pin')";
            $vysledok = $xdata->save_sql_data();


            //Vytvoriť cookie
            $cookie_name = APP_COOKIE;
            $db_token = rand(100000,999999);
            $cookie_value = APP_COOKIE . $db_token;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

            //Vypočítať platnosť cookie + 30 dní
            $now = date('Y-m-d H:i:s');
            $date = new DateTime($now);
            $date->add(new DateInterval('P30D'));
            $validity = $date->format('Y-m-d H:i:s');

            //Uložiť zznam do denníka prihlásení
            include_once $_SERVER[ 'DOCUMENT_ROOT'] . "/vendor/donatj/phpuseragentparser/src/UserAgentParser.php";
            $ua_info = parse_user_agent();

            $zariadenie = $ua_info['platform'];
            $prehliadac = $ua_info['browser'] . " " . $ua_info['version'];
            $xdata = new sqldata;
            $xdata->sql_query = "INSERT INTO logins (user, cookie_name, cookie_value, validity, zariadenie, prehliadac) 
                VALUES ('$user', '$cookie_name', '$cookie_value', '$validity', '$zariadenie', '$prehliadac')";
            $vysledok = $xdata->save_sql_data();

            //NAstaviť super-globals
            $_SESSION["userId"] = strtolower($user);
            $usr = $_SESSION["userId"];

            //A zobrazí sa stránka že všetko je ok
            $sql = "SELECT full_name FROM users WHERE user_id = '$usr'";
            $xdata = new sqldata();
            $xdata->sql_query = $sql;
            $meno = $xdata->get_sql_onefigure_data("full_name");
            $_SESSION["user_name"] = $meno;

            return(TRUE);
        }
        else
        {
            return (FALSE);
        }


}

function user_bahavior ($app_name, $app_version)
{
    $user = $_SESSION["userId"];

    $client = "";
    $forward = $_SERVER['SERVER_NAME'];

    $remote = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER ['HTTP_USER_AGENT'];
    $program = basename($_SERVER['SCRIPT_NAME']);

    $url = $_SERVER['REQUEST_URI'];
    $uri = parse_url($url, PHP_URL_PATH);

    $sql = "
    INSERT INTO user_behavior 
    (app_name, uri, user, program, client, forward, remote, user_agent, app_version)
     VALUES ('$app_name', '$uri', '$user', '$program', '$client', '$forward', '$remote', '$agent', '$app_version')";
    $xdata = new sqldata();
    $xdata->sql_query = $sql;
    $xdata->save_sql_data();

}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class email_wrap
{
    public $body;
    public $subject;
    public $footer;
    public $mail_module;
    public $config_file;
    public $autor;

    public function send_mail()
    {
        $mail = new PHPMailer(true);
    try {

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            include $this -> config_file;

            //Recipients PDO
            try {
                    $servername = DB_HOST;
                    $database = DB_NAME;
                    $conn = new PDO("mysql:host=$servername;port=3306;charset=UTF8;dbname=$database", DB_USER, DB_PASSWORD);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // prepare sql and bind parameters
                    $stmt = $conn->prepare(SQL_PDO_EMAIL_ADDRESS);
                    $stmt->bindParam(':trn', $this -> mail_module);
                    $stmt->execute();
                    $dist = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                } //try
                catch(PDOException $e) 
                {
                    echo "Error: " . $e->getMessage() . "<br>";
                } //catch
            $conn = null;

            foreach ($dist AS $d)
            {
                $recipient .= $d['email'] . ", ";
                switch ($d['to_cc_bcc'])
                {
                    case "to":
                        $mail->addAddress($d['email']);
                        break;
                    case "cc":
                        $mail->addCC($d['email']);
                        break;
                    case "bcc":
                        $mail->addBCC($d['email']);
                        break;
                } // switch
            } //foreach

            //Autor email
            if (isset ($this -> autor )) 
                {
                    $mail->addCC($this -> autor);
                    $recipient .= $this -> autor . ", ";
                }
            

            // Content
            $mail->Subject = $this -> subject;
            $work_body = $this -> body;
            $work_body .= file_get_contents ($this -> footer);
            $mail->Body = $work_body;

            $mail->send();

            $mail_status = 'Message has been sent.';
        } //try
            catch (Exception $e) 
            {
                $mail_status =  "Mailer Error: {$mail->ErrorInfo}";
            } // catch

        //Mail log
        $servername = DB_HOST;
        $database = DB_NAME;
        $conn = new PDO("mysql:host=$servername;port=3306;charset=UTF8;dbname=$database", DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO mail_log (trn, mail_status, recipient, zaznamenal, smtp_server, sender_email) VALUES (:trn, :mail_status, :recipient, :autor, :smtp, :frm)");
        $stmt->bindParam(':trn', $d['trn']);
        $stmt->bindParam(':mail_status', $mail_status);
        $stmt->bindParam(':recipient', $recipient);
        $stmt->bindParam(':autor', $_SESSION["userId"]);
        $host = E_HOST;
        $stmt->bindParam(':smtp', $host);
        $from = E_FROM_MAIL;
        $stmt->bindParam(':frm', $from);

        $stmt->execute();
        $conn = null;

        return $mail_status;
    } // public function

} //class email wrap
?>