<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $item_description = $_POST['item_description'];
    $item_location = $_POST['item_location'];

    // معالجة رفع الصورة
    $target_dir = "uploads/";  // تحديد مجلد الصور
    $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // التحقق من نوع الصورة المسموح به
    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
            $sql_insert = "INSERT INTO items (item_name, item_description, item_location, item_image) 
                           VALUES ('$item_name', '$item_description', '$item_location', '$target_file')";
            
            if (mysqli_query($conn, $sql_insert)) {
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