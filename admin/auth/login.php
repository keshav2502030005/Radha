<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'radha');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['email']) || !isset($_POST['password'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

$email = $conn->real_escape_string(trim($_POST['email']));
$password = trim($_POST['password']);

$sql = "SELECT Id, Email, Password FROM admin_info WHERE Email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['Password']) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user['Id'];
            $_SESSION["email"] = $user['Email'];
            echo json_encode(['success' => true, 'message' => 'Login successful!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Account not found. Redirecting to registration...',
            'redirect' => 'registration.html'
        ]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Database query failed.']);
}

$conn->close();
?>
