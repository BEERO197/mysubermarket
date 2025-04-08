```php name=cart1.php
<?php
session_start();
include ("include/connection1.php");
include ("file/header.php");

$session_id = session_id();
$check_session_query = "SELECT user_id FROM session_users WHERE session_id = ?";
$check_session_stmt = mysqli_prepare($conn, $check_session_query);
mysqli_stmt_bind_param($check_session_stmt, 's', $session_id);
mysqli_stmt_execute($check_session_stmt);
$check_session_result = mysqli_stmt_get_result($check_session_stmt);

if (mysqli_num_rows($check_session_result) == 0) {
    $insert_session_query = "INSERT INTO session_users (session_id) VALUES (?)";
    $insert_session_stmt = mysqli_prepare($conn, $insert_session_query);
    mysqli_stmt_bind_param($insert_session_stmt, 's', $session_id);
    mysqli_stmt_execute($insert_session_stmt);
    $user_id = mysqli_insert_id($conn);
} else {
    $row = mysqli_fetch_assoc($check_session_result);
    $user_id = $row['user_id'];
}

// Debugging: Check session ID and user ID
echo '<pre>';
echo 'Session ID: ' . htmlspecialchars($session_id) . "\n";
echo 'User ID: ' . htmlspecialchars($user_id) . "\n";
echo '</pre>';

// حذف المنتج من السلة
if (isset($_POST['delete'])) {
    $productname = $_POST['product_name'];
    $delete_cart = "DELETE FROM cart1 WHERE name=? AND session_id=?";
    $delete_cart_stmt = mysqli_prepare($conn, $delete_cart);
    mysqli_stmt_bind_param($delete_cart_stmt, 'ss', $productname, $session_id);
    $result = mysqli_stmt_execute($delete_cart_stmt);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    } else {
        echo '<script>alert("تم حذف المنتج من السلة")</script>';
    }
}

// تعديل كمية المنتج في السلة
if (isset($_POST['update'])) {
    $productname = $_POST['product_name'];
    $new_quantity = $_POST['new_quantity'];
    $update_cart = "UPDATE cart1 SET quantity=? WHERE name=? AND session_id=?";
    $update_cart_stmt = mysqli_prepare($conn, $update_cart);
    mysqli_stmt_bind_param($update_cart_stmt, 'iss', $new_quantity, $productname, $session_id);
    $result = mysqli_stmt_execute($update_cart_stmt);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    } else {
        echo '<script>alert("تم تعديل كمية المنتج في السلة")</script>';
    }
}

// معالجة اتمام الطلب
if (isset($_POST['complete_order'])) {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $payment_method = $_POST['payment_method'];
    $order_date = date('Y-m-d H:i:s');
    $order_status = 'Pending';
    $session_id = session_id();

    $insert_order = "INSERT INTO orders1 (user_id, order_date, total_amount, status, phone, session_id, shipping_address) 
                     VALUES (?, ?, 0, ?, ?, ?, ?)";
    $insert_order_stmt = mysqli_prepare($conn, $insert_order);
    mysqli_stmt_bind_param($insert_order_stmt, 'isssss', $user_id, $order_date, $order_status, $phone, $session_id, $address);

    if ($result = mysqli_stmt_execute($insert_order_stmt)) {
        $order_id = mysqli_insert_id($conn);

        $query_cart = "SELECT * FROM cart1 WHERE session_id=?";
        $query_cart_stmt = mysqli_prepare($conn, $query_cart);
        mysqli_stmt_bind_param($query_cart_stmt, 's', $session_id);
        mysqli_stmt_execute($query_cart_stmt);
        $result_cart = mysqli_stmt_get_result($query_cart_stmt);

        if (mysqli_num_rows($result_cart) > 0) {
            $total_amount = 0;
            while ($row = mysqli_fetch_assoc($result_cart)) {
                $product_id = $row['product_id'];
                $product_price = $row['price'];
                $product_quantity = $row['quantity'];
                $total_amount += $product_price * $product_quantity;

                $insert_order_item = "INSERT INTO orders1_items (order_id, product_id, quantity, price) 
                                      VALUES (?, ?, ?, ?)";
                $insert_order_item_stmt = mysqli_prepare($conn, $insert_order_item);
                mysqli_stmt_bind_param($insert_order_item_stmt, 'iiid', $order_id, $product_id, $product_quantity, $product_price);
                mysqli_stmt_execute($insert_order_item_stmt);
            }

            $update_order = "UPDATE orders1 SET total_amount=? WHERE order_id=?";
            $update_order_stmt = mysqli_prepare($conn, $update_order);
            mysqli_stmt_bind_param($update_order_stmt, 'di', $total_amount, $order_id);
            mysqli_stmt_execute($update_order_stmt);

            $clear_cart = "DELETE FROM cart1 WHERE session_id=?";
            $clear_cart_stmt = mysqli_prepare($conn, $clear_cart);
            mysqli_stmt_bind_param($clear_cart_stmt, 's', $session_id);
            mysqli_stmt_execute($clear_cart_stmt);

            echo '<script>alert("تم اتمام الطلب بنجاح")</script>';
        }
    } else {
        die('Error: ' . mysqli_error($conn));
    }
}

// استعلام للحصول على محتويات السلة من قاعدة البيانات
$query = "SELECT * FROM cart1 WHERE session_id = ?";
$query_stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($query_stmt, 's', $session_id);
mysqli_stmt_execute($query_stmt);
$result = mysqli_stmt_get_result($query_stmt);

if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

$total_price_lyd = 0;

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

    while ($row = mysqli_fetch_assoc($result)) {
        $product_total_price = $row['price'] * $row['quantity'];
        $total_price_lyd += $product_total_price;

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td><img src='uploads/img/" . htmlspecialchars($row['img']) . "' alt='" . htmlspecialchars($row['name']) . "' width='100'></td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>
            <form action='cart1.php' method='post'>
                <input type='hidden' name='product_name' value='" . htmlspecialchars($row['name']) . "'>
                <button type='submit' name='delete' class='delete-btn'><i class='fas fa-trash-alt'></i> حذف</button>
            </form>
        </td>";
        echo "<td>
            <form action='cart1.php' method='post'>
                <input type='hidden' name='product_name' value='" . htmlspecialchars($row['name']) . "'>
                <input type='number' name='new_quantity' value='" . htmlspecialchars($row['quantity']) . "' min='1'>
                <button type='submit' name='update' class='update-btn'><i class='fas fa-edit'></i> تعديل</button>
            </form>
        </td>";
        echo "</tr>";
    }
    echo "<tr>
            <td colspan='6' style='text-align: right;'><strong>المجموع الكلي: " . htmlspecialchars($total_price_lyd) . " دينار ليبي</strong></td>
          </tr>";
    echo "</table>";
} else {
    echo "سلتك فارغة.";
}

include("file/footer.php");
?>