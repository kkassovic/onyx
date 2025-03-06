<h2 class="content-subhead"><?php echo $pagetitle;?></h2>
<table id="datova_tabulka" class="pure-table pure-table-bordered">
<thead>
	<tr>
		<th>Navi</th>
		<th>Názov</th>
    <th>Segment</th>
		<th>Mesto</th>
		<th>Ulica</th>
		<th>IČ DPH</th>
		<th>IČO</th>
    <th>Palety</th>
    <th>Blokované</th>
    <th>Poznámka</th>
    <th>Akcia</th>
	</tr>
</thead>
<tbody>
<?php
foreach($material as $row ):
    echo "<tr>\n";

		echo "<td align='left'>" . $row['navi_kod'] . "</td>";
		echo "<td align='left'>" . $row['nazov'] . "</td>";
    echo "<td align='left'>" . $row['typ'] . "</td>";
		echo "<td align='left'>" . $row['mesto'] . "</td>";
		echo "<td align='left'>" . $row['adresa'] . "</td>";
		echo "<td align='left'>" . $row['ic_dph'] . "</td>";
		echo "<td align='left'>" . $row['ico'] . "</td>";
    echo "<td align='left'>" . $row['palety'] . "</td>";
		echo "<td align='left'>" . $row['blokovane'] . "</td>";
    echo "<td align='left'>" . $row['poznamka'] . "</td>";

    echo "<td align='left'>";
    
    $actionbuttons = array
        (
        array ("disp"=>"Rozšírené info",
                "ref"=>"/kontakty/dodavatelia/ext?")
        );
    $linkdisp = new purecss_actbutton();
    $linkdisp->buttonarray = $actionbuttons;
    $linkdisp->target_index = $row['navi_kod'];
    $linkdisp->requestfield = "navi";
    $xdata = $linkdisp->show_action_drop_single();
    echo $xdata;
    
    echo "</td>";


     echo "</tr>\n";
endforeach;
?>
</tbody>
</table>
