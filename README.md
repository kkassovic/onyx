# Onyx
Onyx triedy (model a visual)

## Model

    $sql = "SELECT * FROM table";
    $xdata = new sqldata();
    $xdata->sql_query = $sql;
    $datatable = $xdata->get_sql_data();
    $rowdata = $xdata->get_sql_row_data();
    $figure = $xdata->get_sql_onefigure_data("sql_field_name);

## Render

    $variables = array(
            'pagetitle' => "Page title",
            'hdnavi_html' => "top_nav.php",
            'no_login' => FALSE,
            'sql' => $sql,
            'form_action' => $_SERVER["PHP_SELF"]);
    renderLayout2 ("/commons/insert_success_view.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);
