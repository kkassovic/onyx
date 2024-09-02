<?php

// Najprv sa zobrazí HTML formulár, prípadne ak toto nie je "formulárová stránka" tak sa natiahnu údaje z SQL a pošlú sa do VIEW
    if(!isset($_POST['submit']))
    {

        $pagetitle = "Prihlásenie";
        //$top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/login/topnav.php";

        $variables = array(
            'pagetitle' => $pagetitle,
            'hdnavi_def' => $top_nav_file,
            'hdnavi_html' => $top_nav_file,
            'no_login' => TRUE,
            'form_action' => $_SERVER["PHP_SELF"]); // Prvé 4 (pagetitle/dhnavi/no_login / form_action) - nie je dôvod veľmi meniť
        
        //Zobraziť VIEW...
        renderLayout2 ("/login/login_form.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);

    }

//Keď úžívateľ "submitol" formulár tak sa spracujú údaje z neho - zvyčajne sa uložia do sql tabuľky, pošla sa notifikačný mail a podobne
    else
    {
        //Vstupné premenné (napr. údaje z HTML formuláru, kód prihláseného užívateľa a pod.)
        //Čím viac chlievikov v HTML formulári - tým dlhší tento zoznam
        $user = strtolower($_REQUEST["user"]);
        $password = $_POST["password"];
        
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

            //Uložiť do DB
            include_once $_SERVER[ 'DOCUMENT_ROOT'] . "/vendor/donatj/phpuseragentparser/src/UserAgentParser.php";
            $ua_info = parse_user_agent();

            $zariadenie = $ua_info['platform'];
            $prehliadac = $ua_info['browser'] . " " . $ua_info['version'];
            $xdata = new sqldata;
            $xdata->sql_query = "INSERT INTO logins (user, cookie_name, cookie_value, validity, zariadenie, prehliadac) 
                VALUES ('$user', '$cookie_name', '$cookie_value', '$validity', '$zariadenie', '$prehliadac')";
            $vysledok = $xdata->save_sql_data();

            //Zmazať PIN z pin DB
            //session_start();
            $_SESSION["userId"] = strtolower($user);
            $usr = $_SESSION["userId"];

            //A zobrazí sa stránka že všetko je ok
            $sql = "SELECT full_name FROM users WHERE user_id = '$usr'";
            $xdata = new sqldata();
            $xdata->sql_query = $sql;
            $meno = $xdata->get_sql_onefigure_data("full_name");
            $_SESSION["user_name"] = $meno;

            header("Location: " . "/");

            $hdnavi_array ="";
            //$top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/topnav.php";
            $pagetitle = "Úspešne prihlásený";
            $variables = array(
                'pagetitle' => $pagetitle,
                'hdnavi_def' => $hdnavi_array,
                'hdnavi_html' => $top_nav_file,
                'meno' => $meno,
                'no_login' => TRUE);
            renderLayout2 ("/login/login_ok_view.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);
        }

    else
    {
        //A zobrazí sa stránka - zlé heslo
        $hdnavi_array ="";
        //$top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/topnav.php";
        $pagetitle = "Nová žiadanka";
        $variables = array(
            'pagetitle' => $pagetitle,
            'hdnavi_def' => $hdnavi_array,
            'hdnavi_html' => $top_nav_file,
            'user' => $user,
            'password' => $password,
            'heslo_db' => $heslo_db,
            'no_login' => TRUE);
        renderLayout2 ("/login/login_problem_view.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);
    }}
?>
