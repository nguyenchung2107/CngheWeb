<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'includes/db.php'; 

    $stmt = $pdo->query("select id, answer from questions"); 
    $answers = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

    $score = 0;
   
    foreach ($_POST as $key => $userAnswer) {
        $questionId = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT); 
        if (isset($answers[$questionId]) && $answers[$questionId] === $userAnswer) {
            $score++;
        }
    }

    $total = count($answers); 
    echo "<!DOCTYPE html>
    <html lang='vi'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Kết quả Trắc Nghiệm</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                padding-top: 50px;
            }
            .alert {
                font-size: 18px;
                font-weight: bold;
            }
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #0056b3;
            }
            .footer {
                text-align: center;
                margin-top: 50px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1 class='text-center mb-4'>Kết quả Bài Trắc Nghiệm</h1>";
    echo "<div class='alert alert-success text-center'>";
    echo "Bạn trả lời đúng <strong>$score</strong>/$total câu."; 
    echo "</div>";
    echo "<a href='index.php' class='btn btn-primary'>Làm lại</a>";

    echo "<div class='footer'>
            <p>© 2024 Bộ câu hỏi trắc nghiệm</p>
          </div>
        </div>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";
}
?>