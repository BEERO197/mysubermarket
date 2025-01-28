<?php
session_start();
$host = "localhost";
$username = "abeer";
$password = "abeer_zakut";
$dbname = "ecommerce_db";

$conn = mysqli_connect($host, $username, $password, $dbname);
if ($conn) {
    echo "Connection OK";
} else {
    die("Connection NOT OK: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 16px 6px 17px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }
        button {
            width: 100%;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<main>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ADemail = $_POST['email'];
    $ADpassword = $_POST['password'];
    $ADadd = $_POST['add'];

    if (isset($ADadd)) {
        if (empty($ADemail) || empty($ADpassword)) {
            echo '<script>alert("Please enter email and password");</script>';
        } else {
            $query = "SELECT * FROM admins WHERE email='$ADemail' AND password='$ADpassword'";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) == 1) {
                $_SESSION['EMAIL'] = $ADemail;
                echo '<script>alert("Welcome Admin");</script>';
                header("REFRESH:2; URL=adminpanal.php");
            } else {
                echo '<script>alert("Invalid email or password");</script>';
                header("REFRESH:2; URL=../index.php");
            }
        }
    }
}
?>
<div class="container">
    <h1>Login Admin</h1>
    <form action="newadmin.php" method="POST">
        <label for="em">Email</label>
        <input type="email" name="email" id="em">
        <label for="pass">Password</label>
        <input type="text" name="password" id="pass">
        <br>
        <button type="submit" name="add">Login</button>
    </form>
</div>
</main>
</body>
</html>