<?php
include 'database_connection.php' ;
include 'uses.php';     
include 'order_fun.php' ;


//$user_id  = '123';  // رقم العميل
//$Product_name = 'Product 1'; // اسم المنتج
//$price    = '190'; // سعر المنتج
//$quantity =  '13'; // العدد


	$get = "SELECT * FROM `product`";
    $value = $con->query($get);
    if ($value->num_rows > 0) {
         $value->fetch_all();
	
    print_r($value);
}  

function view_pro(){
 $sql1 = "SELECT * FROM `product`";
    $resultss = $con->query($sql1);
    if ($resultss->num_rows > 0) {
         $resultss->fetch_all(MYSQLI_ASSOC);
	    
    
}    
$xx=[];
foreach ($resultss as $a){
		
		
		
		$xx[]=[['text'=>$a['code'],'callback_data'=>$a['code']]];
		

	
		
} 

}
//echo Add_pro (721982147,vcv,"add") ;
function Add_pro ($user_id,$proid,$switch){
	
  





		//	اضافه منتج الى السلة
 
		$prid=CheckData($user_id,data);
	


		switch ($switch){
	case "save":
	$quantity = CheckData($user_id,listen_data); // العدد
			 Add_Product($GLOBALS['con'], $user_id, $prid, $quantity);
			
			break;
case "add":
foreach ($GLOBALS['value'] as $give){
 if ($proid==$give['code']){
	UserEdit ($user_id,$proid,"data");UserEdit ($user_id,$give['list'],"list");
return "count";
}
}
break;


}

	

}


// اضافة منتج
//Add_Product($con, $user_id, $Product_name, $price, $quantity);


// حفظ الطلب
//CloseOrder($con ,$user_id, true) ;

// الغاء الطلب
//CloseOrder($con ,$user_id, false) ;


//set prodnumbere
function nmberset ($pronum ,$id,$table){
switch ("$pronum") {
 case '1':
 case '2':
 case '3':
 case '4':
 case '5':
 case '6':
 case '7':
 case '8':
 case '9':
 case '10':
  UserEdit ($id,$pronum,$table);

return "number" ;
   break;
  
  default:
    break;
}

 }
 
 //set address
function setaddres ($adres ,$id,$table){
switch ("$adres") {
 case 'baghdad':
 case 'Basra':
  case 'Nineveh':
   case 'Erbil':
    case 'Najaf':
     case 'Dhi Qar':
      case 'Kirkuk':
       case 'Al Anbar':
        case 'Diyala':
         case 'Muthanna':
          case 'Al-Qādisiyyah':
           case 'Maysan':
            case 'Wasit':
             case 'Saladin':
              case 'Dahuk':
               case 'Sulaymaniyah':
               case 'Babylon':
                case 'Karbala':
 
  UserEdit ($id,$adres,$table);

return "ture" ;
   break;

 }

}
?>