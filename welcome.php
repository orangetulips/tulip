<?php
session_start();

if (!isset($_SESSION['loginID'])) {
    // 로그인되지 않은 사용자
    header('Location: login.html'); // 로그인 페이지로 리디렉션
    exit;
}

// 세션을 확인하여 로그인 여부를 확인하거나 필요한 정보를 가져올 수 있습니다.
if (isset($_SESSION['loginID'])) {
    $loginID = $_SESSION['loginID'];

    // 로그인한 사용자에게 보여줄 내용이 있는 경우
    // 예: 사용자 정보를 가져와서 환영 메시지 표시
    $welcomeMessage = "Welcome, $loginID!";
} else {
    // 로그인하지 않은 사용자에게 보여줄 내용이 있는 경우
    // 예: 로그인을 유도하는 메시지
    $welcomeMessage = "Welcome! Please log in.";
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
    <title>WELCOME</title>
    <style>
        a {
            font-family: Arial, sans-serif;
            font-size: 30px;
            margin-left: 50px;
            text-align: center;
        }
        body {
            background-image: url('red_tulip.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
        }
        /* Optional: Adjust the height of the body element to fill the viewport */
    html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
        .home-icon {
            color: rgb(50, 51, 46);
        }
        .logout-icon {
            color: rgb(50, 51, 46);
        }
    </style>
</head>
<body>
    <br>
    <a href="welcome.php">
    <i class="bi bi-house-fill home-icon"></i> <!-- Bootstrap 아이콘 -->
    <i class="fas fa-home home-icon"></i> <!-- Font Awesome 아이콘 -->
    </a><br>
    <a href="logout.php">
    <i class="fas fa-sign-out-alt logout-icon"></i>
    </a>
        <br><br>
    <a href="member_only.php" class="btn btn-outline-info">UPDATE MYINFO</a><br><br><br><br>
    <a href="board.php" class="btn btn-outline-secondary">CONTENTS</a><br><br>
    <a href="file.php" class="btn btn-outline-secondary">UPLOAD FILE</a><br><br>
    <a href="game.php" class="btn btn-outline-secondary">GAME</a><br><br>
    <a href="insert.php" class="btn btn-outline-secondary">CHARGE</a><br><br><br><br>
    </a>
</body>
<a><h2>HELLO EVERYONE!<br>
WELCOME TO TULIP'S FARM.<br>
TRY TO HACK MY WEBSITE. BUT NO DOS ATTACK!<br>
ALSO YOU CAN CHANGE EVERYTHING ON THIS WEBSITE IF YOU CAN ;)<br>
(SUCH AS BACKGROUND COLOR, IMG ETC...)<br>
ENJOY THE HACKING!
</h2><a>
</html>