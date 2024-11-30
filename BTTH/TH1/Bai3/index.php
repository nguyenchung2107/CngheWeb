<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlisinhvien";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        h2 {
            text-align: center; /* Căn giữa tiêu đề */
        }
</style>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Danh Sách Tài Khoản</h2>

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>City</th>
                        <th>Email</th>
                        <th>Course ID</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["password"] . "</td>
                    <td>" . $row["lastname"] . "</td>
                    <td>" . $row["firstname"] . "</td>
                    <td>" . $row["city"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["course_id"] . "</td>
                  </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>Không có dữ liệu!</div>";
        }

        $conn->close();
        ?>

    </div>
</body>

</html>