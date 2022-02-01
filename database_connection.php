<?php
//database_connection.php



$DB_HOST='localhost';
$DB_NAME='id10534052_hi';
$DB_USER='root';
$DB_PASS='';

$con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS) or die("connection error");
mysqli_set_charset($con,'utf8');
$select_db=mysqli_select_db($con,$DB_NAME) or die ("error in selection db");


    
?>