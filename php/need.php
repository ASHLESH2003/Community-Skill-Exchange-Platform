<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['Username'];
    $email = $_POST['email'];
    $deal_amount = $_POST['deal'];
    $location = $_POST['location'];
    $deadline = $_POST['deadline'];
    $job_title = $_POST['JobTitle'];
    $exp = $_POST['exp'];
    $job_type = $_POST['type'];
    $skill=$_POST['skill'];
    $description = $_POST['description'];

    // Handle file uploads
    $resume_blob = null;
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['resume']['tmp_name'];
        $resume_blob = file_get_contents($file_tmp);
    }

    $banner_blob = null;
    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['banner']['tmp_name'];
        $banner_blob = file_get_contents($file_tmp);
    }

    // Insert data into the 'needs' table
    $stmt = $conn->prepare("INSERT INTO needs (username, email, deal_amount, location, deadline, job_title, description, resume, banner, exp,skill) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("sssssssssss", $username, $email, $deal_amount, $location, $deadline, $job_title, $description, $resume_blob, $banner_blob, $exp,$skill);

    if ($stmt->execute()) {
        // Get the ID of the last inserted record
        $last_id = $stmt->insert_id;

        // Insert data into the 'explore' table
        $stmt_explore = $conn->prepare("INSERT INTO explore (id, name, banner, type, rating, description,email,information,searchtype,exp) VALUES (?, ?, ?, ?, ?, ?,?,?,?,?)");
        if (!$stmt_explore) {
            die("Prepare statement for 'explore' failed: " . $conn->error);
        }

        $type = "need post";  // or any appropriate type
        $rating = 0.0;       // default rating or based on some logic
        $stmt_explore->bind_param("isssssssss", $last_id, $username, $banner_blob, $type, $rating, $job_title,$email,$description,$job_type,$exp);

        if ($stmt_explore->execute()) {
            header("Location: ../explore.php?status=success");
            exit;
        } else {
            echo "Error inserting into 'explore': " . $stmt_explore->error;
        }

        $stmt_explore->close();
    } else {
        echo "Error inserting into 'needs': " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
