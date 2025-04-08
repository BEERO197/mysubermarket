<?php
session_start();
include("include/connection1.php");
include("file/header2.php");
?>

<main>
    <div class="container_card">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="product_card">
                <div class="card-img">
                    <a href="details2.php?id=<?php echo $row['id']; ?>">
                        <img src="uploads/img/<?php echo $row['image']; ?>">
                        <span class="unavailable"><?php echo $row['prounv']; ?></span>
                    </a>
                </div>
                <div class="product_section">
                    <a href="details2.php?id=<?php echo $row['id']; ?>"><?php echo $row['prosection']; ?></a>
                </div>
                <div class="product_name">
                    <a href="details2.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                </div>
                <div class="product_price">
                    <a href="details2.php?id=<?php echo $row['id']; ?>"><?php echo $row['price']; ?> &nbsp; price</a>
                </div>
                <div class="product_description">
                    <a href="details2.php?id=<?php echo $row['id']; ?>"><i class="fa-solid fa-eye"> </i></a> اضغط هنا للمزيد من التفاصيل
                </div>
                <div class="quantity_input">
                    <form action="cart2.php?action=add&id=<?php echo $row['id']; ?>" method="post">
                        <button class="quantity_count-mins">-</button>
                        <input type="number" value="1" name="quantity" id="quantity" min="1" max="10" style="width: 40px;">
                        <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                        <button class="quantity_count-add">+</button>
                </div>
                <div>
                    <button class="add-to-cart" type="submit" name="add_to_cart" style="margin: 20px;">اضف الي السلة
                        <i class="fa solid fa-cart-plus"></i>
                    </button>
                </div>
                    </form>
            </div>
        <?php
        }
        ?>
    </div>
</main>

<?php include("file/footer2.php"); ?>