<?php
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

// Assume you get the email from the URL or session
$email = $_GET['email'] ?? null;

if (!$email) {
    die("Email not provided");
}

// Collect the submitted data
$card_number = $_POST['card_number'];
$expiry_date = $_POST['expiry_date'];
$cvv = $_POST['cvv'];
$name = $_POST['name'];
$rating = $_POST['rating'];

// (Placeholder for processing payment information - ensure this part is secure)

// Update the user's rating in the database
$update_query = "UPDATE explore SET rating = rating + ? WHERE email = ?";
$stmt = $conn->prepare($update_query);

if ($stmt) {
    $stmt->bind_param("is", $rating, );
    $stmt->execute();
    $stmt->close();

} else {
    echo "Error preparing statement: " . $conn->error;
}
$update_query = "UPDATE explore SET no_ppl_voted = no_ppl_voted + 1 WHERE email = ?";
$stmt = $conn->prepare($update_query);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();

} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
