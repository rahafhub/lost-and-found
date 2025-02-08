<?php
include('config.php');
session_start();  // بدء الجلسة

// إذا لم يكن المستخدم قد سجل الدخول، يتم توجيهه إلى صفحة تسجيل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM lost_items ORDER BY date_added DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض العناصر المفقودة</title>
    <link rel="stylesheet" href="style.css"> <!-- رابط إلى ملف CSS لجعل الصفحة متناسقة -->
</head>
<body>

    <h2>العناصر المفقودة</h2>

    <table>
        <thead>
            <tr>
                <th>اسم العنصر</th>
                <th>الوصف</th>
                <th>الصورة</th>
                <th>الموقع</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // عرض العناصر المفقودة في جدول
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . $row['item_description'] . "</td>";
                    echo "<td><img src='" . $row['item_image'] . "' alt='Image' width='100'></td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['date_added'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>لا توجد عناصر مفقودة في الوقت الحالي.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>