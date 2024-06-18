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

// Function to check if email is registered in users or business tables
function isEmailRegistered($conn, $email) {
    $tables = ['users', 'business'];
    foreach ($tables as $table) {
        $stmt = $conn->prepare("SELECT 1 FROM $table WHERE email = ?");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->fetch()) {
            $stmt->close();
            return true;
        }
        $stmt->close();
    }
    return false;
}

// Ensure the skills table exists
$conn->query("
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contact VARCHAR(20) NOT NULL,
    skills VARCHAR(255) NOT NULL,
    title VARCHAR(255),
    description TEXT,
    skill_explanation TEXT,
    github_link VARCHAR(255),
    linkedin_link VARCHAR(255),
    profile_image BLOB,
    resume BLOB,
    exp VARCHAR(20),
    banner BLOB
)
");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email is registered
    if (!isEmailRegistered($conn, $email)) {
        header("Location: ../who.html?error=email_not_registered");
        exit;
    }

    // Get the rest of the form data
    $name = $_POST['name'];
    $contact = $_POST['ph'];
    $skills = $_POST['SKILLS'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $skill_explanation = $_POST['skillexplain'];
    $github_link = $_POST['links1'];
    $linkedin_link = $_POST['links2'];
    $exp = $_POST['exp'];
    $job_type = $_POST['type'];
    $pay_pass=$_POST['pay_pass'];

    // Handle file uploads
    $profile_image = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $profile_image = file_get_contents($_FILES['profile_image']['tmp_name']);
    }
    $qr = null;
    if (isset($_FILES['qr']) && $_FILES['qr']['error'] === UPLOAD_ERR_OK) {
        $profile_image = file_get_contents($_FILES['qr']['tmp_name']);
    }

    $banner = null;
    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $banner = file_get_contents($_FILES['banner']['tmp_name']);
    }

    $resume = null;
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $resume = file_get_contents($_FILES['resume']['tmp_name']);
    }

// Insert into the skills table
$stmt = $conn->prepare("
INSERT INTO skills (name, email, contact, skills, title, description, skill_explanation, github_link, linkedin_link, profile_image, resume, exp, banner, qr, pay_pass) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,)
");

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param(
    "sssssssssssssss", 
    $name, 
    $email, 
    $contact, 
    $skills, 
    $title, 
    $description, 
    $skill_explanation, 
    $github_link, 
    $linkedin_link, 
    $profile_image, 
    $resume, 
    $exp, 
    $banner,
    $qr,
    $pay_pass
);

if ($stmt->execute()) {
    // If insert successful, continue with other operations
    $last_id = $stmt->insert_id;

    // Insert into the explore table
    $stmt_explore = $conn->prepare("
    INSERT INTO explore (id, name, banner, type, rating, description, email,information,searchtype,exp) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)
    ");

    if (!$stmt_explore) {
        die("Error preparing explore statement: " . $conn->error);
    }

    $type = "Skill Post";
    $rating = 0.0;

    $stmt_explore->bind_param("isssssssss", 
        $last_id, 
        $name, 
        $banner, 
        $type, 
        $rating, 
        $title,
        $email,
        $description,
        $job_type,
        $exp
    );

    if ($stmt_explore->execute()) {
        header("Location: ../explore.php?status=success");
        exit;
    } else {
        echo "Error inserting into 'explore': " . $stmt_explore->error;
    }

    $stmt_explore->close();
} else {
    // Handle unique constraint violation for pay_pass
    if ($stmt->errno == 1062) {
        echo "Error: The payment password is already in use. Please choose a different one.";
    } else {
        echo "Error inserting into 'skills': " . $stmt->error;
    }
}

$stmt->close();

}

$conn->close();
?>
