<?php
// DB credentials
$servername = "localhost";
$username = "root";
$password = ""; // Use your XAMPP password if set
$dbname = "cara_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$plainPassword = $_POST['password'];

// Optional: Check if email or username already exists
$check_sql = "SELECT * FROM users WHERE email = ? OR username = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ss", $email, $username);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    echo "<script>alert('Username or Email already exists!'); window.location.href='signup.html';</script>";
} else {
    // Insert new user
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $plainPassword);

    if ($stmt->execute()) {
        echo "<script>alert('Signup successful! Redirecting to login...'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error: Could not save data.'); window.location.href='signup.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
