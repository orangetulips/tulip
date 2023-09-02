<?php
session_start();

$servername = "192.168.33.6";
$username = "orangecat";
$password = "dighdigh32";
$dbname = "welcomtuliphouse";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Get the form data
  $id = $_POST['id'];
  $pass = $_POST['pass'];
  $pass_re = $_POST['pass_re'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $country = $_POST['country'];

  // Sanitize the form data
  $id = mysqli_real_escape_string($conn, $id);
  $name = mysqli_real_escape_string($conn, $name);
  $email = mysqli_real_escape_string($conn, $email);
  $phone = mysqli_real_escape_string($conn, $phone);
  $country = mysqli_real_escape_string($conn, $country);

  // Check if phone number is empty
  if(empty($phone)){
    echo "Don't Forget Your Phone Number ;).";
    exit;
  }

  // Check if phone number is numeric
  if(!is_numeric($phone)){
    echo "Phone Number Should Be By Number.";
    exit;
  }

  // Get the client's public IP address
  $ip_address = get_client_ip();

  // Hash the password
  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

  // Insert the user data into the database
  $sql = "INSERT INTO tulip_member (id, password, name, email, phone, country, reg_date, ip_address) VALUES ('$id', '$hashed_password', '$name', '$email', '$phone', '$country', NOW(), '$ip_address')";

  if(mysqli_query($conn, $sql)){
    // Redirect the user to the welcome page
    header('Location: welcome.php');
    exit;
  } else {
    die("Failed To Create Account: " . mysqli_error($conn));
    exit;
  }
}

mysqli_close($conn);

// Get the client's public IP address
function get_client_ip() {
  $ip_address = '';
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    // Check for the HTTP_CLIENT_IP header
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    // Check for the HTTP_X_FORWARDED_FOR header
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    // Use the REMOTE_ADDR header
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
  return $ip_address;
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  // delete 요청이 들어온 경우
  header('HTTP/1.1 404 Method Not Allowed');
  exit;
}    
?>

