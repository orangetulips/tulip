<?php
session_start();

if (!isset($_SESSION['loginID'])) {
    // 로그인되지 않은 사용자
    header('Location: login.html'); // 로그인 페이지로 리디렉션
    exit;
}

if ($_SESSION['loginID'] == "") {
    $user = "not login";
} else {
    $user = $_SESSION['loginID'];
}

$subject = $_POST['subject'];
$content = $_POST['content'];

// if ($_SERVER['HTTP_REFERER'] != "http://www.littletulip.website/board.php") {
//     echo "요청하신 경로가 올바르지 않습니다.";
//     exit;
// }

$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "DBMS Connect Fail!";
    exit;
}

$sql = "INSERT INTO board (subject, content, user, reg_date) VALUES ('$subject', '$content', '$user', NOW())";

if (mysqli_query($conn, $sql)) {
    $postID = mysqli_insert_id($conn); // 새로 생성된 게시물의 ID 가져오기
    $viewPostUrl = "http://www.littletulip.website/view_post.php?no=" . $postID; // 상세 페이지 URL 생성

    echo "<script>alert('Success!'); window.location='http://www.littletulip.website/board.php';</script>";
    exit;
} else {
    echo "Failed to Upload Contents: " . mysqli_error($conn);
    echo "<script>alert('Failed to Upload Contents: " . mysqli_error($conn) . "'); window.location='http://www.littletulip.website/board.php';</script>";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
}    

mysqli_close($conn);
?>
