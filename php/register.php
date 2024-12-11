<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $number = trim($_POST['number']);
    $gender = $_POST['gender'];

    // Check for empty fields and valid email
    if (empty($username) || empty($password) || !$email || empty($number) || empty($gender)) {
        $_SESSION['registration_error'] = "All fields are required and email must be valid.";
        header("Location: register.php");
        exit();
    }

    // Check if username or email already exists
    $check_query = "SELECT * FROM registration WHERE username = ? OR email = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['registration_error'] = "Username or email already exists.";
        header("Location: register.php");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $insert_query = "INSERT INTO registration (username, password, email, number, gender) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sssis", $username, $hashed_password, $email, $number, $gender);

    if ($stmt->execute()) {
        $_SESSION['registration_success'] = "Registration successful. You can now log in.";
        header("Location: register.php");
        exit();
    } else {
        $_SESSION['registration_error'] = "Registration failed. Please try again.";
        header("Location: register.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
    :root {
        --first-color: #243642;
        --second-color: #387478;
        --third-color: #629584;
        --forth-color: #E2F1E7;
    }
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        height: 100vh; 
        display: flex; 
        justify-content: center;
        align-items: center; 
        background: var(--forth-color);
    }

    h2 {
        color: #333;
        margin: 0px;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        background: var(--forth-color); 
        padding: 20px; 
        border-radius: 8px; 
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        width: 400px; 
        height: 500px;
    }

    .input-group { margin-bottom: 15px; }

    label {
        display: block; 
        margin-top: 10px;
        margin-bottom: 2px;
        color: #555;
    }

    input[type="text"], input[type="password"], input[type="email"], input[type="number"] {
        width: 100%; 
        padding: 10px; 
        border: 1px solid #ccc; 
        border-radius: 4px; 
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%; 
        padding: 10px; 
        background: var(--first-color);
        color: white; 
        border: none; 
        border-radius: 4px; 
        cursor: pointer; 
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background: var(--second-color);
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        color: var(--second-color);
    }

    a {
        color: #007bff; 
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .error {
        color: red;
        text-align: center;
        margin-bottom: 15px;
    }

    .success {
        color: green;
        text-align: center;
        margin-bottom: 15px;
    }
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['registration_error'])) {
        echo '<div class="error">' . htmlspecialchars($_SESSION['registration_error']) . '</div>';
        unset($_SESSION['registration_error']);
    }
    if (isset($_SESSION['registration_success'])) {
        echo '<div class="success">' . htmlspecialchars($_SESSION['registration_success']) . '</div>';
        unset($_SESSION['registration_success']);
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Registration</h2>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="number">Number:</label>
        <input type="number" id="number" name="number" required><br><br>

        <label>Gender:</label>
        <div class="radio-group">
            <label for="male" class="radio">
                <input type="radio" id="male" name="gender" value="m" required> Male
            </label>
            <label for="female" class="radio">
                <input type="radio" id="female" name="gender" value="f" required> Female
            </label>
        </div>
        <br>
        
        <input type="submit" value="Register">
    </form>
    <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
