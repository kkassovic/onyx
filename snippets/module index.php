<?php

//If isset POST
if(isset($_POST['submit'])) 
    {
    // Form Submitted
    }

else
{
    $hdnavi_array ="";
    $top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/app/03_predaj/03_predaj_navi.html";
    $pagetitle = "Predaj";
    // Must pass in variables (as an array) to use in template
    $variables = array(
        'pagetitle' => $pagetitle,
        'hdnavi_def' => $hdnavi_array,
        'no_login' => FALSE,
        'image' => "/img/predaj.jpg",
        'header' => "Modul predaj",
        'hdnavi_html' => $top_nav_file);

    renderLayout2 ("/commons/modul_view.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);
}

?>
