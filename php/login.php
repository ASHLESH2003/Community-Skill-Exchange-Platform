<?php
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['pass'];

// Check for admin credentials
$adminEmail = "admin"; // Change to your admin email
$adminPasswordHash = password_hash("ans030403", PASSWORD_DEFAULT); // Hash the admin password

if ($email === $adminEmail && password_verify($password, $adminPasswordHash)) {
    // Redirect to admin dashboard if credentials match
    header("Location: ../adminpage.php");
    exit;
}

// Function to verify user credentials and get the user's name
function getUserNameIfValid($conn, $email, $password, $table) {
    $query = "SELECT name, password FROM $table WHERE email = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $stored_password);
        $stmt->fetch();
        
        if (password_verify($password, $stored_password)) {
            $_SESSION['user']=$name;
            $_SESSION['email']=$email;
            return $name;
        }
    }

    return null;
}

// Check in 'users' table
$userName = getUserNameIfValid($conn, $email, $password, "users");

if ($userName) {
    $_SESSION['type']='user';
    header("Location: ../explore.php?username=" . urlencode($userName));
    exit;
}

// Check in 'business' table
$businessName = getUserNameIfValid($conn, $email, $password, "business");
if ($businessName) {
    $_SESSION['type']='business';
    header("Location: ../exploreforbusiness.php?username=" . urlencode($businessName).'&email='.$email);
    exit;
}

// If no match, redirect back to login with a failure message
header("Location: ../login.html?error=invalid_credentials");

exit;
?>
