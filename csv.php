<?php

//Retrieve Salesforce Report Data in json and convert to csv.
require 'include/config.php';
require 'include/salesforce-report-endpoint.php';
require_once 'include/curl-auth.php';

//Optional for debugging.
//$endpoint = 'https://requestb.in/12345';
$endpoint = $r_data;

$r_get = curl_init($endpoint);
curl_setopt($report, CURLOPT_HTTPHEADER, $headers);
curl_setopt($report, CURLOPT_RETURNTRANSFER, 1);
$r_json = curl_exec($r_get);
curl_close($r_get);

//Get the records as rows.
$rows = json_decode($r_json)->{'factMap'}->{'T!T'}->{'rows'};
//Get he columns from the metadata.
$columns = json_decode($r_json)->{'reportMetadata'}->{'detailColumns'};

echo '<html><head>';
echo '</head><body>';

//Generate a table.
//Column names.
foreach ($columns as $v) {
    echo '$enclosing$v$enclosing$seperator';
}
//Row data.
foreach ($rows as $row) {
    foreach ($row as $label) {
        foreach ($label as $labelvalue) {
            echo '$enclosing$labelvalue->label $enclosing$seperator';
        }
    }
}
echo '</body>';

?>