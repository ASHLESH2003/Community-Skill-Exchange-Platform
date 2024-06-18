<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants List</title>
    <link rel="stylesheet" href="./css/normal.css">
    <script>
        function sendEmail(email) {
            window.location.href = "mailto:" + email;
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container1{
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top:80px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .applicant {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .applicant:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .applicant h2 {
            color: #333;
            margin-bottom: 5px;
        }

        .applicant p {
            margin: 5px 0;
        }

        .applicant .resume-btn {
            background-color: #2ecc71;
            color: #fff;
            border: none;
            padding: 8px 16px;
            text-decoration: none;
            margin: 5px;
            margin-top: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .applicant .resume-btn:hover {
            background-color: #27ae60;
        }

        .reject-btn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .reject-btn:hover {
            background-color: #c0392b;
        }

        .accept-btn {
            background-color: #2ecc71;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .accept-btn:hover {
            background-color: #27ae60;
        }

        .applicant-description {
            margin-top: 10px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
<div id="myNavbar" style="margin-left:30px">
        <div class="container" >
    <ul>
    <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
      <li class="right-nav"><a href="postaskill.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A SKILL</span></a></li>
      <li class="right-nav"><a href="postaneed.php "><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A NEED</span></a>/</li> 
      <li class="right-nav"><a href="exploreforbusiness.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">EXPLORE</span></a>/</li> 
    </ul>
        </div>
    </div>
    <div class="container1" style="padding-bottom:500px" >
        <h1>Applicants List</h1>
        <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = isset($_GET['email']) ? $_GET['email'] : null;

if ($email === null) {
    die("<p>Email parameter is missing in the URL.</p>");
}

$stmt = $conn->prepare("SELECT * FROM applicants WHERE companey_email = ?");
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();

// Use get_result() to get the result set
$result = $stmt->get_result(); // This is where fetch_assoc() is used

if ($result->num_rows > 0) {
    while ($applicant = $result->fetch_assoc()) { // Now we can use fetch_assoc()
        echo "<div class='applicant'>";
        echo "<h2>" . htmlspecialchars($applicant['name']) . "</h2>";
        echo "<p>Email: " . htmlspecialchars($applicant['email']) . "</p>";
        echo "<p>LinkedIn: <a href='" . htmlspecialchars($applicant['linkedin']) . "' target='_blank'>" . htmlspecialchars($applicant['linkedin']) . "</a></p>";

        if ($applicant['resume']) {
            echo "<a href='data:application/pdf;base64," . base64_encode($applicant['resume']) . "' target='_blank'>View Resume</a>";
        }

        echo "<a href='./php/reject_applicant.php?id=" . $applicant['id'] . "&email=" . htmlspecialchars($_GET['email']) . "' class='reject-btn' onclick='return confirm(\"Are you sure you want to reject this applicant?\")'>Reject</a>&nbsp;";

        echo "<button class='accept-btn' onclick='sendEmail(\"" . $applicant['email'] . "\")'>Accept</button>";

        echo "<p class='applicant-description'>" . nl2br(htmlspecialchars($applicant['description'])) . "</p>";

        echo "</div>";
    }
} else {
    echo "<p>No applicant found with email: " . htmlspecialchars($email) . "</p>";
}

$stmt->close();
$conn->close();
?>

    </div>
    <?php include './php/footer.php'; ?>
</body>
</html>
