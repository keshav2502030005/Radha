<?php
session_start();
require_once "../config/db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM admin_info WHERE Email = '$email'");
$user = mysqli_fetch_assoc($result);

if (!$user || !password_verify($password, $user['password'])) {
    die("Invalid login credentials");
}

$_SESSION['admin_id'] = $user['id'];
$_SESSION['admin_email'] = $user['email'];

header("Location: ../dashboard/index.html");
?>
