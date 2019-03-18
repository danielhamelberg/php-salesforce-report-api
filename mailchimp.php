<?php

require 'include/config.php';
require 'include/salesforce-report-endpoint.php';
require 'include/curl-auth.php';

//Optional for debugging.
//$endpoint = 'https://requestb.in/12345';
$endpoint = $r_data;

	$r_get = curl_init( $endpoint );
	curl_setopt( $report, CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $report, CURLOPT_RETURNTRANSFER, 1 );
	$r_json = curl_exec( $r_get );
	curl_close( $r_get );

        //get the records as rows
        $rows = json_decode( $r_data )->{'factMap'}->{'T!T'}->{'rows'};
        //get he columns from the metadata
        $columns = json_decode( $r_data )->{'reportMetadata'}->{'detailColumns'};

		//get array with field names
		$fieldnames = array();
foreach ( $columns as $v ) {
		$fieldnames[] = $v;
}
	//make object with ordered data
	// for mailchimp: api settings

	$apiKey = 'your api key';
	$listId = 'your list id';

	$memberId   = md5( strtolower( $data['email'] ) );
	$dataCenter = substr( $apiKey, strpos( $apiKey, '-' ) + 1 );
	$url        = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;


	//for mailchimp, map to fields
	$object = array();

foreach ( $rows as $row ) {
	$record = array();
	foreach ( $row as $label ) {
		$i = 0;
		foreach ( $label as $labelvalue ) {
			$record[ $fieldnames[ $i ] ] = $labelvalue->label;
			$i++;
		}
		$record[ email ] = $record['Contact.EmailBemTypeCalc__c'];
		unset( $record['Contact.EmailBemTypeCalc__c'] );
		$plainmail       = preg_replace( '#<a.*?>(.*?)</a>#i', '\1', $record['email'] );
		$record['email'] = $plainmail;
		//add here curl call from acceppted answer on https://stackoverflow.com/questions/30481979/adding-subscribers-to-a-list-using-mailchimps-api-v3. Need mc creds
		$object[] = $record;
	}
}



	header( 'Content-Type: application/json' );
$pretty_result = json_encode( $object, JSON_PRETTY_PRINT );
echo json_encode( array_values( $object ), JSON_PRETTY_PRINT );
//echo $pretty_result;
//echo($pretty_result);

?>
