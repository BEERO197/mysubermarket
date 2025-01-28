<?php
session_start();
include("../include/connection1.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['proadd'])) {
    $proname = $_POST['name'];
    $proprice = $_POST['price'];
    $prosection = $_POST['prosection'];
    $prodescrip = $_POST['description'];
    $prosize = $_POST['prosize'];
    $prounv = $_POST['prounv'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];

    if (empty($proname) || empty($proprice) || empty($prosection) || empty($prodescrip) || empty($prosize) || empty($prounv) || empty($quantity)) {
        echo '<script>alert("ENTER ALL FIELDS");</script>';
    } else {
        $proimg = rand(0, 5000) . "_" . $imageName;
        if (move_uploaded_file($imageTmp, "../uploads/img/" . $proimg)) {
            $query = "INSERT INTO products (name, image, price, prosection, description, prosize, prounv, quantity) 
                      VALUES ('$proname', '$proimg', '$proprice', '$prosection', '$prodescrip', '$prosize', '$prounv', '$quantity')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo '<script>alert("ADD PRODUCT SUCCESSFULLY");</script>';
            } else {
                echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
            }
        } else {
            echo '<script>alert("Failed to upload image.");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style1.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD PRODUCTS</title>
</head>
<body>
    <center>
        <main>
            <div class="form_product">
                <h1>ADD PRODUCT</h1>
                <form action="addproduct.php" method="POST" enctype="multipart/form-data">
                    <label for="name">Address of Product</label>
                    <input type="text" name="name" id="name">

                    <label for="file">Image of Product</label>
                    <input type="file" name="image" id="file">

                    <label for="price">Price of Product</label>
                    <input type="number" name="price" id="price">

                    <label for="description">Description of Product</label>
                    <input type="text" name="description" id="description">

                    <label for="prosize">Size of Product</label>
                    <input type="text" name="prosize" id="prosize">

                    <label for="quantity">Quantity of Product</label>
                    <input type="number" name="quantity" id="quantity">

                    <label for="prounv">Availability of Product</label>
                    <input type="text" name="prounv" id="prounv">

                    <div>
                        <label for="form_control">Section of Product</label>
                        <select name="prosection" id="form_control">
                            <?php
                            $query = "SELECT * FROM section";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['section_name'] . '">' . $row['section_name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div><br><br>

                    <button class="button" type="submit" name="proadd">ADD PRODUCT NOW</button>
                </form>
            </div>
        </main>
    </center>
</body>
</html>