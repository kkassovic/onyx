<?php
$vysledok = [];
$dni = $_REQUEST['d'];

$supermat = $_REQUEST['supermat'];
$navi_mat = $_REQUEST['navi_mat'];
$box = $_REQUEST['box'];

// Form Submitted ?
if(isset($_POST['submit']))
{
   //Zmazať všetky supermateriály z tab zasoby_super
    $sql = "DELETE FROM zasoby_super WHERE super_mat_kod = $supermat";
    $xdata = new sqldata();
    $xdata->sql_query = $sql;
    $xdata->save_sql_data(); //UPDATE!

   //znova ich zapísať
   for ($x = 0; $x < count($box); $x++) 
   {
        $sql = "INSERT INTO zasoby_super (super_mat_kod, navi_mat) VALUES ('$supermat', '$box[$x]')";
        $xdata = new sqldata;
        $s .= $sql . "<br>";
        $xdata->sql_query = $sql;
        $vysledok = $xdata->save_sql_data();
   }

   //echo $s;
   //die;

   $pagetitle = "Supermateriál - priradenie";
   $top_nav_file = "/app/18_plan/18_plan_navi.html";
   $variables = array(
       'pagetitle' => $pagetitle,
       'hdnavi_def' => $hdnavi_array,
       'hdnavi_html' => $top_nav_file,
       'message' => $message,
       'no_login' => FALSE,
       //'form_action' => $_SERVER["PHP_SELF"]);
   );
   
   renderLayout2 ("/commons/insert_success_view.php", SKINS_DIR . "/purecss_view_template_1.php", APP_LAYOUT_FILE, $variables);

}

//Form not submitted
else
{
    //zoznam materiálu
    $sql = "SELECT zasoby.*, SUM (zasoby_ks) AS kusy, COUNT (zasoby_super.ID) AS pocet, zasoby_super_lut.super_kategoria AS super_mat
    FROM zasoby
    LEFT JOIN zasoby_super ON zasoby_super.navi_mat = zasoby.cislo_zasob AND zasoby_super.super_mat_kod = $supermat
    LEFT JOIN zasoby_super_lut ON zasoby_super_lut.ID = zasoby_super.super_mat_kod
    GROUP BY cislo_zasob";
    $xdata = new sqldata();
    $xdata->sql_query = $sql;
    $zasoby = $xdata->get_sql_data();

    $sql = "SELECT super_kategoria, ID, thn FROM zasoby_super_lut WHERE ID = $supermat";
    $xdata = new sqldata();
    $xdata->sql_query = $sql;
    $supermat = $xdata->get_sql_row_data();

    $pagetitle = "Supermateriál - definícia";
    $top_nav_file = "/app/18_plan/18_plan_navi.html";
    $variables = array(
        'pagetitle' => $pagetitle,
        'hdnavi_def' => $hdnavi_array,
        'hdnavi_html' => $top_nav_file,
        'no_login' => FALSE,
        //'form_action' => $_SERVER["PHP_SELF"],
        'datum_inventury' => $datum_inventury,
        'kapa' => $kapa,
        'super_cislo' => $super_cislo,
        'supermat' => $supermat,
        'zasoby' => $zasoby);
    
    renderLayout2 ("/app/18_plan/super_view.php", SKINS_DIR . "/purecss_view_template_1.php", APP_LAYOUT_FILE, $variables);
}
?>
