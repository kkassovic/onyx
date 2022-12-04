<?php
//Povinné
include $_SERVER[ 'DOCUMENT_ROOT'] . "/template/config.php";
include TEMPLATE_DIR . "/source/controller_include_files.php";

//Input vars a data pre SQL query
$ID = $_REQUEST["navi_kod"];
$autor = $_SESSION["userId"];
if (!isset($_REQUEST['var'])) {$var = "%";} else {$var = $_REQUEST['var'];}

//Navigácia
$top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/app/01_info/01_info_navi.html";
$pagetitle = "Informácie";


$variables = array(
    'pagetitle' => $pagetitle,
    'hdnavi_html' => $top_nav_file,
    'no_login' => FALSE,
    'form_action' => $_SERVER["PHP_SELF"],
    'navi_kod' => $ID,
    'oblast' => $oblast,
    'oblast_id' => $oblast_id);

renderLayout2 ("/app/01_info/index_view.php",
                    SKINS_DIR . "/purecss_view_template_1.php",
                    APP_LAYOUT_FILE_2,
                    $variables);
?>
