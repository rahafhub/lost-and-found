<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // إدخال الرسالة في قاعدة البيانات
    $sql = "INSERT INTO contact_messages (name, email, message) 
            VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        echo "تم إرسال الرسالة بنجاح!";
    } else {
        echo "حدث خطأ أثناء إرسال الرسالة: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تواصل معنا</title>
    <link rel="stylesheet" href="style.css">  <!-- استخدام نفس ملف الـ CSS -->
</head>
<body>
    <div class="container">
        <h2>تواصل معنا</h2>
        <form action="contact.php" method="POST">
            <label for="name">الاسم:</label>
            <input type="text" name="name" id="name" required placeholder="أدخل اسمك">
            
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" name="email" id="email" required placeholder="أدخل بريدك الإلكتروني">
            
            <label for="message">الرسالة:</label>
            <textarea name="message" id="message" rows="4" required placeholder="اكتب رسالتك هنا"></textarea>
            
            <button type="submit">إرسال</button>
        </form>
    </div>
</body>
</html>