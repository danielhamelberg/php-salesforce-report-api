<?php

//Set CLIENT_ID, CLIENT_SECRET, USERNAME and PASSWORD in config.php
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, LOGIN_URI );
curl_setopt(
    $ch,
    CURLOPT_POSTFIELDS,
    http_build_query(
        array(
        'grant_type' => 'password',
        'client_id' => CLIENT_ID,
        'client_secret' => CLIENT_SECRET,
        'username' => USERNAME,
        'password' => PASSWORD,
        )
    )
);

curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$output = curl_exec( $ch );
curl_close( $ch );

//Get authentication token
$auth_token = json_decode( $output );
$s = $auth_token->{'access_token'};
$bearer = 'Authorization: Bearer ' . $s;
$headers = array();
$headers[] = $bearer;
$headers[] = 'Accept: application/json';
$headers[] = 'Content-Type: application/json';

?>