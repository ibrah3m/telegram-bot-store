<?php
$access_token ="EAARoea6TnJoBANt9DyrFc53mpONKD8bvTw5ZCdBYaSVndmezHgvOHtZBC2IWnytbx55UXNwOzfzM1QZACsUouqPXSnfPzKk7QboKUrHzOJF1el7PX2bnoi2dys20idkNnsIAP0iGUE6Ojkz07s6cCqABWBKSYDrHpomuJz0pgZDZD";
$verify_token = "working";
$hub_verify_token = null;

if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
    echo $challenge;
}

include 'database_connection.php';
	include 'add_product.php';
	include 'facelib.php';
	$updatee = file_get_contents('php://input');
	$update =json_decode($updatee, TRUE);
	$chatid = $update['entry'][0]['messaging'][0]['sender']['id'];
$message = $update['entry'][0]['messaging'][0]['message']['text'];

$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
//Initiate cURL.
$ch = curl_init($url);
//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$chatid.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
}';
//Encode the array into JSON.
$jsonDataEncoded = $jsonData;
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
//Execute the request
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}
?>