<?php

session_start();
$link = mysqli_connect("127.0.0.1", "root", "", "game");

unset($_SESSION['error_message']);

if (!isset($_POST['login_email']) || !isset($_POST['login_password'])) {
    $_SESSION['error_message'] = "Грешен емайл/парола";
}

$pass = filter_var($_POST['login_password'], FILTER_SANITIZE_STRING);
$email = filter_var(filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);

if (!$email) {
    $_SESSION['error_message'] = "Грешен емайл/парола";
}

if (!isset($_SESSION['error_message'])) {

    $md5 = md5($pass);
    $query = "SELECT * FROM user WHERE email='"
            . $_POST['login_email']
            . "' AND password='" . $md5 . "'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user['name'];
        $_SESSION['userid'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['lastlogin'] = $user['lastlogin'];
        $sql = "UPDATE user SET lastlogin='" . date("Y-m-d H:i:s") . "'";
        $result = mysqli_query($link, $sql);
    } else {
        $_SESSION['error_message'] = "Грешен емайл/парола";
    }
}
mysqli_close($link);
header("location:index.php");
