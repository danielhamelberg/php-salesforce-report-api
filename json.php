<?php 

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

$unstructured = json_decode($r_json);


$pretty_result = json_encode($unstructured, JSON_PRETTY_PRINT);
//$pretty_result = json_encode(json_decode($reportdata));
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $pretty_result);
fclose($myfile);
header('Content-Type: application/json');
//echo(json_encode($unstructured)['factMap']);
echo( $pretty_result );

?>
