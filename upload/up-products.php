
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php


// define variables and set to empty values

$name = $code = $count = $price = $list = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = test_input($_POST["code"]);
    // check if name only contains letters and whitespace

  
  

    $name = test_input($_POST["name"]);
    // check if e-mail address is well-formed
    

 
    $count = test_input($_POST["count"]);
	$price = test_input($_POST["price"]);
   	$list = test_input($_POST["list"]);
   



}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  code: <input type="text" name="code" >
  
  <br><br>
  name: <input type="text" name="name">
  
  <br><br>
  price: <input type="text" name="price">  <br><br>
  count: <input type="text" name="count">  <br><br>
  list: <input type="text" name="list">

 


  
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
	

echo "<h2>Your Input:</h2>";
echo $code;
echo "<br>";
echo $name;
echo "<br>";
echo $price;
echo "<br>";
echo $count;
echo "<br>";
echo $list;
echo "<br>";

 

?>
<?php
	
include 'database_connection.php';
$sqLL = "INSERT INTO product (code ,name,price,count,list) VALUES ('$code','$name','$price','$count','$list')";
 
    if ($con->query($sqLL) === TRUE) {
        return mysqli_insert_id($con);
    } else {
        return "Error: " . $sqLL . "<br>" . $con->error;
    }

?>

</body>
</html>











