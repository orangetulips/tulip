<?php
session_start();

$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Get the file name from the URL parameter
$name = $_GET['name'];

// Look up the file in the database
$sql = "SELECT * FROM file WHERE NAME = '$name'";
$result = mysqli_fetch_array(mysqli_query($conn, $sql));

  Header("Content-Type: application/octet-stream");
  Header("Content-Disposition: attachment; filename=$name");
  Header("Content-Transfer-Encoding: binary");
  Header("Content-Length: ".filesize("./upfile/$name"));

  $fd = fopen("./upfile/$name", "rb");
  echo fread($fd, filesize("./upfile/$name"));
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // delete 요청이 들어온 경우
    header('HTTP/1.1 404 Method Not Allowed');
    exit;
}    
?>
