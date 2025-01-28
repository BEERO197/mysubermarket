
<?php

include("../include/connection1.php");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">  
    
    
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>متجر الكتروني</title>
</head>
<body>
    
    <?php  include("header.php")
    ?>

    
          <!-- product -->  
   <div class="contianer_card" >
   <?php
$query="SELECT * FROM products ";
$result=mysqli_query($conn,$query);
while ($row=mysqli_fetch_assoc($result)){
//print_r($row);





?>
         <div class="product_card">
       <!-- الصورة -->
       <div class="card-img">
           
           <img src="../uploads/img//<?php echo $row['image'];?>">
           <span class="unvailable"></span>

           <a href="" ></a>
       </div>
         <div class="product_section">
           
           <a href=""><?php echo $row['prosection']?></a>
       </div>
       
  <div class="product_name">
      <a href=""><?php echo $row['name'];?>
      </a>
  </div>
  
  <div class="product_price">
      <a href="">   <?php echo $row['price'];?>  &nbsp;  price             </a>
  </div>
  
  <div  class="product_discription"><a href=""><i class="fa-solid fa-eye"> </i></a>اضغط هنا للمزيد من التفاصيل</div>
  
  <div class="qy_input">
      
   <button  class="qy_count-mins" >-</button>   
   <input type="numbet" value="1" name="" id="quantity" min="1" max="7" style="width    :40px"></input>
     <button  class="qy_count-add" >+</button>   
  </div><!-- نهاية دف الكمية -->
  
  <!-- دف اضف للسلة  --> 
  
  <div  class=""><a href="">
  <button  class="add-to-cart " type="submit" name="" style="    margin:20px ;">اضف الي السلة<i class="fa solid fa-cart-plus"></i></button>
  </a>
  </div>
  
 </div>
 <?php
}
?>
 </div>
 
  
     <!---errore---->  
           <!---errore---->  
   
      
        
 <!-- ********* -->
       
   
           
  
      
    <!-- footer -->     
       <?php
       include "file/footer.php"
       ?>
        </div>  
    
       
    
    
</body>
</html>
