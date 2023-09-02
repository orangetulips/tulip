<?php
session_start();

if (!isset($_SESSION['loginID'])) {
    // 로그인되지 않은 사용자
    header('Location: login.html'); // 로그인 페이지로 리디렉션
    exit;
}

$pass = $_POST['pass'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$country = $_POST['country'];

$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo "DBMS Connect Fail!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
} 

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if the password needs to be updated
    if ($pass != "") {
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE tulip_member SET
                password = '$hashed_password',
                name = '$name',
                phone = '$phone',
                country = '$country'
                WHERE id = '$_SESSION[loginID]'";
    } else {
        $sql = "UPDATE tulip_member SETㄴ
                name = '$name',
                phone = '$phone',
                country = '$country'
                WHERE id = '$_SESSION[loginID]'";
    }

    $return = mysqli_query($conn, $sql);
    if ($return) {
        echo "<script>alert('Success to Update'); window.location='http://www.littletulip.website/member_only.php';</script>";
        exit;
    } else {
        echo mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

