<?php

//Salesforce Report Endpoint details.
$r_id = '';
$r_api_version = 'v45.0';
$r_domain = 'https://eu5.salesforce.com/';
$r_uri_part_1 = '/services/data/';
$r_uri_part_2 = '/analytics/reports/';
$r_qs_details = '?includeDetails=true';
$r_qs_describe = '/describe';

$r_id_url = $r_domain . $r_uri_part_1 . $r_api_version . $r_uri_part_2 . $r_id;
$r_data = $r_id_url . $r_qs_details;
$r_meta = $r_id_url . $r_qs_describe;

$seperator = ';';
$enclosing = '"';

?>