<?php
session_start();

$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

// Get the form data
$id = $_POST['id'];
$pass = $_POST['pass'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}

// Prepare and bind the statement
$stmt = mysqli_prepare($conn, "SELECT id, password FROM tulip_member WHERE id = ?");
mysqli_stmt_bind_param($stmt, "s", $id);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($pass, $row['password'])) {
        echo "WELCOME ;)";
        $_SESSION['loginID'] = $id;
        $redirectUrl = "http://www.littletulip.website/welcome.php";
        header("Location: {$redirectUrl}", true, 301);
        exit;
    } else {
        echo "<script>alert('Check Password.'); window.location='login.html';</script>";
    }
} else {
    echo "<script>alert('No ID Exist.'); window.location='login.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
}    

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>