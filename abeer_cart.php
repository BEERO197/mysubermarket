<?php
include ('include/connection1.php');





if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ersal'])) {
    $name=$_post['name'];
$phon=$_POST['phon'];
$adress=$_POST['adress'];
echo ("hhhhhh");
$query = "INSERT INTO orders (name, image, price, prosection, description, prosize, prounv, quantity) 
                      VALUES ('$proname', '$proimg', '$proprice', '$prosection', '$prodescrip', '$prosize', '$prounv', '$quantity')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo '<script>alert("ADD PRODUCT SUCCESSFULLY");</script>';


            } else {
                echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
            }



}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>commplet order</title>
</head>
<body>
  <form action="abeer_cart.php" method="POST" >
    <center>
<input name="name" type="text" >input your name</input><br><br>
<input name="name" type="text" >input your phon</input><br><br>
<input name="name" type="text" >input your adress</input><br><br>
<button name="ersal">ersal</button>

</center>


</form>  
</body>
</html> 