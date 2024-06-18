<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for uploaded banner
$banner_blob = null;

if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
    $fileContent = file_get_contents($_FILES['logo']['tmp_name']);
    $banner_blob = $fileContent;
}

// Process form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company_name = $_POST['name'];
    $company_email = $_POST['email'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $job_description = $_POST['description'];
    $responsibilities = $_POST['responsibilities'];
    $qualifications = $_POST['qualifications'];
    $experience = $_POST['exp'];
    $skills = $_POST['skill'];
    $vacancy = $_POST['vacancy'];
    $title = $_POST['title'];
    $nature = $_POST['nature'];
    $published_date = $_POST['published_date'];
    $job_type = $_POST['type'];
    $application_deadline = $_POST['application_deadline'];

    // Insert into the 'jobs' table
    $stmt = $conn->prepare("INSERT INTO jobs 
        (banner, company_name, location, salary, job_description, responsibilities, qualifications, experience, vacancy, nature, published_date, job_type, application_deadline, title, email, skill) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sssssssisissssss",
        $banner_blob,
        $company_name,
        $location,
        $salary,
        $job_description,
        $responsibilities,
        $qualifications,
        $experience,
        $vacancy,
        $nature,
        $published_date,
        $job_type,
        $application_deadline,
        $title,
        $company_email,
        $skills
    );

    if ($stmt->execute()) {
        // Get the last inserted job ID
        $last_id = $stmt->insert_id;

        // Insert into the 'explore' table
        $stmt_explore = $conn->prepare("INSERT INTO explore 
            (id, name, banner, type, rating, description, email, information, searchtype, exp) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $type = "Job Post";  // Default type for explore
        $rating = 0.0;       // Default rating (adjust as needed)

        $stmt_explore->bind_param(
            "isssssssss",
            $last_id,
            $company_name,
            $banner_blob,
            $type,
            $rating,
            $title,
            $company_email,
            $job_description,
            $job_type,
            $experience
        );

        if ($stmt_explore->execute()) {
            header("Location: ../explore.php?status=success");
            exit;
        } else {
            echo "Error updating 'explore': " . $stmt_explore->error;
        }

        $stmt_explore->close();
    } else {
        echo "Error posting job: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch job description if job ID is provided
if (isset($_GET['id'])) {
    $job_id = intval($_GET['id']);  // Ensure it's a valid integer
    
    // Fetch the record from the 'jobs' table using the given ID
    $query = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $job_id);  
    $stmt->execute();
    $result = $stmt->get_result();  
    
    if ($result->num_rows > 0) {
        // Fetch the job record
        $job = $result->fetch_assoc();
        
        // Extract email from 'jobs' table
        $email = $job['email'];
        
        // Check if the email exists in the 'discription' table
        $query = "SELECT * FROM discription WHERE email = ?";
        $stmt = $conn->prepare($query);
        
        if (!$stmt) {
            die("Error preparing discription statement: " . $conn->error);
        }
        
        $stmt->bind_param("s", $email);  // Bind the email parameter
        $stmt->execute();
        $result = $stmt->get_result();  // Fetch the result set
        
        if ($result->num_rows > 0) {
            // Fetch the 'discription' record
            $discription = $result->fetch_assoc();
            
            echo "<h2>Description for this Job:</h2>";
            echo "<p>" . nl2br(htmlspecialchars($discription['description'])) . "</p>";  // Display the description
        } else {
            echo "<p>Not registered in 'description'.</p>";  // Email not found in 'discription'
        }
        
        $stmt->close();
        
    } else {
        echo "<p>No job found with ID: $job_id</p>";
    }
} else {
    echo "<p>Job ID not provided in the URL.</p>";
}

$conn->close();
?>
