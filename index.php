	<?php 

	include 'database_connection.php';

	include 'add_product.php';

	include 'teleglib.php';
	$updatee = file_get_contents('php://input');
	$update =json_decode($updatee, TRUE);
	$chatid = $update ["message"]["chat"]["id"];
	$pmessage =$update ["message"]["text"];
	$msid =$update ["message"]["message_id"];
	$data = $update["callback_query"]["data"];
	$chat_id2 = $update["callback_query"]["message"]["chat"]["id"];
	$message_id = $update["callback_query"]["message"]["message_id"];
	$name_id = $update["callback_query"]["from"]["first_name"];
	$nam = $update ["message"]["chat"]["first_name"];

	$orderid =okorder($GLOBALS['chatid'],$GLOBALS['con']);
	
	
	
	
	
	
	
	



	
	

	bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>"العدد:".$resultss->num_rows ,'reply_markup'=>json_encode([
	'inline_keyboard'=>
	
	  $xx ])]);
	

	
	
	
  
	//حذف الرسائل القادمة من الزبون 
if ($pmessage=="/start"){
	}
	else{
 bot("deleteMessage",[
	'chat_id'=>$chatid,
	'message_id'=>$msid,

	]);

}
	
	//فحص اذا كان الزبون جديد 
	if(UserCheck($GLOBALS['chatid'])=="notfound") {
		
		
  
	UserNew ($GLOBALS['chatid']);
	bot ("sendMessage",['chat_id'=>$chatid,'text'=>"welcome ,اهلا و سهلا 
	 ",'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'Arabic ، العربيه🇮🇶','callback_data'=>'ar'],['text'=>'English ، النجليزيه🇱🇷','callback_data'=>'en']]
	] 
	])]);

		
	}



//قائمة المختصرات والاوامر 
	switch ($pmessage){
		case 'القائمة':
		case 'القائمه':
		case '/menu':
		  # code...
		  bot('deleteMessage',[
	'chat_id'=>$chatid,
	'message_id'=>$msid-1,

	]);
	  bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>"$name_id مرحبا يا صديقي
	لبدا التسوق اضغط على الزر في الاسفل
	 " ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'تسوق','callback_data'=>'shop_ar']],   
	  [['text'=>'تفاصيل المنتجات','callback_data'=>'products_data']]     
	  ,    [['text'=>' ارجع','callback_data'=>'language']],
	] 
	])
	]);
		  break;
        case 'سله':
			  case 'سلة':
			  case 'السله':
			 case 'السلة':
			 case '/cart':
	bot('deleteMessage',[
	'chat_id'=>$chatid,
	'message_id'=>$msid-1,

	]);	
  cart($GLOBALS['chatid'],$GLOBALS['con']);
  		  break;


		  case '/shipping':
		  case 'شحن':
		 bot('deleteMessage',[
	'chat_id'=>$chatid,
	'message_id'=>$msid-1,

	]);
	if (CheckData($chatid,adress)== NULL) {

	bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>'ضع العنوان اولا' ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'اضغط هنا ','callback_data'=>
	  'setaddres'],
	 ]]])]);


	}
	 elseif (CheckData($chatid,phone)== NULL) {
	bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>'ضع رقم الهاتف اولا' ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'اضغط هنا','callback_data'=>'setphone'],
	 ]]])]);

	 }

	eLse {
		 bot('deleteMessage',[
	'chat_id'=>$GLOBALS['chatid'],
	'message_id'=>$GLOBALS['message_id'],

	]);
	  bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>"المحافطة:".CheckData($chatid,adress)."\n".
	"العنوان الكامل:". CheckData($chatid,adress_2)
	."\n".
	"الرقم:". CheckData($chatid,phone)."\n".
	"لأرسال الطلب اضغط على الزر الأتي /send  او اكتب كلمة اشحن"

	,'reply_markup'=>json_encode([

	'inline_keyboard'=>[
	  [['text'=>'تعديل العنوان','callback_data'=>'setaddres'],['text'=>'تعديل الهاتف','callback_data'=>'setphone']
	 ]]
	 
	 

	 
	 
	 
	 
	 ])
	 
	 ]);

	 }

		  break;
		  
		  //اخر مرحلة للطلب حفظه في القاعده 
	case'اشحن': 
	case'/send':
bot('deleteMessage',[
	'chat_id'=>$chatid,
	'message_id'=>$msid-1,

	]);	
	CloseOrder($con ,$chatid,'true');

	bot('sendMessage',[
	'chat_id'=>$chatid,'text'=>"تم حفظ الطلبية ورقمها :"."$orderid"."\n"."يرجى الاتصال بالادارة لشحن الطلبية"
	]);
	break;

	case'الغاء':
	case'/skip':
	//افراغ سلة التسوق والغاء الطلب الحالي
	CloseOrder($con ,$chatid,'false');
	bot('sendMessage',[
	'chat_id'=>$chatid,'text'=>'تم افراغ السلة'
	]);
	break;
	
	
	}


//الازرار التفاعليه
	  if ($data==mem_data) {
	 
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"المحافظه:".CheckData($chat_id2,adress)."\n".
	"العنوان الكامل:". CheckData($chat_id2,adress_2)
	."\n".
	"الرقم:". CheckData($chat_id2,phone)."\n".
	"لأرسال الطلب اضغط على الزر الأتي /send  او اكتب كلمة اشحن"
	,
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'تعديل العنوان','callback_data'=>'setaddres'],['text'=>'تعديل الهاتف','callback_data'=>'setphone']
	 ]]])


	]);

	  }


	if ($data=="setphone") {
		UserEdit ($chat_id2,3,listen);
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>'اكتب رقم الهاتف'
	]);
	}


	//check listen phone
	if (CheckData($chatid,listen)== 3) {
	UserEdit ($chatid,$pmessage,phone);
	UserEdit ($chatid,0,listen);
bot('deleteMessage',[
	'chat_id'=>$chatid,
	'message_id'=>$msid-1,

	]);

	bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>CheckData($chatid,phone) ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'اكمل','callback_data'=>'mem_data'],  ['text'=>'عدل','callback_data'=>'setphone'],


	] ]])]);
	}







	if ($data=="setaddres") {
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>'select adress'
	,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'بغداد','callback_data'=>'baghdad']],
		[['text'=>'البصرة','callback_data'=>'Basra']],
		[['text'=>'نينوى','callback_data'=>'Nineveh']],
		[['text'=>'أربيل','callback_data'=>'Erbil']],
		[['text'=>'النجف','callback_data'=>'Najaf']],
		[['text'=>' ذي قار ','callback_data'=>'Dhi Qar']],
		[['text'=>'كركوك','callback_data'=>'Kirkuk']],
		[['text'=>'الأنبار','callback_data'=>'Al Anbar']],
		[['text'=>'ديالى','callback_data'=>'Diyala']],
		[['text'=>'المثنى','callback_data'=>'Muthanna']],
		[['text'=>'القادسية','callback_data'=>'Al-Qādisiyyah']],
		[['text'=>'ميسان ','callback_data'=>'Maysan']],
		[['text'=>'واسط ','callback_data'=>'Wasit']],
		[['text'=>' صلاح الدين ','callback_data'=>'Saladin']],
		[['text'=>' دهوك ','callback_data'=>'Dahuk']],
		[['text'=>'السليمانية','callback_data'=>'Sulaymaniyah']],
		[['text'=>'بابل','callback_data'=>'Babylon']],
		[['text'=>'كربلاء','callback_data'=>'Karbala']],
	  
	  ]])




	]);


	}


	if (setaddres($data,$chat_id2,adress)==true) {
	UserEdit ($chat_id2,2,listen);
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>'اكتب العنوان الكامل']);
	sleep(30);
	bot('deleteMessage',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,

	]);

	}

	//check listen 2adress 
	if (CheckData($chatid,listen)== 2) {
	UserEdit ($chatid,$pmessage,adress_2);
	UserEdit ($chatid,0,listen);


	bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>CheckData($chatid,adress).",".CheckData($chatid,adress_2) ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'اكمل','callback_data'=>'mem_data'],['text'=>'عدل','callback_data'=>'setaddres']


	] ]])]);
	}











	//check listen manual num set
	if (CheckData($chatid,listen)== 1) {
	UserEdit ($chatid,$pmessage,listen_data);
		Add_Pro($chatid,$data,"save");
	UserEdit ($chatid,0,listen);


	bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>"العدد:".CheckData($chatid,listen_data) ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'حسنا','callback_data'=>'savepro'],
	  ['text'=>'تعديل','callback_data'=>'editnum'],

	] ]])]);
	}

	if (Add_pro($chat_id2,$data,"add")=="count") {


	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>" اختر العدد" ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'1','callback_data'=>'1'],
	  ['text'=>'2','callback_data'=>'2'],
	  ['text'=>'3','callback_data'=>'3'],
	  ['text'=>'4','callback_data'=>'4'],
	  ['text'=>'5','callback_data'=>'5'],
	  ['text'=>'6','callback_data'=>'6'],
	  ['text'=>'7','callback_data'=>'7'],
	  ['text'=>'8','callback_data'=>'8'],
	] ,
	[  ['text'=>'9','callback_data'=>'9'],  ['text'=>'10','callback_data'=>'10']],
	 [['text'=>'ادخال يدوي','callback_data'=>'manulnum']]
	, [['text'=>'رجوع للقائمة','callback_data'=>'back']]

	] 
	])
	]);
	}
//عدد المنتج
	if (nmberset ($data,$chat_id2,listen_data) == "number") {


	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"العدد:".CheckData($chat_id2,listen_data) ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'حسنا','callback_data'=>'savepro'],
	  ['text'=>'تعديل','callback_data'=>'editnum'],


	] 
	]
	])
	]);
	}
	 

	if ($data=="savepro") {
	Add_Pro($chat_id2,$data,"save");
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>'تم الاختيار',

	]);
	bot('sendMessage',[
	'chat_id'=>$chat_id2,
	 'text'=>"يمكنك استخدام زر 'شحن' لتحديد تفاصيل الشحن وارسال الطلب \n
     ويمكنك استخدام زر: السلة لمشاهده المنتجات التي تم اختيارها
     ",
	'reply_markup'=>json_encode([
	'keyboard'=>[[['text'=>'شحن']]]]

	 )
	]);
	sleep(12);
	bot('deleteMessage',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id+1,

	]);

	sleep(15);
	$data=CheckData($chat_id2,'list');

	}


	if ($data=="manulnum") {
	UserEdit ($chat_id2,1,listen);
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>'اكتب العدد مثل :1']);

	for ($x = 2; $x <= 15; $x++ ){

	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"اكتب العدد مثل :"."$x"]);
	if ($x ==15)
	{
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"اكتب العدد مثل :"."$x"." او اكثر"]);
	} 
	}
	sleep(30);
	bot('deleteMessage',['chat_id'=>$chat_id2,'message_id'=>$message_id,]);



	}


	if ($data =="editnum") {
	  UserEdit ($chat_id2,0,listen_data);
	  bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>" اختر العدد" ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'1','callback_data'=>'1'],
	  ['text'=>'2','callback_data'=>'2'],
	  ['text'=>'3','callback_data'=>'3'],
	  ['text'=>'4','callback_data'=>'4'],
	  ['text'=>'5','callback_data'=>'5'],
	  ['text'=>'6','callback_data'=>'6'],
	  ['text'=>'7','callback_data'=>'7'],
	  ['text'=>'8','callback_data'=>'8'],
	] ,
	[  ['text'=>'9','callback_data'=>'9'],  ['text'=>'10','callback_data'=>'10']],
	 [['text'=>'ادخال يدوي','callback_data'=>'manulnum']]
	, [['text'=>'رجوع للقائمة','callback_data'=>'back']]

	] 
	])
	]);
	}








	if ($data =="back") {

	  $data=CheckData($chat_id2,'list');

	}
	// 1 menu
	if($data == "language"){
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"welcome ,اهلا و سهلا 
	 " ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'Arabic ، العربيه🇮🇶','callback_data'=>'ar'],['text'=>'English ، النجليزيه🇱🇷','callback_data'=>'en']]
	] 
	])
	]);

	}

	if($data == "ar"){
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"$name_id مرحبا يا صديقي
	لبدا التسوق اضغط على الزر في الاسفل
	 " ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'تسوق','callback_data'=>'shop_ar']],   
	  [['text'=>'تفاصيل المنتجات','callback_data'=>'products_data']]     
	  ,    [['text'=>' ارجع','callback_data'=>'language']],
	] 
	])
	]);

	}
	if($data == "shop_ar"){
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"الاقسام
	 " ,'reply_markup'=>json_encode([

	'inline_keyboard'=>[
	  [['text'=>'المكملات الغذائيه','callback_data'=>'list1']] ,
	  [['text'=>'المشروبات','callback_data'=>'list2']] ,
	  [['text'=>'العنايه الشخصيه','callback_data'=>'list3']] , 
	  [['text'=>'التجميل والعنايه بالبشرة','callback_data'=>'list4']] , 
		[['text'=>' ارجع','callback_data'=>'ar']],
	] 
	])
	]);

	}

	if($data == "products_data"){
	sendPhoto ($chat_id2,'upload/upload/product.png'); // تبدل مكان الصورة من الموقع 

	}


	if($data == "list1"){

	bot('sendMessage',[
	'chat_id'=>$chatid,

	'text'=>"العدد:".$resultss->num_rows ,'reply_markup'=>json_encode([
	'inline_keyboard'=>
	
	  view_pro() ])]);
	


	}


	if($data == "list2"){
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"اختر المنتجات
	 " ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'‏قهوة بالكريمة‎ ','callback_data'=>'p8']] ,
	  [['text'=>'1 ‏قهوة كورديسيبس 3 في‎','callback_data'=>'p9']] ,
	  [['text'=>' ‏قهوة 3 في 1 لايت‎‎','callback_data'=>'p10']] , 
	  [['text'=>'1 ‏قهوة 3 في‎','callback_data'=>'p11']], 
	  [['text'=>' ‏قهوةٌ سوداء‎ ','callback_data'=>'p12']], 
	  [['text'=>'شاي لينجزي','callback_data'=>'p13']], 
	  [['text'=>' ‏شاي لاتي‎','callback_data'=>'p14']],
	  
	  [['text'=>' ‏كوكوزي‎ ','callback_data'=>'p15']],  
	  [['text'=>' ‏عصير كورديباين‎','callback_data'=>'p16']],
	  [['text'=>' عصير موريئزي صغير‎','callback_data'=>'p17']], 
	  [['text'=>' عصير مورينزي كبير','callback_data'=>'p18']], 
	  [['text'=>' ‏موريئزايم‎','callback_data'=>'p19']], 
	  [['text'=>' ‏عصير الروسيل','callback_data'=>'p20']], 
	  [['text'=>' ‏مربى الأناناس‎‎','callback_data'=>'p21']], 
	  [['text'=>' ‏‏حلاوة زهي منت‎','callback_data'=>'p22']], 
	  [['text'=>' ‏‏خل‎ ‎','callback_data'=>'p23']], 
	  [['text'=>' ‏زيت جوز الهند','callback_data'=>'p24']], 

	  [['text'=>' ارجع','callback_data'=>'shop_ar']], 
	  
	  
	] 
	])
	]);

	}




	if($data == "list3"){
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"اختر المنتجات
	 " ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'معجون أسنان','callback_data'=>'p25']] ,
	  [['text'=>'معجون أسنان صغير 4 قطع','callback_data'=>'p26']] ,
	  [['text'=>'صابون 2 قطعة‎','callback_data'=>'p27']] ,
	  [['text'=>'شامبو جانوزي','callback_data'=>'p28']] ,
	  [['text'=>'رغوة الجسم جانوزي','callback_data'=>'p29']] ,
	  [['text'=>'بودرة التالكوم‎','callback_data'=>'p30']] ,
	  [['text'=>'كريم شجرة الشاي','callback_data'=>'p31']] ,
	  [['text'=>'‏زيت مساج‎','callback_data'=>'p32']] ,
	  [['text'=>'زيت الأطفال‎','callback_data'=>'p33']] ,
	  
	  [['text'=>' ارجع','callback_data'=>'shop_ar']], 
	  
	  
	] 
	])
	]);

	}



	if($data == "list4"){
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id,
	'text'=>"اختر المنتجات
	 " ,'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	  [['text'=>'منظف جانوزي‎','callback_data'=>'p34']] ,
	  [['text'=>'تونر جانوزي‎','callback_data'=>'p35']] ,
	  [['text'=>'مستحلب مايكرو المنظف','callback_data'=>'p36']] ,
	  [['text'=>'‏أحمر الشفا  كوكو أحمر‎ ','callback_data'=>'p37']] ,
	  [['text'=>'أحمر الشفاه أحمر لؤلؤي‎','callback_data'=>'p38']] ,
	  [['text'=>'أحمر الشفاه وردي لؤلؤي','callback_data'=>'p39']] ,
	  [['text'=>'أحمر الشفاه ( عنب بري)','callback_data'=>'p40']] ,
	  [['text'=>'الوفيرا جل منظف للبشرة','callback_data'=>'p41']] ,
	  [['text'=>'الوفيرا تونر مرطب','callback_data'=>'p42']] ,
	  [['text'=>'الوفيرا مرطب نهاري','callback_data'=>'p43']] ,
	  [['text'=>'الوفيرا كريم ليلي','callback_data'=>'p44']] ,
	  [['text'=>' الوفيرا لوشن للجسم واليد','callback_data'=>'p45']] ,
	  [['text'=>'مقشر الببايا','callback_data'=>'p46']] ,
	 
	  [['text'=>' ارجع','callback_data'=>'shop_ar']], 
	  
	  
	] 
	])
	]);

	}

	?>

		
