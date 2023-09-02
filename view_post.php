<?php
session_start();

if (!isset($_SESSION['loginID'])) {
    // 로그인되지 않은 사용자
    header('Location: login.html'); // 로그인 페이지로 리디렉션
    exit;
}

$no = $_GET['no'];

$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM board WHERE no='$no'";
$result = mysqli_fetch_array(mysqli_query($conn, $sql));

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
}    
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $result['subject']; ?></title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<style>
  pre {
            font-family: Arial, sans-serif;
            font-size: 30px;
            margin-left: 50px;
            text-align: center;
        }
</style>
<body>
    <br><br><br><br>
    <pre>
        SUBJECT : <?php echo $result['subject'] . "\n"; ?>
        CONTENT: <?php echo $result['content'] . "\n"; ?>
        USER : <?php echo $result['user'] . "\n"; ?>
        DATE : <?php echo $result['reg_date'] . "\n"; ?>
    </pre>
</body>
</html>
