<?php
session_start();

if (!isset($_SESSION['loginID'])) {
    // 로그인되지 않은 사용자
    header('Location: login.html'); // 로그인 페이지로 리디렉션
    exit;
}

$token = md5(time());
$_SESSION['antitoken'] = $token;

$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM tulip_member WHERE id = '$_SESSION[loginID]'";
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
    <title>UpdateMyInfo</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <!-- Bootstrap 아이콘 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />

<!-- Font Awesome 아이콘 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<!-- Material Icons 아이콘 -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<style>
         body {
            background-image: url('red_tulip.jpg');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: center;
            color: white;
        }
                /* Optional: Adjust the height of the body element to fill the viewport */
    html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
    pre {
        color: white;
        font-weight: bold;
        font-size: 30px;
        font-family: Arial, sans-serif;
        text-decoration-line: none;
        text-align: center;
    }
    .home-icon {
            color: rgb(50, 51, 46);
            font-size: 30px;
        }
    a {
            font-family: Arial, sans-serif;
            font-size: 30px;
            margin-left: 50px;
            text-align: center;
     }
</style>
<body>
    <br>
    <a href="welcome.php">
    <i class="bi bi-house-fill home-icon"></i> <!-- Bootstrap 아이콘 -->
    <i class="fas fa-home home-icon"></i> <!-- Font Awesome 아이콘 -->
        </a><br><br>
    <form method="post" action="member_update.php">
        <pre>
            ID : <?php echo $result['id'] . "\n"; ?>
            PASSWORD : <input type="password" name="pass">
            REPASSWORD : <input type="password" name="pass">
            NAME : <input type="text" name="name">
            EMAIL : <?php echo $result['email'] . "\n"; ?>
            PHONE : <form method="post" action="auth_phone.php"><input type="hidden" name="antitoken" value="<?php echo $token; ?>"><input type="text" name="phone" placeholder="PHONE NUMBER">  <input type="submit" class="btn btn-primary" value="Send Verification Code"></form>
            COUNTRY : <input type="text" name="country" value="<?php echo $result['country'] . "\n"; ?>"><br>
            <input type="submit" class="btn btn-dark" value="UPDATE"> <input type="reset" class="btn btn-danger" value="CANCEL">
            <input type="hidden" name="antitoken" value="<?php echo $token; ?>">
        </pre>
    </form>
</body>
</html>
