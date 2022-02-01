<?php
include 'database_connection.php';
//create new user 
function UserNew($id){
    $sql = "INSERT INTO users(id) VALUES ('$id')";if ($GLOBALS['con']->query($sql) === TRUE) {    echo "Ok";} else {   echo "Error:".$sql."<br>".$con->error;}
    }
// check user if found
function UserCheck($user){$search = "SELECT * FROM users WHERE id = $user";$result = $GLOBALS['con']->query($search);if ($result->num_rows > 0) {    while($row = $result->fetch_assoc()) {    return "found";}} else{    return "notfound";}}
//edit user data  
function UserEdit ($id,$text,$table) {$edit = "UPDATE users SET $table='$text' WHERE id=$id";if ($GLOBALS['con']->query($edit) === TRUE) {    echo "Ok";} else {    echo "Error: " . $edit . "<br>" . $con->error;} }
//check user data
function CheckData($user,$table){$search = "SELECT * FROM users WHERE id = $user";$result = $GLOBALS['con']->query($search);if ($result->num_rows > 0) {    while($row = $result->fetch_assoc()) {        return $row["$table"];	    }    	}}

function cart($id,$con){
	$v="";
  $sq = "SELECT * FROM `Orders` WHERE UserId=".$id." AND OrderState='1'";
    $res = $con->query($sq);
	$r="";
    if ($res->num_rows > 0) {
      $r = mysqli_fetch_assoc($res) ;
    
}  else {
	bot ("sendMessage",['chat_id'=>$GLOBALS['chatid'],'text'=>"لايوجد شيء في السلة"
	]);
	
}   
    $sql1 = "SELECT * FROM `Order_Ditails` WHERE `OrderId`=".$r['id'];
    $result = $con->query($sql1);
    if ($result->num_rows > 0) {
         $result->fetch_all(MYSQLI_ASSOC);
	    
    
}    

foreach ($result as $a){
		
		 $a['ProductName'];
		$v.=$a['ProductName']."\n";

			//عمل فنكشن تحويل من موديل الى اسم
		
} 
		
bot ("sendMessage",['chat_id'=>$GLOBALS['chatid'],'text'=>$v.$r['id']
	]);
}		


?>