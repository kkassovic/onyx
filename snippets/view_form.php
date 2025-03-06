<form action="<?php echo $form_action;?>"
	class="pure-form pure-form-aligned"
	enctype="multipart/form-data"
        id="formular"
	method="post">
        <fieldset>
        <legend><i class="material-icons">factory</i>Miesto</legend>
            <?php
                $item = new purecss_form_control();
                $item->label = "POS";
                $item->name = "ID_POS";
                $item->type = "number";
                $item->input_value = $pos;
                $item->required = true;
                $item->readonly = true;
                $item->hidden = true;
                //$item->help_block = "Vyplňte v prípade doporučenej objednávky (všetky produkty dohromady)";
                echo $item->show_input();
            ?>

                <?php
                //Dáta pre element "dropdown"
                $drp_data = new sqldata();
                $drp_data->sql_query = "SELECT ID, sposob_oslovenia from typ_navstevy";
                $drp_data_result = $drp_data->get_sql_data();
                //$cars = array("Volvo", "BMW", "Toyota");
                $drp = new purecss_form_control();
                $drp->label = "Spôsob";
                $drp->name = "sposob_oslovenia";
                $drp->id = "sposob_oslovenia";
                //$drp->help_block = "Navštívená osoba 1";
                $drp->dd_value = array_column($drp_data_result, 'ID'); //alebo natvrdo pole s hodnotami: array("VO", "BM", "TO");
                $drp->dd_display = array_column($drp_data_result, 'sposob_oslovenia'); //alebo natvrdo pole s hodnotami: array("Volvo", "BMW", "Toyota");
                $drp->required = TRUE;
                echo $drp->show_drop();
                ?>
        </fieldset>


        <fieldset>
        <legend>Produkty a ceny</legend>

        <?php
        $xdata = new sqldata();
        $sql = "SELECT ID, nazov FROM produkty_ext";
        $xdata->sql_query = $sql;
        $tabdata = $xdata->get_sql_table_data();
        ?>

        <table id="datova_tabulka" class="pure-table pure-table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produkt</th>
                    <th>BNC</th>
                    <th>ANC (LA)</th>
                    <th>LA Od</th>
                    <th>LA Do</th>
                    <th>DNC</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($tabdata as $row ):?>
                <tr>
                    <td align="left">
                        <input readonly id="id" name="id[]" placeholder="" type="text" value="<?php echo $row['ID'];?>">
                    </td>
                    <td align="left">
                        <input readonly id="produkt" name="produkt[]" placeholder="" type="text" value="<?php echo $row['nazov'];?>">
                    </td>
                    <td align="left">
                        <input id="bnc" name="bnc[]" placeholder="" type="number" step="0.01">
                    </td>
                    <td align="left">
                        <input id="anc" name="anc[]" placeholder="" type="number" step="0.01">
                    </td>
                    <td align="left">
                        <input id="od" name="anc_od[]" placeholder="" type="date">
                    </td>
                    <td align="left">
                        <input id="do" name="anc_do[]" placeholder="" type="date">
                    </td>
                    <td align="left">
                        <input id="dnc" name="dnc[]" placeholder="" type="number" step="0.01">
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

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
