<?php
require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
       
        $stmt = $conn->prepare("INSERT INTO flowers (name, description, image_path) VALUES (?, ?, ?)");
        $stmt->execute([$name, $description, $target_file]);
    
        header("Location: admin.php");
        exit();
    } else {
        echo "Lỗi khi tải ảnh lên.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Loài Hoa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 16px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
            height: 120px;
        }
        input[type="file"] {
            margin-bottom: 20px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Thêm Loài Hoa</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Tên Hoa:</label>
            <input type="text" name="name" required placeholder="Nhập tên hoa...">

            <label>Mô Tả:</label>
            <textarea name="description" required placeholder="Nhập mô tả hoa..."></textarea>

            <label>Hình Ảnh:</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit">Thêm</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>