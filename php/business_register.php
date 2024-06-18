<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['password']; // Consider hashing before storing
    $location = $_POST['Location'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $contact = $_POST['Contact'];
    $description = $_POST['description'];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM business WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    if ($count > 0) {
        echo "A user with this email already exists. Please use a different email.";
    } else {
        // Handle file upload
        if (isset($_FILES['logo'])) {
            echo "File name: " . $_FILES['logo']['name']; // Debugging
            echo "File type: " . $_FILES['logo']['type']; // Debugging
            echo "File size: " . $_FILES['logo']['size']; // Debugging
        
            if ($_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['logo']['tmp_name'];
                $file_blob = file_get_contents($file_tmp); // Read the uploaded file
            } else {
                echo "File upload error: " . $_FILES['logo']['error']; // If there's an error
                $file_blob = null; // If there's an error, set to null
            }
        } else {
            echo "No file was uploaded."; // If no file was uploaded
        }
        
        
        

        
        // Insert into the database
        $stmt = $conn->prepare("INSERT INTO business (name, email, password, location, contact, description, logo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssssss", $company, $email, $hashed_password, $location, $contact, $description, $file_blob);

        if ($stmt->execute()) {
            header("Location: ../exploreforbusiness.php?username=" . urlencode($company));
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
