<?php
require 'includes/db.php';

$stmt = $conn->prepare("SELECT * FROM flowers");
$stmt->execute();
$flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Loài Hoa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 2px;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }

        .add-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .add-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Quản Lý Loài Hoa</h1>

       
        <a href="creat.php"><button class="add-btn">Thêm Loài Hoa</button></a>

       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                    <th>Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = $_GET['search'];
                    $stmt = $conn->prepare("SELECT * FROM flowers WHERE name LIKE ?");
                    $stmt->execute(['%' . $search . '%']);
                    $flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

                
                foreach ($flowers as $flower) {
                    echo "<tr>
                        <td>{$flower['id']}</td>
                        <td>{$flower['name']}</td>
                        <td>{$flower['description']}</td>
                        <td><img src='{$flower['image_path']}' alt='{$flower['name']}' width='100px'></td>
                        <td>
                            <a href='edit.php?id={$flower['id']}'><button class='action-btn edit-btn'>Sửa</button></a>
                            <a href='delete.php?id={$flower['id']}'><button class='action-btn delete-btn'>Xóa</button></a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>


</body>
</html>
