<!DOCTYPE html>
<html lang="en">
<head>
    <title>QR Code Access</title>
    <style>
        /* General styles for the body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Styles for the header/title */
        h1 {
            color: #333;
            font-size: 24px;
            padding: 20px 0;
        }

        /* Styling for the form and form elements */
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Labels and input fields */
        label {
            display: block;
            text-align: left;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Styling for the submit button */
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Change button color on hover */
        button:hover {
            background-color: #45a049;
        }

        /* Styling for the QR code section */
        h2 {
            color: #333;
            font-size: 20px;
            padding: 20px 0;
        }

        img {
            max-width: 200px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Message for invalid password or QR code not found */
        .error-message {
            color: red;
            font-size: 16px;
            padding: 10px 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Styles for the header/title */
        h1 {
            color: #333;
            font-size: 24px;
            padding: 20px 0;
        }

        /* Error message styling */
        .error-message {
            color: red;
            font-size: 16px;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Ask The Freelancer For The Password</h1>
    <form method="post" action="">
        <input type="hidden" name="action" value="fetch_qr">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Submit</button>
    </form>

<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check which form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'fetch_qr') {
    // Fetch the QR code image and other info from the database based on the password
    $user_password = $_POST['password'];

    $sql = "SELECT qr_image, name, email FROM skills WHERE pay_pass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the QR code image and the name
        $row = $result->fetch_assoc();
        $qr_image = $row['qr_image'];
        $name = $row['name'];
        $email = $row['email'];

        // Display the QR code and the name
        echo "<h2>Your QR Code:</h2>";
        echo "<p>Paying to: " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "</p>";
        echo '<img src="data:image/png;base64,' . base64_encode($qr_image) . '" alt="QR Code">';

        // Form for rating
        echo "<h2>Rate your experience:</h2>";
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="action" value="submit_rating">';
        echo '<input type="hidden" name="email" value="' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '">';
        echo '<label for="rating">Rating (1 to 5):</label>';
        echo '<input type="number" name="rating" min="1" max="5" required>';
        echo '<button type="submit">Submit Rating</button>';
        echo '</form>';
    } else {
        echo "<p class='error-message'>Invalid password or QR code not found.</p>";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_rating') {
    // Handle the rating submission
    $email = $_POST['email'];
    $rating = (int)$_POST['rating'];

    // Update the explore table with the new rating and increment the number of people who voted
    $stmt = $conn->prepare("
    UPDATE explore 
    SET rating = (rating * no_ppl_voted + ?) / (no_ppl_voted + 1),
        no_ppl_voted = no_ppl_voted + 1 
    WHERE email = ?
    ");

    if (!$stmt) {
        die("Error preparing update statement: " . $conn->error);
    }

    $stmt->bind_param("is", $rating, $email);

    if ($stmt->execute()) {
        echo "<p>Rating submitted successfully!</p>";
        header('location:http://localhost/FINAL%20YEAR%20PROJECT/FINAL-YEAR-PROJECT/explore.php?keyword=Python&type=IT&exp=0&message=Rating_successful');
    } else {
        echo "Error updating 'explore': " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
</body>
</html>