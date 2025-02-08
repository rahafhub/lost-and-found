<?php
session_start();

// إذا لم يكن المستخدم قد سجل الدخول، نوجهه إلى صفحة تسجيل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية - Lost & Found</title>
</head>
<body>
    <h2>مرحبًا بك في نظام Lost & Found</h2>
    <p>مرحبًا، <?php echo $_SESSION['username']; ?>! هل تبحث عن عنصر مفقود؟ أو تريد إضافة عنصر مفقود؟</p>

    <a href="add_item.php">إضافة عنصر مفقود</a> | 
    <a href="view_items.php">عرض العناصر المفقودة</a> | 
    <a href="logout.php">تسجيل الخروج</a>
</body>
</html>