<?php
// تأكد من بدء الجلسة
session_start();

// تضمين ملف الاتصال بقاعدة البيانات
include 'db_connection1.php';

if(isset($_POST['complete_order'])) {
    $user_id = $_SESSION['user_id'];
    $total_amount = $_SESSION['total_amount'];
    $order_date = date('Y-m-d H:i:s');
    $order_status = 'مكتملة';

    // إدخال تفاصيل الطلب في قاعدة البيانات
    $sql = "INSERT INTO orders (user_id, total_amount, order_date, order_status) VALUES ('$user_id', '$total_amount', '$order_date', '$order_status')";
    if(mysqli_query($conn, $sql)) {
        echo "تم إتمام الطلب بنجاح!";
    } else {
        echo "خطأ: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!-- كود HTML لزر إتمام الطلب -->
<form method="POST" action="">
    <button type="submit" name="complete_order">إتمام الطلب</button>
</form>
