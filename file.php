<?php
session_start();

if (!isset($_SESSION['loginID'])) {
    // 로그인되지 않은 사용자
    header('Location: login.html'); // 로그인 페이지로 리디렉션
    exit;
}
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // delete 요청이 들어온 경우
        header('HTTP/1.1 404 Method Not Allowed');
        exit;
    }    
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <!-- Bootstrap 아이콘 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />

<!-- Font Awesome 아이콘 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<!-- Material Icons 아이콘 -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <title>UPLOAD</title>
    <style>
            a {
            font-size: 30px;
            margin-left: 50px;
            text-align: center;
        }
        .home-icon {
            color: rgb(50, 51, 46);
        }
        pre{
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .form-container {
            border: 2px solid black;
            padding: 70px;
            margin: 20px auto;
            width: max-content;
            text-align: center;
        }
    </style>
</head>
<body>
<br>
    <a href="welcome.php">
    <i class="bi bi-house-fill home-icon"></i> <!-- Bootstrap 아이콘 -->
    <i class="fas fa-home home-icon"></i> <!-- Font Awesome 아이콘 -->
    </a><br>
    <div class="form-container">
<pre>
<h1>UPLOAD FILE</h1>
        <form method ="post" action="search_file.php">
            SEARCH : <input type="text" name="keyword">

            <input type="submit" class="btn btn-warning" value="Search"> <input type="reset" class="btn btn-danger" value="Cancel">
        </form>
        <form method="post" action="up_file.php" enctype="multipart/form-data">
            <input type="file"  name="upfile"><br>
            <input type="submit" class="btn btn-dark" value="Upload"> <input type="reset" class="btn btn-danger" value="Cancel">
    </pre>
    </div>
</body>
</html>