<?php
// Set database credentials
$dbHost = 'localhost';
$dbUsername = 'your-db-username';
$dbPassword = 'your-db-password';
$dbName = 'your-db-name';

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query database for user
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User found, check password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables and redirect to home page
            session_start();
            $_SESSION['username'] = $username;
            header('Location: index.php');
        } else {
            // Password is incorrect
            $loginError = 'Invalid password.';
        }
    } else {
        // User not found
        $loginError = 'Invalid username.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if(isset($loginError)) { echo '<p>' . $loginError . '</p>'; } ?>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
