<?php
$host = "localhost";
$username = "abeer";
$password = "abeer_zakut";
$dbname = "ecommerce_db";

// تصحيح اسم المتغير dbname إلى $dbname
$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn) {
    echo "Connection OK";
} else {
    echo "Connection NOT OK";
}

session_start();
echo "<h1>Control Panel</h1>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">  
    <link rel="stylesheet" href="style1.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel for Admin</title>
</head>
<body>
    <?php
    if (isset($_SESSION['EMAIL'])) {
        header('location:../index.php');
    } else {
    ?>

    <?php
    // التأكد من أن بيانات النموذج تم استلامها بشكل صحيح
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $section_name = $_POST['section_name'];
        $secadd = isset($_POST['secadd']) ? $_POST['secadd'] : null;
        
        if ($secadd) {
            if (empty($section_name)) {
                echo '<script>alert("Please enter the field");</script>';
            } elseif (strlen($section_name) > 100) {
                echo '<script>alert("Field is too long");</script>';
            } else {
                $query = "INSERT INTO section (section_name) VALUES ('$section_name')";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    echo '<script>alert("Field inserted successfully");</script>';
                } else {
                    echo '<script>alert("Error inserting field");</script>';
                }
            }
        }
    }
    ?>
    <!-- Sidebar start -->
    <div class="sidebar_container">
        <div class="sidebar">
            <center><h1>Control Panel</h1></center>
            <ul>
                <li><a href="../index.php" target="_blank">Home Page <i class="fa-solid fa-house-chimney"></i></a></li>
                <li><a href="" target="_blank">Order Page <i class="fa-solid fa-folder-open"></i></a></li>
                <li><a href="" target="_blank">User Info <i class="fa-solid fa-users"></i></a></li>
                <li><a href="" target="_blank">Products Page <i class="fa-solid fa-gift"></i></a></li>
                <li><a href="" target="_blank">Add Product <i class="fa-solid fa-plus"></i></a></li>
                <li><a href="logout.php" target="_blank">Logout <i class="fa-solid fa-share-from-square"></i></a></li>
            </ul>
        </div>

        <!-- Section start -->
        <div class="content_sec">
            <form action="adminpanal.php" method="post">
                <label for="section">Add New Part</label>
                <input type="text" name="section_name" id="section">
                <br>
                <button class="add" type="submit" name="secadd">Add Part</button>
            </form>

            <!-- Table start -->
            <table dir="rtl">
                <tr>
                    <th>ID</th>
                    <th>Name Part</th>
                    <th>Delete Part</th>
                </tr>
                <?php
                $query = "SELECT * FROM section";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['section_name']; ?></td>
                        <td><a href=""><button type="submit" class="delet">DELETE PART</button></a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <!-- Table end -->
        </div>
        <!-- Section end -->
    </div>
    <?php
    }
    ?>
</body>
</html>