
<?php
session_start();
include("../include/connection1.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div class="sidbar_container">
<table dir="rtl">
    <tr>
        <th>id</th>
        <th>image product</th>
        <th>adress product</th>
        <th>price</th>
        <th>size</th>
        <th>avalabel</th>
        <th>section</th>
        <th>detials</th>
        <th>quantity</th>
        <th>delete product</th>
        <th>updare product</th>
        
   </tr>
   <?php
   $query="SELECT * FROM products ";
   $result=mysqli_query($conn,$query);
   while ($row=mysqli_fetch_assoc($result)) {


   ?>
   <tr>
        <td><?php echo $row['id'];?></td>
        <!---img--->
        <td><img src="../uploads/img//<?php echo $row['image'];?>"></td>

        

            <!---im--->
            <td><?php echo $row['name'];?></td>
        <td><?php echo $row['price'];?></td>
        <td><?php echo $row['prosize'];?></td>
        <td><?php echo $row['prounv'];?></td>
        <td><?php echo $row['prosection'];?></td>
        <td><?php echo $row['description'];?></td>
        <td><?php echo $row['quantity'];?></td>

        <td><a hreh=""><button type="submit"  class="delet">DELETE PRODUCT</button></a></td>
        <td><a hreh=""><button type="submit"  class="UPDATE">UPDATE PRODUCT</button></a></td>
        
   </tr>
   

</div> 

   <?php
   }

   ?>
      </table>

</body>
</html>