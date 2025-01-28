<?php
$host="localhost";
$username="root";
$password="abeer_zakut";
$dbname="test";

$conn=mysqli_connect($host,$username,$password,dbname);
if (isset($conn)){
echo" connection OK";
}
else {
    echo" connection  NOT OK";

}
?>