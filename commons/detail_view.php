<?php 
  $counter_t = 0;
  $counter_l = 0;
?>

<h2 class="content-subhead"><?php echo $pagetitle;?></h2>

<table id="datova_tabulka" class="pure-table pure-table-bordered">
	<thead>
    <tr>
      <th>Položka</th>
      <th>Hodnota</th>
    </tr>
	</thead>
    
	<tbody>
    <?php foreach($mysql_columns as $col):?>
      <tr>
            <td align="right"><strong><?php echo $headers[$counter_l];?></strong></td>
        <td align="left"><?php echo $tabdata[$col];?></td>
            <?php $counter_l++;?>
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