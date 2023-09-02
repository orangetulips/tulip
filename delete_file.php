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
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file_id = $_POST['file_id'];

    // 파일 정보 가져오기
    $sql = "SELECT * FROM file WHERE id = '$file_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $file_name = $file['name'];

        // 파일 삭제
        $file_path = "/var/www/html/upfile/" . $file_name;
        if (file_exists($file_path) && unlink($file_path)) {
            // 파일 삭제 성공
            $delete_sql = "DELETE FROM file WHERE id = '$file_id'";
            if (mysqli_query($conn, $delete_sql)) {
                // 파일 데이터 삭제 성공
                echo "<script>alert('File deleted successfully'); window.location='search_file.php';</script>";
                exit;
            } else {
                // 파일 데이터 삭제 실패
                echo "<script>alert('Failed to delete file data: " . mysqli_error($conn) . "'); window.location='search_file.php';</script>";
                exit;
            }
        } else {
            // 파일 삭제 실패 또는 파일이 존재하지 않음
            echo "<script>alert('Failed to delete file or file not found: $file_path'); window.location='search_file.php';</script>";
            exit;
        }
    } else {
        // 파일 데이터가 없음
        echo "<script>alert('File not found'); window.location='search_file.php';</script>";
        exit;
    }
}


mysqli_close($conn);
?>
