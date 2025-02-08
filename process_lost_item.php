<?php
session_start();
include('config.php'); // للتواصل مع قاعدة البيانات

// إذا لم يكن المستخدم قد سجل الدخول، يتم توجيهه إلى صفحة تسجيل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// التحقق من أن البيانات قد أُرسلت عبر POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $item_name = $_POST['item_name'];
    $item_description = $_POST['item_description'];
    $location = $_POST['location'];

    // معالجة رفع الصورة
    $target_dir = "uploads/";  // مجلد تحميل الصور
    $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // التحقق من نوع الصورة
    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        // محاولة رفع الصورة
        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
            // إدخال البيانات في قاعدة البيانات
            $username = $_SESSION['username']; // اسم المستخدم المسجل
            $sql = "INSERT INTO lost_items (item_name, item_description, item_image, location, user) 
                    VALUES ('$item_name', '$item_description', '$target_file', '$location', '$username')";

            if (mysqli_query($conn, $sql)) {
                echo "تم إضافة العنصر بنجاح!";
            } else {
                echo "خطأ في إضافة العنصر: " . mysqli_error($conn);
            }
        } else {
            echo "حدث خطأ في رفع الصورة.";
        }
    } else {
        echo "الصورة غير صالحة. يجب أن تكون بصيغة JPG أو PNG أو JPEG أو GIF.";
    }
}
?>