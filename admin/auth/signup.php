<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];
    $role     = $_POST['role']; // owner

    // Password check
    if ($password !== $confirm) {
        die("Passwords do not match");
    }

    // Check email already exists
    $check = mysqli_query($conn, "SELECT id FROM admin_info WHERE Email='$email'");
    if (mysqli_num_rows($check) > 0) {
        die("Email already registered");
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into DB
    $insert = mysqli_query($conn, "
        INSERT INTO admin_info (Name, Email, Password, Role)
        VALUES ('$name', '$email', '$hashedPassword', '$role')
    ");

    if ($insert) {
        // Redirect to dashboard
        header("Location: ../dashboard/index.html");
        exit;
    } else {
        die("Signup failed");
    }
}
?>
