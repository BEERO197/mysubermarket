<?php
session_start();
include "../include/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">  
    <link rel="stylesheet" href="">    
    <style>    
        <?php include "../style2.css"; ?>   
    </style>
    <meta charset="UTF-8">
    <title>صفحة تسجيل دخول الادمن</title>
</head>
<body>
    <main class="contianer_card">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $AD_email = isset($_POST["email"]) ? $_POST["email"] : '';
            $AD_password = isset($_POST["password"]) ? $_POST["password"] : '';
            $AD_add = isset($_POST["add"]) ? $_POST["add"] : '';

            // التحقق من الحقول الفارغة
            if (empty($AD_email) || empty($AD_password)) {
                echo "<script>alert('ادخل البريد الالكتروني وكلمة المرور');</script>";
            } else {
                // استخدام PDO للتحقق من المستخدم
                $stmt = $db->prepare('SELECT * FROM admin WHERE email = :email AND password = :password');
                $stmt->execute(['email' => $AD_email, 'password' => $AD_password]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    // تعيين جلسة للمستخدم
                    $_SESSION['user_email'] = $user['email'];
                    echo "<script>alert('مرحبا بك ايها المدير سيتم تحويلك الى لوحة التحكم');</script>";
                    header("REFRESH:2;URL=abeer.php");
                    exit();
                } else {
                    echo "<script>alert('عفواً لايمكنك الدخول الي هذة الصفحة سيتم تحويلك الى المتجر');</script>";
                    header("REFRESH:2;URL=../index.php");
                    exit();
                }
            }
        }
        ?>
        <div class="product_card1">
            <div class="logo">
                <h1>تسجيل الدخول</h1>
            </div>
            <form action="aaaa.php" method="post">
                <label class="label1" for="em">: البريد الاكتروني </label>
                <input type="email" name="email" id="em" >
                <label class="label1" for="pass">: كلمة السر</label>
                <input type="password" name="password" id="pass" >
                <button type="submit" name="add" class="button_searsh1">تسجيل الدخول</button>
            </form>
        </div>  
    </main>
</body>
</html>