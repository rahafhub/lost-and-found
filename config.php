<?php
$servername = "localhost";
$username = "root";  // عادة يكون الإسم الافتراضي لـ XAMPP
$password = "";      // إذا لم تكن قد وضعت كلمة مرور في XAMPP
$dbname = "lost_and_found";  // تأكد من أن اسم قاعدة البيانات هو نفسه الذي أنشأته سابقًا

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>