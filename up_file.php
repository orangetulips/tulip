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

$name = mysqli_real_escape_string($conn, $_FILES['upfile']['name']);
$tmp_name = $_FILES['upfile']['tmp_name'];
$size = $_FILES['upfile']['size'];

$sql = "INSERT INTO file SET 
        name='$name',
        user='$_SESSION[loginID]',
        size='$size',
        reg_date=NOW()";

$result = mysqli_query($conn, $sql);

if($result) {
    // insert 성공
    $move_result = move_uploaded_file($tmp_name, "/var/www/html/upfile/$name");
    if($move_result){
        echo "<script>alert('success to upload file'); window.location='file.php';</script>";
    } else {
        echo "<script>alert('failed to upload file(move)'); window.location='file.php';</script>";
    }
} else {
    // insert 실패
    echo "<script>alert('failed to upload file'); window.location='file.php';</script>";
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
}    

mysqli_close($conn);
?>
