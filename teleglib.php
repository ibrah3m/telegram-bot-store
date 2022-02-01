<?php 
$token = "";
$website ="https://api.telegram.org/bot$token/";
$sendMessag ="https://api.telegram.org/bot$token/sendMessage";
$deleteMs = "https://api.telegram.org/bot$token/deleteMessage";


//function checklvl () 
	
//	check id , chat lvl
	
	
define('API_KEY',$token);

function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
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