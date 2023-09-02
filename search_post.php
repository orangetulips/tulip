<?php
session_start();

if (!isset($_SESSION['loginID'])) {
    // 로그인되지 않은 사용자
    header('Location: login.html'); // 로그인 페이지로 리디렉션
    exit;
}

$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "DB connection failed";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
} 

$keyword = $_GET['keyword'];

$return = mysqli_query($conn, "SELECT * FROM board WHERE subject LIKE '%$keyword%'");

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SEARCH CONTENT</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <!-- Bootstrap 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />

    <!-- Font Awesome 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Material Icons 아이콘 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<style>
    p {
        color: white;
        font-weight: bold;
        font-size: 15px;
        text-decoration-line: none;
    }
    a {
            font-family: Arial, sans-serif;
            font-size: 20px;
            margin-left: 50px;
            text-align: center;
            color: black;
            text-decoration: none;
        }
        .back-icon {
            color: rgb(50, 51, 46);
            font-size: 30px;
        }
</style>
</style>
<body>
<br>
    <a href="#" onclick="history.back(); return false;">
        <i class="fas fa-arrow-circle-left back-icon"></i>
    </a><br><br>
    <pre>
        <p>
            SEARCH : <?php echo $keyword . "\n"; ?>
        </p>
        <?php
        while ($result = mysqli_fetch_array($return)) {
        ?>
            <a href="view_post.php?no=<?php echo $result['no']; ?>">NO : <?php echo $result['no']; ?> SUBJECT : <?php echo $result['subject']; ?> USER : <?php echo $result['user']; ?> DATE : <?php echo $result['reg_date']; ?></a><br>
        <?php
        }
        ?>
    </pre>
</body>
</html>
