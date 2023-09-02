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

session_start();
if (!$conn) {
    echo "DB 연결 실패: " . mysqli_connect_error();
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
} 

$no = $_GET['no'];

$sql = "SELECT * FROM board WHERE no='$no'";
$result = mysqli_fetch_array(mysqli_query($conn, $sql));

if ($result) {
    $sql = "DELETE FROM board WHERE no='$no'";
    $return = mysqli_query($conn, $sql);

    if ($return) {
        echo "<script>alert('Success!'); window.location='http://www.littletulip.website/board.php';</script>";
        exit;
    } else {
        echo "<script>alert('" . mysqli_error($conn) . "'); window.location='http://www.littletulip.website/board.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Failed To Delete Contents'); window.location='http://www.littletulip.website/board.php';</script>";
    exit;
}

mysqli_close($conn);
?>

