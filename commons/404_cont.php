<?php

//Input vars a data pre SQL query
if (!isset($_REQUEST['var'])) {$var = "%";} else {$var = $_REQUEST['var'];}

// Form Submitted ?
if(isset($_POST['submit']))
{
  
}

//Form not submitted
else
{
    $top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/topnav.php";
    $pagetitle = "Stránka sa nenašla";

    $variables = array(
        'pagetitle' => $pagetitle,
        'hdnavi_html' => $top_nav_file,
        'no_login' => FALSE);

    renderLayout2 ("/commons/404_view.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);
}
?>