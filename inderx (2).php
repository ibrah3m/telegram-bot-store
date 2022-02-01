<?php
/*--------@dev_ahvaz-----------*/
ob_start();
$API_KEY = "";
define('API_KEY',$API_KEY);

function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}
else
{
return json_decode($res);
}
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$data = $update->callback_query->data;

$reply = $message->reply_to_message->message_id;
$message = $update->message;
$text = $message->text;


$name = $update->message->from->first_name;
$username = $update->message->from->username;

$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;

$data = $update->callback_query->data;





if ($text == '/start'){
  bot('sendMessage',[
  'chat_id' => $chat_id,
  'text' => "• Hi ، •
",
  
'reply_markup'=>json_encode([
'inline_keyboard'=>[
  [['text'=>'Arabic ، العربيه🇮🇶','callback_data'=>'ar'],['text'=>'English ، النجليزيه🇱🇷','callback_data'=>'en']],
       [['text'=>"المطور🤵🏼",'url'=>"https://t.me/hmza97"],['text'=>"جديدنا📢",'url'=>"https://t.me/dq13bo"]],
]  

])
 ]);
}



if($data == "ar"){
bot('editMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"• مرحبا بك في قسم تحميل من مواقع الان اختر قسم الذي تريدة ، :first_quarter_moon_with_face:",

]);
 bot('sendMessage',[
  'chat_id' => $chat_id2,
  'text' => "• Httttt ، •
"]);
}
