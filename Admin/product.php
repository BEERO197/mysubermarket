<?php
session_start();
include("../include/connection1.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<?php
// التحقق من وجود معرّف المنتج (id) وحذفه
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM products WHERE id='".$id."'";
    $delete = mysqli_query($conn, $query);
    
    if ($delete) {
        echo '<script>alert("DELETE SUCCESSFULLY OK");</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
    }
}
?>

<div class="sidbar_container">
    
<table dir="rtl">
    <tr>
        <th>الرقم</th>
        <th> صورة</th>
        <th>العنوان </th>
        <th>السعر</th>
        <th>الحجم</th>
        <th>متوفر</th>
        <th>القسم</th>
        <th>تفاصيل</th>
        <th>الكمية</th>
        <th> حذف المنتج</th>
        <th> تعديل المنتج
        </th>
    </tr>
    <?php
    // استعلام لجلب المنتجات من قاعدة البيانات
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

    // معالجة الخطأ في حال فشل الاستعلام
    if (!$result) {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
        die();
    }

    // عرض المنتجات في الجدول
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><img src="../uploads/img/<?php echo $row['image']; ?>"></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td><?php echo $row['prosize']; ?></td>
        <td><?php echo $row['prounv']; ?></td>
        <td><?php echo $row['prosection']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td>
            <form method="POST" action="product.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit" class="delet">حذف </button>
            </form>
        </td> 
        <td><a href="update.php?id=<?php echo $row['id'];?>"><button type="submit" class="UPDATE">تعديل</button></a></td>
    </tr>
    <?php
    }
    ?>
</table>

</div>
<button type="submit" class="UPDATE"><a href="adminpanal.php">RETURN</a></button>

</body>
</html>