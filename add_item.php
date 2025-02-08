<?php
session_start();
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
    <title>إضافة عنصر مفقود</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>إضافة عنصر مفقود</h2>
        <form action="process_lost_item.php" method="POST" enctype="multipart/form-data">
            <label for="item_name">اسم العنصر:</label>
            <input type="text" id="item_name" name="item_name" required placeholder="أدخل اسم العنصر">

            <label for="item_description">الوصف:</label>
            <textarea id="item_description" name="item_description" placeholder="أدخل وصف العنصر"></textarea>

            <label for="item_image">صورة العنصر:</label>
            <input type="file" id="item_image" name="item_image" accept="image/*" required>

            <label for="location">الموقع:</label>
            <input type="text" id="location" name="location" required placeholder="أدخل الموقع">

            <button type="submit">إضافة العنصر</button>
        </form>
    </div>
</body>
</html>