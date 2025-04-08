<?php
$host = 'sql307.infinityfree.com';
$db = 'if0_38246983_mydatabase';
$user = 'if0_38246983';
$pass = 'zakutabeer';

$conn=mysqli_connect($host,$username,$password,$dbname);
if (!isset($conn)){

    echo" connection  NOT OK";

}else{    echo" connection OK";
}
?>