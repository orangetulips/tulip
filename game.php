<?php
session_start();

if ($_SESSION['loginID'] == "") {
    $user = "not login";
} else {
    $user = $_SESSION['loginID'];
}
?>
<a href="/snakegame/snakegame.py">Play Snake Game</a>