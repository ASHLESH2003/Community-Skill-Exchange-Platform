<?php
// PHP script to handle form submission and redirect with query parameters
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCreateTable = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    bio TEXT,
    profile_image BLOB
)";
$conn->query($sqlCreateTable);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $bio = $_POST['bio'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload for profile image
    $image_blob = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
        $image_blob = file_get_contents($_FILES['profile_image']['tmp_name']);
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, bio, profile_image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $hashed_password, $bio, $image_blob);

    if ($stmt->execute()) {
        // Redirect with a query parameter for the user's name
        header("Location: ../explore.php?username=" . urlencode($name));
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
