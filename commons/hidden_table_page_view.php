<?php 
  $counter_t = 0;
  $counter_l = 0;
?>

<h2 class="content-subhead"><?php echo $pagetitle;?></h2>

<div id="output" style="margin: 30px;"></div>

<table hidden id="datova_tabulka" class="pure-table pure-table-bordered">
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

<strong>SQL query:</strong>
<?php //echo $sql_qry;?><br>
<strong>Headers:</strong>
<?php //print_r($headers);?><br>
<strong>MySQL columns:</strong>
<?php //print_r($mysql_columns);?><br>

<?php echo $script;?>