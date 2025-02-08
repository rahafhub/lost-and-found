<?php
session_start(); // بدء الجلسة

// إذا لم يكن المستخدم قد سجل الدخول، يتم توجيهه إلى صفحة تسجيل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// الاتصال بقاعدة البيانات
include('config.php');

// استرجاع الرسائل من قاعدة البيانات
$sql = "SELECT * FROM contact_messages ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الرسائل</title>
    <link rel="stylesheet" href="style.css"> <!-- رابط إلى ملف CSS لجعل الصفحة متناسقة -->
</head>
<body>

    <div class="container">
        <h2>الرسائل المرسلة</h2>

        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>الاسم</th><th>البريد الإلكتروني</th><th>الرسالة</th><th>التاريخ</th></tr>";

            // عرض الرسائل في جدول
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "<td>" . $row['date_sent'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>لا توجد رسائل حالياً.</p>";
        }
        ?>

    </div>

</body>
</html>