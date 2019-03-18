<?php

require 'include/config.php';
require 'include/salesforce-report-endpoint.php';
require 'include/curl-auth.php';

//Optional for debugging.
//$endpoint = 'https://requestb.in/12345';
$endpoint = $r_data;

$r_get = curl_init($endpoint);
curl_setopt($report, CURLOPT_HTTPHEADER, $headers);
curl_setopt($report, CURLOPT_RETURNTRANSFER, 1);
$r_json = curl_exec($r_get);
curl_close($r_get);


//get the records as rows
$rows = json_decode($r_json)->{'factMap'}->{'T!T'}->{'rows'};
//get he columns from the metadata
$columns = json_decode($r_json)->{'reportMetadata'}->{'detailColumns'};

echo '<html><head>';
echo '<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.12.4.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>';
echo '</head><body>';

//generate a table
echo '<table id="report" class="display">';
//column names
	echo '<thead><tr>';
	foreach ($columns as $v){
	echo "<th>$v</th>";
	}
	echo '</tr></thead>';
//row data
echo '<tbody>';
foreach ($rows as $row) {
	foreach ($row as $label) {
		echo "<tr>"; 
		foreach($label as $labelvalue){
			echo "<td>$labelvalue->label</td>";
		}
		echo "</tr>";
	}
}
echo '</tbody>';
echo '</table>
<script>$(document).ready(function(){$("#report").DataTable({

})});</script>
</body>';

?>
