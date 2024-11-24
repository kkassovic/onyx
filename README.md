# Onyx
Onyx triedy (model a visual)

## Model

    $sql = "SELECT * FROM table";
    $xdata = new sqldata();
    $xdata->sql_query = $sql;
    $datatable = $xdata->get_sql_data();
    $rowdata = $xdata->get_sql_row_data();
    $figure = $xdata->get_sql_onefigure_data("sql_field_name");

## Render

    $variables = array(
            'pagetitle' => "Page title",
            'hdnavi_html' => "top_nav.php",
            'no_login' => FALSE,
            'sql' => $sql,
            'form_action' => $_SERVER["PHP_SELF"]);
    renderLayout2 ("/commons/insert_success_view.php", APP_TEMPLATE_FILE, APP_LAYOUT_FILE, $variables);

## View - Form dropdown

    <?php
    $drp_data = new sqldata();
    $drp_data->sql_query = "SELECT ID, sposob_oslovenia from typ_navstevy";
    $drp_data_result = $drp_data->get_sql_data();
    
    $drp = new purecss_form_control();
    $drp->label = "Spôsob";
    $drp->name = "sposob_oslovenia";
    $drp->id = "sposob_oslovenia";
    $drp->help_block = "Navštívená osoba 1";
    $drp->dd_value = array_column($drp_data_result, 'ID');
    $drp->dd_display = array_column($drp_data_result, 'sposob_oslovenia'); //array("Volvo", "BMW", "Toyota");
    $drp->required = TRUE;
    echo $drp->show_drop();
    ?>

## View - Form field

    <?php
    $item = new purecss_form_control();
    $item->label = "POS";
    $item->name = "ID_POS";
    $item->type = "number";
    $item->input_value = $pos;
    $item->required = true;
    $item->readonly = true;
    $item->hidden = true;
    $item->help_block = "Vyplňte v prípade...";
    echo $item->show_input();
    ?>

## HTML Form example

    <form action="<?php echo $form_action;?>"
    class="pure-form pure-form-aligned"
    enctype="multipart/form-data"
    id="formular"
    method="post">
    
    <fieldset>
        <legend>Miesto</legend>
    </fieldset>

    <fieldset>
        <legend>Produkty a ceny</legend>
    </fieldset>

    <br>

    <button class="pure-button pure-button-primary"
            type="submit"
            name="submit"
            id="submitID">
            Zaznamenať
    </button>
    <p hidden id="oznam">Pracujeme na tom...</p>
    </form>

    <script>
        //Script to prevent double form submission
        var form = document.getElementById('formular');
        var submitButton = document.getElementById('submitID');
        var oznamtext = document.getElementById('oznam');
        form.addEventListener('submit', function()
        {
            submitButton.setAttribute('hidden', 'hidden');
            submitButton.innerHTML = 'Pracujeme na tom...';
            oznamtext.removeAttribute('hidden');
        }, false);
    </script>

#New ONYX

## Email wrapper

        $m = new email_wrap();
        $m->body = $mailmessage;
        $m->subject = "Pohľadávka č. " . $id;
        $m->footer = "template/mail_footer.html";
        $m->config_file = TEMPLATE_DIR . "/mail_config.php";
        $m->mail_module = "POHLADAVKY_POZNAMKA";
        $m->autor = $autor_email;
        $m->send_mail();
