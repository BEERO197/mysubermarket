<?php
include "../include/connection1.php";


session_start();
echo "<h1>control panal</h1>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">  


<link rel="stylesheet" href="style1.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>control panel for admin</title>
</head>
<body>
    <?php
if(!isset($_SESSION['EMAIL'])){

header('location:../index.php');


}else{


?>

<?php
$section_name=$_POST['section_name'];
$secadd=$_POST['secadd'];
$id=$_GET['id'];



if(isset($secadd)){
  if(empty($section_name)){
     echo'<script> alert ("inter the field");</script>';
  }
  elseif (strlen($section_name)>50) {
    echo'<script> alert ("long the field");</script>';
  }
  else{
      $query="INSERT INTO section (section_name)VALUES('$section_name')";
      $result=mysqli_query($conn,$query);
      echo'<script> alert ("insert the field sussifluty");</script>';

  }

}


?>
<?php
#delete section
if (isset($id)){

  $query="DELETE FROM section  WHERE  id='$id'";
  $delet=mysqli_query($conn,$query);
    if(isset($delet)){

      echo '<script> alert ("delete sufisscly")</script>';
    }else {
      echo '<script> alert ("dont delete sufisscly")</script>';

    }
}

?>




<!---idebar start--->
 <div class="sidbar_container">


<div class="sidebar">

<center><h1>control panal</h1></center>

    <ul>
   
    <li><a href="../index.php" target="_blank" > home page<i class="fa-solid fa-house-chimney"></i></a></li>
    <li><a href="" target="_blank" > order page<i class="fa-solid fa-folder-open"></i></a></li>
    <li><a href="" target="_blank" > user info<i class="fa-solid fa-users"></i></a></li>
    <li><a href="productchat.php" target="_blank" > products page<i class="fa-solid fa-gift"></i></a></li>
    <li><a href="addproduct.php" target="_blank" > add product<i class="fa-solid fa-plus"></i></a></li>
    <li><a href="logout.php" target="_blank" > logout<i class="fa-solid fa-share-from-square"></i></a></li>
</ul>
</div>

 
<!---section start--->

<div class="content_sec"> 
    <form action="adminpanal.php"  method="post">
        <label for="section" >add new part </label>
        <input type="text" name="section_name"  id ="section">
        <br>
        <button class="add"  type="submit" name="secadd">add part</button>
      </form>

<!---table start--->

        <table dir="rtl">
    <tr>
        <th>id</th>
        <th>name part</th>
        <th>delete part</th>
   </tr>
   <tr>
    <?php
$query="select *from section; ";
$result=mysqli_query($conn,$query);
while ($row=mysqli_fetch_assoc($result)){
  ?>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['section_name'];?></td>
    <td><a href="adminpanal.php?id=<?php echo $row['id'];?>">
      <button type="submit"  class="delet">DELETE PART</button></a></td>

  </tr>
<?php
}

?>
    </table>
<!---table end--->
  </div>
<!---section end--->


  </div>

<?php
///close else
}
?>
</body>
</html>


