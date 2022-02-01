<?php

// فتح الطلب وتخزين رقم الطلب مؤقتا 
// تحتاج الدالة رقم العميل
function OpenOrder($id,$con){

    $order_state = '1';  //حالة الطلب  =  الطلب مفتوح
    $sql = "INSERT INTO Orders (UserId, OrderState) VALUES ('$id', '$order_state')";
    
    if ($con->query($sql) === TRUE) {
        return mysqli_insert_id($con);
    } else {
        return "Error: " . $sql . "<br>" . $con->error;
    }

    
}


// انهاء الطلب
// يحتاج رقم الطلب وحالة الطلب 
// $complete == true  اكتمال الطلب  
// $complete == false  الغاء الطلب  
function CloseOrder($con ,$user_id, $complete){

    if($complete == true){
        $order_state = '2'; //حالة الطلب  =  الطلب مكتمل 
        $msg = "Order saved";
    }else{
        $order_state = '3'; //حالة الطلب  =  الطلب ملغي 
        $msg = "Order canceled";
    }
    
    $sql = "UPDATE `Orders` SET `OrderState` = '$order_state' WHERE `UserId` = '$user_id' AND `OrderState` = '1'";
    
    if ($con->query($sql) === TRUE) {
        return $msg;
    } else {
        return "Error: " . $sql . "<br>" . $con->error;
    }
     
    
}


//دالة اضافة منتج 
function Add_Product($con, $user_id, $Product_name, $quantity){

    // اذا لم يكن هناك رقم طلب مفتوح مسبقا يتم فتح طلب جديد

    $sql1 = "SELECT * FROM Orders WHERE `UserId`= '$user_id' AND `OrderState` = '1'";
    $result = $con->query($sql1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $order_id = $row["id"];       
    } else {
        $order_id = OpenOrder($user_id, $con); 
    }


    $sql = "INSERT INTO Order_Ditails (OrderId, ProductName, Price, Quantity) VALUES ('$order_id', '$Product_name',SELECT price, FROM product
WHERE name='$Product_name', '$quantity')";
    
    if ($con->query($sql) === TRUE) {
        return "Add producted";
    } else {
        return "Error: " . $sql . "<br>" . $con->error;
    }
}
function okorder($id,$con){    

$sql1 = "SELECT * FROM Orders WHERE `UserId`= '$id' AND `OrderState` = '1'";
    $result = $con->query($sql1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $order_id = $row["id"];       
    } 
	
	return $order_id;
	}

?>