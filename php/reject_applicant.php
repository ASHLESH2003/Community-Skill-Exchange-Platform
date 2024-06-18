<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Check if 'id' parameter is present in the GET request
    if (isset($_GET['id'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fyproject";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = (int) $_GET['id'];

        // Prepare and execute the DELETE statement
        $stmt = $conn->prepare("DELETE FROM applicants WHERE id = ?");
        if (!$stmt) {
            die("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirect back to the original page or another location after successful deletion
            header("Location:http://localhost/FINAL%20YEAR%20PROJECT/FINAL-YEAR-PROJECT/applicants.php?email=" .$_GET['email']); // Update as needed
        } else {
            echo "Error deleting applicant: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "No ID provided for rejection.";
    }
?>
