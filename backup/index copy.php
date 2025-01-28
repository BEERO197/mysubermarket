<?php

include("./include/connection1.php");
?>
<?php  include("file/header.php")
    ?>

<main>
    

    
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
       <div class="card-img" ><a href="detalis.php?id=<?php echo $row['id']?>">
           
           <img src="uploads/img//<?php echo $row['image'];?>">
           <span class="unvailable"><?php echo $row['prounv'];?></span>

           <a href="" ></a>
       </div>
         <div class="product_section">
           
           <a href="detalis.php?id=<?php echo $row['id']?>"><?php echo $row['prosection']?></a>
       </div>
       
  <div class="product_name">
      <a href="detalis.php?id=<?php echo $row['id']?>"><?php echo $row['name'];?>
      </a>
  </div>
  
  <div class="product_price">
      <a href="detalis.php?id=<?php echo $row['id']?>">   <?php echo $row['price'];?>  &nbsp;  price             </a>
  </div>
  
  <div  class="product_discription"><a href="detalis.php?id=<?php echo $row['id']?>"><i class="fa-solid fa-eye"> </i></a>اضغط هنا للمزيد من التفاصيل</div>
  
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
</main> 
  <br><br><br>
     <!---errore---->  
           <!---errore---->  
   
      
        
 <!-- ********* -->
       
   
           
  
      
    <!-- footer -->     
       <?php
       include "file/footer.php"
       ?>
    
       
    
    
