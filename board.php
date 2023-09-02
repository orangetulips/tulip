<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Board</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- Bootstrap 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />

    <!-- Font Awesome 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Material Icons 아이콘 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
</head>
<style>
        .home-icon {
            color: rgb(50, 51, 46);
            font-size: 30px;
        }
        a {
            font-family: Arial, sans-serif;
            font-size: 20px;
            margin-left: 50px;
            text-align: center;
            color: black;
            text-decoration: none;
        }
</style>
<body>
    <br>
    <a href="welcome.php">
    <i class="bi bi-house-fill home-icon"></i> <!-- Bootstrap 아이콘 -->
    <i class="fas fa-home home-icon"></i><!-- Font Awesome 아이콘 -->
    </a>
    <br><br><br>
    <div class="container">
        <form method="post" action="create_post.php">
            <div class="mb-3">
                <label for="subject" class="form-label">SUBJECT :</label>
                <input type="text" class="form-control" id="subject" name="subject">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">CONTENT :</label>
                <textarea class="form-control" id="content" rows="5" cols="100" name="content"></textarea>
            </div>
            <input type="submit" class="btn btn-success" value="Submit">
            <input type="reset" class="btn btn-danger" value="Cancel">
        </form>
        <br><br><br>

        <form method="get" action="search_post.php">
            <div class="mb-3">
                <label for="keyword" class="form-label">SEARCH :</label>
                <input type="text" class="form-control" id="keyword" name="keyword">
            </div>
            <input type="submit" class="btn btn-secondary" value="Seacrh">
            <input type="reset" class="btn btn-danger" value="Cancel">
        </form>

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
            echo "DB 연결 실패: " . mysqli_connect_error();
            exit;
        }

        $sql = "SELECT * FROM board";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <br><br>
                <a href="view_post.php?no=<?php echo $row['no']; ?>">No. <?php echo $row['no']; ?> <br>Title : <?php echo $row['subject']; ?> User : <?php echo $row['user']; ?> Date : <?php echo $row['reg_date']; ?></a>
                <a href="delete_post.php?no=<?php echo $row['no']; ?>" class="btn btn-dark">Delete</a>
        <?php
            }
        } else {
            echo "No Contents.";
        }
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // delete 요청이 들어온 경우
            header('HTTP/1.1 404 Method Not Allowed');
            exit;
        }        

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
