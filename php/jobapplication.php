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

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data and validate them
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $linkedin = $_POST['link'] ?? '';
    $exp = $_POST['exp'] ?? '';
    $bio = $_POST['bio'] ?? '';

    
    // Fetch the company email from the URL
    $company_email = isset($_GET['email']) ? $_GET['email'] : null;
    
    // Handle the file upload (resume)
    $resume_blob = null;
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $resume_blob = file_get_contents($_FILES['resume']['tmp_name']);
    }

    // Prepare the SQL statement to insert data into the table
    $stmt = $conn->prepare("
        INSERT INTO applicants (name, email, linkedin, exp, description, resume, companey_email)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameters and execute the query
    $stmt->bind_param("sssssss", 
        $name, 
        $email, 
        $linkedin, 
        $exp, 
        $bio, 
        $resume_blob,
        $company_email
    );

    if ($stmt->execute()) {
        echo "<p>Job application submitted successfully!</p>";
    } else {
        echo "<p>Error submitting job application: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
