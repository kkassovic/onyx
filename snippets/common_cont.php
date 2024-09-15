<?php

//Input vars a data pre SQL query
if (!isset($_REQUEST['var'])) {$var = "%";} else {$var = $_REQUEST['var'];}

// Form Submitted ?
if(isset($_POST['submit']))
{
    $top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/app/12_DOXX/12_doxx_navi.html";
    $pagetitle = "Odovzdanie DOOX poukážok";
    $datum = $_REQUEST['datum'];

    $odovzdal  = $_POST["odovzdal"];
    $prijal = $_POST["prijal"];
    $datum  = $_POST["datum"];
    $hodnota  = $_POST["hodnota"];
    $poznamka = $_POST["poznamka"];

    $autor = $_SESSION["userId"];

    //SQL zápis
    $sql = "
    INSERT INTO listky (odovzdal, prijal, hodnota,
    datum, poznamka, zaznamenal) 
       
       VALUES ('$odovzdal', '$prijal', '$hodnota', '$datum', '$poznamka', '$autor')
    ";
    $xdata = new sqldata();
    $xdata->sql_query = $sql;
    $xdata->save_sql_data();

    $variables = array(
        'pagetitle' => $pagetitle,
        'hdnavi_html' => $top_nav_file,
        'no_login' => FALSE,
        'sql' => $sql,
        'form_action' => $_SERVER["PHP_SELF"]);

    renderLayout2 ("/commons/insert_success_view.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);

}

//Form not submitted
else
{
    $top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/app/12_DOXX/12_doxx_navi.html";
    $pagetitle = "Odovzdanie DOXX poukážok";

    $variables = array(
        'pagetitle' => $pagetitle,
        'hdnavi_html' => $top_nav_file,
        'no_login' => FALSE,
        //'form_action' => $_SERVER["PHP_SELF"],
        'sql' => $sql);

    renderLayout2 ("/app/12_DOXX/odovzdanie_form.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);

}
?>