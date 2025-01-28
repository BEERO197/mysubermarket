<?php
$host="localhost";
$username="abeer";
$password="abeer_zakut";
$dbname="ecommerce_db";

$conn=mysqli_connect($host,$username,$password,$dbname);
if (!isset($conn)){

    echo" connection  NOT OK";

}
?>