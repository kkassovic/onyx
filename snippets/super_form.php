<form action="<?php //echo $form_action;?>"
	class="pure-form pure-form-aligned"
	enctype="multipart/form-data"
        id="formular"
	method="post">
        <fieldset>
        <legend>Supermateriál</legend>
        <input hidden readonly id="default" type="number" value="<?php echo$supermat['ID'];?>"/>

        </fieldset>

        <h2><?php echo $supermat['super_kategoria'];?></h2>
        <fieldset>
        <legend>Priradené navision materiály</legend>

        <table id="datova_tabulka" class="pure-table pure-table-bordered">
            <thead>
                <tr>
                    <th>CB</th>
                    <th>Navi kód</th>
                    <th>Názov</th>
                    <th>Aktuálne množstvo</th>
                    <th>Super počet</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($zasoby as $z):?>

            <?php
                if ($z['pocet'] >= 1) {$c = "checked";} else {$c = "";}
            ?>

                <tr>
                    <td align="left">
                        <input value="<?php echo $z['cislo_zasob']?>" name="box[]" <?php echo $c;?> id="default" type="checkbox"/>
                    </td>
<!--                     <td align="left">
                      <input readonly name="navi_mat[]" value="<?php echo $z['cislo_zasob']?>" id="default" type="text"/>
                    </td> -->
                    <td align="left">
                        <?php echo $z['cislo_zasob'];?>
                    </td>
                    <td align="left">
                        <?php echo $z['popis_zasob'];?>
                    </td>
                    <td align="left">
                        <?php echo $z['kusy'];?>
                    </td>
                    <td align="left">
                        <?php echo $z['pocet'];?>
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


<?php include $_SERVER[ 'DOCUMENT_ROOT'] . "/skins/pure/datatable_cdn_new.html";?>

<script>

//DataTable.datetime('D MMM YYYY');

new DataTable("#datova_tabulka", {
  language: {
    url: "https://cdn.datatables.net/plug-ins/2.1.8/i18n/sk.json"
  }, //language
  paging: false,
  order: [[0, 'desc']],
  layout: {
    top1: "searchPanes",
    topStart: {
      buttons: [
        {
          extend: "excelHtml5",
          title: "Data export",
          autoFilter: true,
          sheetName: "Exported data",
          messageTop:
            "The information in this table is copyright to Sirius Cybernetics Corp."
        },
        {
          extend: "pdfHtml5",
          title: "Data export"
        }
      ] //buttons
    } //topstart
  }, //layout

  searchPanes: {
    columns: [2]
  } //searchpanes
}); //datatable

</script>
