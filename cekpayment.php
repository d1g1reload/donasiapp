<?php 

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,"https://api.sandbox.midtrans.com/v2/1903754754/status");

curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$header = [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'Authorization' => 'Basic U0ItTWlkLXNlcnZlci11YUJiRVY2REliMXpCWUZTSWVsVzFISlY6'
];
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);



$output = curl_exec($ch);
// $data = json_decode($output);
if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
    exit();
}



curl_close($ch);

$json= json_decode($output, true);
print_r($json);


?>

