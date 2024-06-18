<?php
// Connect to MySQL database
$servername = "localhost";  // e.g., "localhost"
$username = "root";      // e.g., "root"
$password = "";   // Database password
$dbname = "fyproject";        // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the password from the form submission
$user_password = $_POST['password'];

// Fetch the QR code image and the name from the database based on the password
$sql = "SELECT qr_image, name FROM skills WHERE pay_pass = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the QR code image and the name
    $row = $result->fetch_assoc();
    $qr_image = $row['qr_image'];
    $name = $row['name']; // Get the name

    // Display the QR code and the name
    echo "<h2>Your QR Code:</h2>";
    echo "<p>Paying to: " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "</p>";
    echo '<img src="data:image/png;base64,' . base64_encode($qr_image) . '" alt="QR Code">';
} else {
    echo "<p>Invalid password or QR code not found.</p>";
}

$stmt->close();
$conn->close();
?>
