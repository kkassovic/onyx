<?php

$top_nav_file = $_SERVER[ 'DOCUMENT_ROOT'] . "/app/05_ceny/05_ceny_navi.html";
$pagetitle = "Pagetitle";

//Data prepare
$sql = " ";
$xdata = new sqldata();
$xdata->sql_query = $sql;
$datatodisp = $xdata->get_sql_data();

//Formát dátumov
foreach ($datatodisp as &$v) 
    {
        $v['datum_od']=date_format(date_create($row['datum_od']), "d-M-Y");
    }

//Action button
$action = array();
foreach($datatodisp as $row):
    $id_l = $row["laid"];
    $actionbuttons = array
        (
            array ("disp"=>"Zobraziť",
            "ref"=>"/ceny/detail?"),

            array ("disp"=>"Vytlačiť - PDF",
            "ref"=>"/ceny/pdf?"),

            array ("disp"=>"XML data",
            "ref"=>"/ceny/xml?")
        );

    $linkdisp = new purecss_actbutton();
    $linkdisp->buttonarray = $actionbuttons;
    $linkdisp->target_index = $row['ID_link'];
    $linkdisp->requestfield = "link";
    $xdata = $linkdisp->show_action_drop_single();
    array_push($action, $xdata);
endforeach;
    
$mysql_columns = array (
    "ID",
    "cenova_skupina",
    "nazov",
    "datum_od",
    "popis"
);

$headers = array (
    "Číslo zákazníka",
    "Cenová skupina",
    "Zákazník",
    "Platný od",
    "Akcia"
);

$alignment = array (
    "right",
    "left",
    "left",
    "left",
    "right"
);

// Must pass in variables (as an array) to use in template
$variables = array(
    'pagetitle' => $pagetitle,
    'hdnavi_def' => $hdnavi_array,
    'hdnavi_html' => $top_nav_file,
    'vysledok' => $vysledok,
    'tabdata' => $datatodisp,
    'headers' => $headers,
    'mysql_columns' => $mysql_columns,
    'alignment' => $alignment,
    'search_panes_targets' => "[0,3,4,5,7,8]",
    'column_order' => "[[ 0, 'desc' ]]",
    'action' => $action);

renderLayout2 ("/commons/s_table_page_view.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);

?>
