<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // التحقق من وجود المستخدم في قاعدة البيانات
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) == 1) {
        $row = mysqli_fetch_assoc($result_check);
        
        // التحقق من صحة كلمة المرور
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];  // تخزين اسم المستخدم في الجلسة
            header("Location: index.html");  // توجيه المستخدم إلى الصفحة الرئيسية
            exit();
        } else {
            echo "كلمة المرور غير صحيحة.";
        }
    } else {
        echo "البريد الإلكتروني غير مسجل.";
    }
}
?>