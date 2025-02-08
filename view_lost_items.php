<?php
session_start(); // بدء الجلسة

// إذا لم يكن المستخدم قد سجل الدخول، يتم توجيهه إلى صفحة تسجيل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// الاتصال بقاعدة البيانات
include('config.php');

// استرجاع العناصر المفقودة من قاعدة البيانات
$sql = "SELECT * FROM lost_items ORDER BY date_added DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>العناصر المفقودة</title>
    <link rel="stylesheet" href="style.css"> <!-- رابط إلى ملف CSS لجعل الصفحة متناسقة -->
</head>
<body>

    <div class="container">
        <h2>العناصر المفقودة</h2>

        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>اسم العنصر</th><th>الوصف</th><th>الموقع</th><th>التاريخ</th><th>الحالة</th></tr>";

            // عرض العناصر في جدول
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . $row['item_description'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['date_added'] . "</td>";
                echo "<td>" . ($row['status'] == 'lost' ? 'مفقود' : 'موجود') . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>لا توجد عناصر مفقودة حالياً.</p>";
        }
        ?>

    </div>

</body>
</html>