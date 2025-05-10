<?php
session_start();
include("include/connection1.php");

if (isset($_POST['add_to_cart'])) {
    $product_id = $_GET['id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['quantity'];
    $session_id = session_id();

    $check_cart_query = "SELECT * FROM cart1 WHERE product_id='$product_id' AND session_id='$session_id'";
    $check_cart_result = mysqli_query($conn, $check_cart_query);

    if (mysqli_num_rows($check_cart_result) > 0) {
        $update_cart_query = "UPDATE cart1 SET quantity=quantity + $product_quantity WHERE product_id='$product_id' AND session_id='$session_id'";
        mysqli_query($conn, $update_cart_query);
    } else {
        $insert_cart_query = "INSERT INTO cart1 (product_id, name, price, img, quantity, session_id) VALUES ('$product_id', '$product_name', '$product_price', '$product_image', '$product_quantity', '$session_id')";
        mysqli_query($conn, $insert_cart_query);
    }
    header("Location: cart2.php");
}

if (isset($_POST['delete'])) {
    $product_name = $_POST['product_name'];
    $delete_cart_query = "DELETE FROM cart1 WHERE name='$product_name' AND session_id='$session_id'";
    mysqli_query($conn, $delete_cart_query);
}

if (isset($_POST['update'])) {
    $product_name = $_POST['product_name'];
    $new_quantity = $_POST['new_quantity'];
    $update_cart_query = "UPDATE cart1 SET quantity='$new_quantity' WHERE name='$product_name' AND session_id='$session_id'";
    mysqli_query($conn, $update_cart_query);
}

include("file/header2.php");
?>

<main>
    <h1>سلتك</h1>
    <?php
    $session_id = session_id();
    $query = "SELECT * FROM cart1 WHERE session_id='$session_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
        <tr>
        <th>اسم المنتج</th>
        <th>السعر</th>
        <th>الصورة</th>
        <th>الكمية</th>
        <th>حذف المنتج</th>
        <th>تعديل الكمية</th>
        </tr>";

        $total_price = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $product_total_price = $row['price'] * $row['quantity'];
            $total_price += $product_total_price;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td><img src='uploads/img/" . htmlspecialchars($row['img']) . "' alt='" . htmlspecialchars($row['name']) . "' width='100'></td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>
                <form action='cart2.php' method='post'>
                    <input type='hidden' name='product_name' value='" . htmlspecialchars($row['name']) . "'>
                    <button type='submit' name='delete' class='delete-btn'><i class='fas fa-trash-alt'></i> حذف</button>
                </form>
            </td>";
            echo "<td>
                <form action='cart2.php' method='post'>
                    <input type='hidden' name='product_name' value='" . htmlspecialchars($row['name']) . "'>
                    <input type='number' name='new_quantity' value='" . htmlspecialchars($row['quantity']) . "' min='1'>
                    <button type='submit' name='update' class='update-btn'><i class='fas fa-edit'></i> تعديل</button>
                </form>
            </td>";
            echo "</tr>";
        }
        echo "<tr<?php
session_start();
include("include/connection1.php");

if (isset($_POST['add_to_cart'])) {
    $product_id = $_GET['id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['quantity'];
    $session_id = session_id();

    $check_cart_query = "SELECT * FROM cart1 WHERE product_id='$product_id' AND session_id='$session_id'";
    $check_cart_result = mysqli_query($conn, $check_cart_query);

    if (mysqli_num_rows($check_cart_result) > 0) {
        $update_cart_query = "UPDATE cart1 SET quantity=quantity + $product_quantity WHERE product_id='$product_id' AND session_id='$session_id'";
        mysqli_query($conn, $update_cart_query);
    } else {
        $insert_cart_query = "INSERT INTO cart1 (product_id, name, price, img, quantity, session_id) VALUES ('$product_id', '$product_name', '$product_price', '$product_image', '$product_quantity', '$session_id')";
        mysqli_query($conn, $insert_cart_query);
    }
    header("Location: cart2.php");
}

if (isset($_POST['delete'])) {
    $product_name = $_POST['product_name'];
    $delete_cart_query = "DELETE FROM cart1 WHERE name='$product_name' AND session_id='$session_id'";
    mysqli_query($conn, $delete_cart_query);
}

if (isset($_POST['update'])) {
    $product_name = $_POST['product_name'];
    $new_quantity = $_POST['new_quantity'];
    $update_cart_query = "UPDATE cart1 SET quantity='$new_quantity' WHERE name='$product_name' AND session_id='$session_id'";
    mysqli_query($conn, $update_cart_query);
}

include("file/header2.php");
?>

<main>
    <h1>سلتك</h1>
    <?php
    $session_id = session_id();
    $query = "SELECT * FROM cart1 WHERE session_id='$session_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
        <tr>
        <th>اسم المنتج</th>
        <th>السعر</th>
        <th>الصورة</th>
        <th>الكمية</th>
        <th>حذف المنتج</th>
        <th>تعديل الكمية</th>
        </tr>";

        $total_price = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $product_total_price = $row['price'] * $row['quantity'];
            $total_price += $product_total_price;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td><img src='uploads/img/" . htmlspecialchars($row['img']) . "' alt='" . htmlspecialchars($row['name']) . "' width='100'></td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>
                <form action='cart2.php' method='post'>
                    <input type='hidden' name='product_name' value='" . htmlspecialchars($row['name']) . "'>
                    <button type='submit' name='delete' class='delete-btn'><i class='fas fa-trash-alt'></i> حذف</button>
                </form>
            </td>";
            echo "<td>
                <form action='cart2.php' method='post'>
                    <input type='hidden' name='product_name' value='" . htmlspecialchars($row['name']) . "'>
                    <input type='number' name='new_quantity' value='" . htmlspecialchars($row['quantity']) . "' min='1'>
                    <button type='submit' name='update' class='update-btn'><i class='fas fa-edit'></i> تعديل</button>
                </form>
            </td>";
            echo "</tr>";
        }
        echo "<tr>
                <td colspan='6' style='text-align: right;'><strong>المجموع الكلي: " . htmlspecialchars($total_price) . " دينار ليبي</strong></td>
              </tr>";
        echo "</table>";
    } else {
        echo "سلتك فارغة.";
    }
    ?>
    <br>
    <a href="checkout2.php">إتمام الطلب</a>
</main>

<?php include("file/footer2.php"); ?>>
                <td colspan='6' style='text-align: right;'><strong>المجموع الكلي: " . htmlspecialchars($total_price) . " دينار ليبي</strong></td>
              </tr>";
        echo "</table>";
    } else {
        echo "سلتك فارغة.";
    }
    ?>
    <br>
    <a href="checkout2.php">إتمام الطلب</a>
</main>

<?php include("file/footer2.php"); ?>