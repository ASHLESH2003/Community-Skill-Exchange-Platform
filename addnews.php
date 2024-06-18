<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpg'); /* Add your desired background image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div style="margin-top:-650px;margin-left:-500px;padding-right:300px">
<?php include './php/backbutton.php'; ?>
</div>
    <div class="form-container">
        <h1>Add News</h1>
        <form  method="post" enctype="multipart/form-data">
            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name" name="company_name" required>
            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="source">Source:</label>
            <input type="text" id="source" name="source" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        
            
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            
            <input type="submit" value="Add News">
        </form>
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
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    }

        $stmt = $conn->prepare("INSERT INTO news_table (company_name, title, source, description, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $company_name, $title, $source, $description,$image);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("location:http://localhost/FINAL%20YEAR%20PROJECT/FINAL-YEAR-PROJECT/companey_updates.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } 

    $conn->close();

?>

    </div></div>

</body>
</html>
