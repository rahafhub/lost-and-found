<?php
session_start(); // بدء الجلسة

// إذا لم يكن المستخدم قد سجل الدخول، يتم توجيهه إلى صفحة تسجيل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('config.php');

// استرجاع بيانات المستخدم
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // تحديث البيانات
    $sql = "UPDATE users SET email = '$email', password = '$password' WHERE username = '$username'";

    if (mysqli_query($conn, $sql)) {
        echo "تم تحديث البيانات بنجاح!";
    } else {
        echo "حدث خطأ أثناء التحديث: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديث البيانات</title>
    <link rel="stylesheet" href="style.css"> <!-- رابط إلى ملف CSS لجعل الصفحة متناسقة -->
</head>
<body>

    <div class="container">
        <h2>تحديث بياناتك</h2>

        <form method="POST" action="update_profile.php">
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="password">كلمة المرور الجديدة:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">تحديث البيانات</button>
        </form>
    </div>

</body>
</html>