<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // تأكد من أن البريد الإلكتروني غير موجود في قاعدة البيانات
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        echo "البريد الإلكتروني مسجل مسبقًا.";
        exit();
    }

    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // إدخال البيانات في قاعدة البيانات
    $sql_insert = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashed_password')";
    if (mysqli_query($conn, $sql_insert)) {
        $_SESSION['username'] = $username;  // تخزين اسم المستخدم في الجلسة
        header("Location: index.html");  // توجيه المستخدم إلى الصفحة الرئيسية
        exit();
    } else {
        echo "حدث خطأ أثناء إنشاء الحساب. يرجى المحاولة مرة أخرى.";
    }
}
?>