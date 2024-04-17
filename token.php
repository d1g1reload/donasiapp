<?php

$key = base64_encode("SB-Mid-server-uaBbEV6DIb1zBYFSIelW1HJV:");
echo $key;

echo "<br>";
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.sandbox.midtrans.com/v2/570830315/status',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Basic U0ItTWlkLXNlcnZlci11YUJiRVY2REliMXpCWUZTSWVsVzFISlY6'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
