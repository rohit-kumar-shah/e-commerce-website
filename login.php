<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cara_db"; // Ensure this DB exists in phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // SQL query to match email and plain password
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password); 
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result && $result->num_rows === 1) {
        $_SESSION['email'] = $email;
        header("Location: index.html"); // ✅ Redirect to homepage
        exit();
    } else {
        echo "<script>alert('Incorrect email or password.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
