<?php 
$token = "EAAIDNlAfqXQBAImiTbX1k7HpFpEh2thZC0bSaVn02jfcvkdAyxlq0HTKSJkh6niCg6RV3zxpsyi50ih9kVKEnP04tmaQa3NZBxy9UCvxa54Tjs28vvGW4NQchrDOmwZB7sU9kalg4zL5MmsD065wtnmzda8U846xkQHzggwPwZDZD";

define("key", $token);

	$message_to_reply = 'ggggggggggg';

function bot($datas){

$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$token;
//Initiate cURL.
$ch = curl_init($url);
//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$datas.'"
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
}

function sendPhoto ($chat_id,$path){

$url = "https://api.telegram.org/bot".API_KEY."/"."sendPhoto?";

$post_fields = array('chat_id'   => $chat_id,
    'photo'     => new CURLFile(realpath($path))
);

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:multipart/form-data"
));
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
$output = curl_exec($ch);
}

?>