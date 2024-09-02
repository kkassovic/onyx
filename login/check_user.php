<?php

//vyhľadať cookie


//Pozrieť do DB či existuje
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

?>