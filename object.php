<?php

require 'include/config.php';
require 'include/salesforce-report-endpoint.php';
require 'include/curl-auth.php';

//Optional for debugging.
//$endpoint = 'https://requestb.in/12345';
$endpoint = $r_data;

//get the records as rows
$rows = json_decode($r_data)->{'factMap'}->{'T!T'}->{'rows'};
//get he columns from the metadata
$columns = json_decode($r_data)->{'reportMetadata'}->{'detailColumns'};

//get array with field names
$fieldnames = array();
        foreach ($columns as $v){
	        $fieldnames[] =  $v;			
		}
	//make object with ordered data
	$object = array();
                foreach ($rows as $row) 
        {
		$record = array();
                foreach ($row as $label) {
                        $i=0;
                        foreach($label as $labelvalue){	
                        $record[$fieldnames[$i]] = $labelvalue->label;
                        $i++;
                        }
                $object[] = array('record' => $record);
		}
	}
header('Content-Type: application/json');
$pretty_result = json_encode($object, JSON_PRETTY_PRINT);
echo json_encode(array_values($object),JSON_PRETTY_PRINT);
//echo $pretty_result;
//echo($pretty_result);

?>