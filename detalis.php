<?php

include("./include/connection1.php");

include('file/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document detalis</title>

</head>
<style>
    main{display:flex;
      flex-wrap:wrap;
    }
    .container{
      width:90%;
      height:auto;
      margin:20px auto;
      border-radius:8px;
    }
    .product_img{

      float:left;
      display:flex;
      flex-wrap:wrap;
      margin-bottom:20px;
    }
    .product_img img{
     width:400px;
     height:400px;
     margin-left:40px;
     margin-bottom:20px;
     box-shadow:0 5px 10px rgba(0,0,0,1.0);
    }
    .product_img img:hover{
     opacity: 0.7;
    }
    .product_info{
      float:right;
      width:400px;
      height:400px;
      text-align:center;
      font-size:20px;
      margin-right:50px;
      padding:10px 10px;
      margin-top:30px;
    }
    .product_title{
     margin:10px o;  
    
    }
    .product_price{

      color:#e67e22;
      margin:10px o;
    }
.product_description{
font-size:16px;
line-height:1.5;

}
.add_cart{
color :black;
   width:150px;
   height:35px;
   margin-left:0px;
   margin-top:10px;
   padding:10px 10px;
   background-color:#fff;
   border-radius:5px;
}
.add_cart:hover{
background-color:#e67e22;

}
.recently_add{
background-color:#fff;
   float:right;
   width:30%;
   margin-top:30px;
   border-radius:8px;
   padding:10px 10px;
   box-shadow:0 5px 10px rgba(0,0,0,1.0);
}

.added_img img{
   float:right;
   margin:10px 10px;
   width:70px;
   height: 70px;
   margin-right:5px;
   border-radius:10px;


}
.added_img img:hover{
   opacity: 0.7;
}
.comment_info{
   background-color:#e67e22;

   float:left;
   width:50%;
   height:auto;
   margin:20px 10px;
   box-shadow:0 2px 2px rgba(0,0,0,1.0);
   border-radius:10px;

}
h5{
font-size:20px;
margin: top 20px;
text-align:center;
color:black;
}
textarea{
text-align:center;
width:80%;
margin-top:20px;
margin-right:40px;
margin-bottom:10px;
padding:10px;
border-radius:10px;
height:50px;

}

.add_comment{
   float:left;
/text-align:center;
   width:100px;
   height:35px;
  margin-left:40px;
   background-color:#fff;
   padding:10px 10px;
   border-radius:5px;

}
.add_comment:hover{
   background-color:green;


}

.comments{
margin-top:10px;
}
.comment{
   color:black;
   font-size:larger;
   margin:5px 5px;
   text-align:center;
   padding:10px;
   background-color:#fff;
border:1px solid #ddd;
margin-bottom:10px;
border-radius:5px;
overflow:hidden;
text-overflow:ellipsis;

}
      </style>


<body>
    <main>
      <?php
$id=$_GET['id'];
if(isset($_GET['id'])){
$query="SELECT * FROM products WHERE id='$id'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
//print_r($row);
//print_r($id);
}
      ?>
<div class="container">
   <div class="product_img">
      <img src="uploads/img//<?php echo $row['image'];?>">
   </div>
    <div class="product_info">
      <h1 class="product_title"><?php echo $row['name']?></h1>
        <h2 class="product_price"><?php echo $row['price']?>$ &nbsp;  price</h2><br>
      <h3><?php echo $row['prosize']?> &nbsp;:size avialebol </h3>
      <h4 class="product_description">detalis product</h4>
      <p> <?php echo $row['description']?> </p>

      <div class="qy_input">
      
      <button  class="qy_count-mins" >-</button>   
      <input type="numbet" value="1" name="" id="quantity" min="1" max="7" style="width    :40px"></input>
        <button  class="qy_count-add" >+</button>   
     </div><!-- نهاية دف الكمية -->
  <!---submit-->   

   <div class="submit"><a href="">
    <button class="add_cart" type=submit name="">
ERSALL

     </button>

     </a>


  <!---end submit--->
     </div>
</div>

</div>
</main>
 <hr>  
 
 <!---------start recently added --->

<div class="container">
 <div class="recently_add">

   <h4>new products</h4>
<?php 
$query="SELECT * FROM  products WHERE id!='$id' ORDER BY rand() LIMIT 3";
$result=mysqli_query($conn,$query);
//if($result){echo"ok";
//print_r($row);


//}else{}
while($row=mysqli_fetch_assoc($result)){

?>
   <div class="added_img"><a href="detalis.php?id=<?php echo $row['id']?>">
           
           <img src="uploads/img//<?php echo $row['image'];?>">

      </a>

    </div>
<?PHP
}?>
 </div>
    <!---srart cooment--->
   <div  class="comment_info">
    <h5> hl tored taggeem hatha al montag </h5>
    <form action="" method="post">
     <textarea name="" placeholder="geem hatha al montag men fathlek "  requied></textarea>
      <button class="add_comment"  type="submit"   name="">erssal</button>
    </form>

    <h5>tagyemat al omalaa </h5>
    <div class="comments">

    <div class="comment">montag mmomtaz </div>

    <div class="comment">montag mmomtaz </div>

    <div class="comment">montag mmomtaz </div>

    <div class="comment">montag mmomtaz </div>


    </div>

     </div>

     <br><br>


    <!-----end comment--->




</div>
<br><br>


  <!---------end recently added --->

</body>
</html>