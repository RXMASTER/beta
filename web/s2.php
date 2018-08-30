
<?php
$id = $_GET['id'];
$ticket = $_GET['ticket'];
$captcha_response = $_GET['captcha_response'];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openload.co/1/file/dl?file=".$id."&ticket=".$ticket."&captcha_response=".$captcha_response."");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "https://api.openload.co/1/file/dl?file=".$id."&ticket=".$ticket."&captcha_response=".$captcha_response."");

$response = curl_exec($ch);
curl_close($ch);

//var_dump($response);
echo $response;
