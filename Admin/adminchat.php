<?php
session_start();

// تحقق مما إذا كان المستخدم مسجل دخول أم لا
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: adminpanal.php");
    exit();
}

// معلومات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "abeer";
$password = "abeer_zakut";
$dbname = "ecommerce_db";

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق مما إذا تم إرسال البيانات عبر النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الحصول على البيانات من النموذج
    $email = $_POST['ADemail'];
    $password = $_POST['ADpassword'];

    // إعداد جملة SQL للتحقق من البريد الإلكتروني وكلمة المرور
    $sql = "SELECT * FROM admins WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // التحقق من النتائج
    if ($result->num_rows > 0) {
        // تسجيل الدخول ناجح
        $_SESSION['admin_logged_in'] = true;

        echo "<script>alert('مرحبا بك ايها المدير سيتم تحويلك الى لوحة التحكم');</script>";
        header("REFRESH:2;URL=adminpanal.php");
        exit();
    } else {
        echo "<script>alert('عفواً لايمكنك الدخول الي هذة الصفحة سيتم تحويلك الى المتجر');</script>";
        header("REFRESH:2;URL=../index.php");
        exit();
    }

    // إغلاق الاتصال
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style1.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
</head>
<body>
<center>
<br><br>
<div style="background-color:grey;width:500px;border-bottom: 1px solid #fff;">
<form action="admin.php" method="post">
<br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="ADemail" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="ADpassword" required><br><br>
    <button type="submit">Login</button><br><br>
</form>
</div>
</center>
</body>
</html>