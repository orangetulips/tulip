<?php
$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

$conn = mysqli_connect($servername, $username, $password, $dbname);

session_start();

if($_SESSION['loginID'] == "") {
    echo "<script>alert('You can use this feature after logging in.'); location.href='/'</script>";
    exit;
}

$file_id = $_GET['id'];

// 파일 정보 가져오기
$sql = "SELECT * FROM file WHERE id = $file_id";
$result = mysqli_query($conn, $sql);
$file = mysqli_fetch_assoc($result);

if (!$file) {
    echo "<script>alert('File not found.'); window.location='file.php';</script>";
    exit;
}

// 파일 삭제
$delete_sql = "DELETE FROM file WHERE id = $file_id";
$delete_result = mysqli_query($conn, $delete_sql);

if ($delete_result) {
    // 파일이 삭제되면 실제 파일도 삭제
    $file_path = "/var/www/html/upfile/" . $file['name'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }
    echo "<script>alert('File deleted successfully.'); window.location='file.php';</script>";
} else {
    echo "<script>alert('Failed to delete file.'); window.location='file.php';</script>";
}

mysqli_close($conn);
?>
