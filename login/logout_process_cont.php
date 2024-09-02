<?php
    //include_once $_SERVER[ 'DOCUMENT_ROOT'] . "/template/config.php";

    //zmazať cookie v DB
    $zmazat = $_COOKIE[APP_COOKIE];
    $xdata = new sqldata;
    $xdata->sql_query = "DELETE FROM logins WHERE cookie_value ='$zmazat'";
    $vysledok = $xdata->save_sql_data();

    //zmazať cookoie v prehliadači
    setcookie(APP_COOKIE, "", time() - (86400 * 3));
    unset ($_COOKIE[APP_COOKIE]);

    //zmazať seesion
    session_destroy(); //destroy the session

    //prejisť na hlavnú stránku
    header("Location: " . "/"); //app z config.php
?>