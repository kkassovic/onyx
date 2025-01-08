<?php 
  $counter_t = 0;
  $counter_l = 0;
  if(!isset($column_order)){$column_order = "[[0, 'desc']]";}
?>

<h2 class="content-subhead"><?php echo $pagetitle;?></h2>

<?php echo $page_sub_title;?>

<table id="datova_tabulka" class="pure-table pure-table-bordered">
	<thead>
		<tr>
        <?php foreach($headers as $head):?>
			<th><?php echo $head;?></th>
        <?php endforeach;?>
		</tr>
	</thead>
    
	<tbody>
    <?php foreach($tabdata as $row ):?>
      <tr>
          <?php foreach($mysql_columns as $col ):?>
            <td align="<?php echo $alignment[$counter_l++];?>"><?php echo $row[$col];?></td>
          <?php endforeach;?>
          <?php $counter_l = 0;?>

          <!-- Action buttons -->
          <td align="left"><?php echo $action[$counter_t++];?></td>

      </tr>
    <?php endforeach;?>
	</tbody>
</table>

<br>
<br>

<!-- <strong>SQL query:</strong>
<?php echo $sql_qry;?><br>
<strong>Headers:</strong>
<?php print_r($headers);?><br>
<strong>MySQL columns:</strong>
<?php print_r($mysql_columns);?><br> -->



<script type="text/javascript" class="init">
    $(document).ready(function()
    {
    console.log("pause");
      $.fn.dataTable.moment( 'DD-MMM-YYYY' );
      $('#datova_tabulka').DataTable(
        {
        language: {url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/sk.json'},
        searchPanes:
        {
          cascadePanes: true,
          viewTotal: true
        },
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Všetko"]],
        fixedHeader: true,
        colReorder: true,
        iDisplayLength: 50,
        order: <?php echo $column_order;?>,
        columnDefs:
          [
            {
                searchPanes:{show: false},
                targets: <?php echo $search_panes_targets;?>, // Index of columns (starting at 0) that you want show/hide
            },
            <?php if (isset($col_hide)) {echo "{target: $col_hide, visible: false, searchable: true},";}?>
          ],
        buttons: [ 'searchPanes' ],
        <?php if (isset($row_group)) {echo $row_group;}?>
        dom: 'Plfrtip'
        });
    });
  </script>