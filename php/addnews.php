<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $title = $conn->real_escape_string($_POST['title']);
    $source = $conn->real_escape_string($_POST['source']);
    $description = $conn->real_escape_string($_POST['description']);


    // Handle the image file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = file_get_contents($image);

        $stmt = $conn->prepare("INSERT INTO news_table (company_name, title, source, description, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssibs", $company_name, $title, $source, $description$imgContent);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("location:http://localhost/FINAL%20YEAR%20PROJECT/FINAL-YEAR-PROJECT/exploreforbusiness.php")
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading the image file.";
    }

    $conn->close();
}
?>
