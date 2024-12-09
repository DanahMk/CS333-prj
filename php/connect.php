<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'itcs333project');
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    $_SESSION['registration_error'] = "We are experiencing technical difficulties. Please try again later.";
    header("Location: registration.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $number = trim($_POST['number']);
    $gender = $_POST['gender'];

    if (empty($username) || empty($password) || !$email || empty($number) || empty($gender)) {
        $_SESSION['registration_error'] = "All fields are required, and email must be valid.";
        header("Location: registration.php");
        exit();
    }

    if (strlen($username) < 3 || strlen($username) > 50) {
        $_SESSION['registration_error'] = "Username must be between 3 and 50 characters.";
        header("Location: registration.php");
        exit();
    }

    if (!preg_match('/^[0-9]{10}$/', $number)) {
        $_SESSION['registration_error'] = "Phone number must be 10 digits.";
        header("Location: registration.php");
        exit();
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $_SESSION['registration_error'] = "Password must be at least 8 characters long and include a number and an uppercase letter.";
        header("Location: registration.php");
        exit();
    }

    $check_stmt = $conn->prepare("SELECT id FROM registration WHERE email = ? OR username = ?");
    $check_stmt->bind_param("ss", $email, $username);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        $_SESSION['registration_error'] = "Username or email already exists.";
        $check_stmt->close();
        header("Location: registration.php");
        exit();
    }
    $check_stmt->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO registration (username, password, email, number, gender) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        error_log("Prepare statement failed: " . $conn->error);
        $_SESSION['registration_error'] = "An error occurred. Please try again.";
        header("Location: registration.php");
        exit();
    }

    $stmt->bind_param("sssss", $username, $hashed_password, $email, $number, $gender);
    if ($stmt->execute()) {
        $_SESSION['registration_success'] = "Registration successful. You can now log in.";
    } else {
        $_SESSION['registration_error'] = "Error executing statement: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
    header("Location: login.php");
    exit();
}
?>
