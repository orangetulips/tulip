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

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $sql = "SELECT * FROM file WHERE NAME LIKE '%" . $keyword . "%'";
    $return = mysqli_query($conn, $sql);
} else {
    $keyword = ""; // 키워드가 없는 경우에는 빈 문자열로 초기화
    $return = null; // 결과가 없는 경우에는 null로 초기화
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
}    
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEARCH FILE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <!-- Bootstrap 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />

    <!-- Font Awesome 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Material Icons 아이콘 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
</head>
<style>
            a {
            font-family: Arial, sans-serif;
            margin-left: 50px;
            text-align: center;
        }
        .back-icon {
            color: rgb(50, 51, 46);
            font-size: 30px;
        }
</style>
<body>
    <br>
    <a href="#" onclick="history.back(); return false;">
        <i class="fas fa-arrow-circle-left back-icon"></i>
    </a><br><br>
    <pre>
        RESULT : <?php echo $keyword . "\n"; ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // delete 요청이 들어온 경우
            header('HTTP/1.1 404 Method Not Allowed');
            exit;
        } 

        if ($return) {
            while ($result = mysqli_fetch_array($return)) {
        ?>
            NO. <?php echo $result['id'] . "\n"; ?>
            NAME. <a href="down_file.php?name=<?php echo $result['name']; ?>"><?php echo $result['name'] . "\n"; ?></a>
            SIZE. <?php echo $result['size'] . "\n"; ?>
            USER. <?php echo $result['user'] . "\n"; ?>
            DATE. <?php echo $result['reg_date'] . "\n"; ?>
            <form method="post" action="delete_file.php">
                <input type="hidden" name="file_id" value="<?php echo $result['id']; ?>">
                <input type="submit" value="Delete">
            </form>
            <br>
        <?php
            }
        } else {
            echo "No results found.";
        }
        ?>
    </pre>
</body>
</html>
