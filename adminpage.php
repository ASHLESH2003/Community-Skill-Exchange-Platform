<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch counts from each table
$query = "SELECT
    (SELECT COUNT(*) FROM skills) AS count_table1,
    (SELECT COUNT(*) FROM jobs) AS count_table2,
    (SELECT COUNT(*) FROM users) AS count_table3,
    (SELECT COUNT(*) FROM business) AS count_table4,
    (SELECT COUNT(*) FROM needs) AS count_table5,
    (SELECT COUNT(*) FROM news_table) AS count_table6";

// Execute the query
$result = $conn->query($query);

if ($result) {
    // Fetch the counts
    $row = $result->fetch_assoc();
    $count_table1 = $row['count_table1'];
    $count_table2 = $row['count_table2'];
    $count_table3 = $row['count_table3'];
    $count_table4 = $row['count_table4'];
    $count_table5 = $row['count_table5'];
    $count_table6 = $row['count_table6'];

    // Close the result set
    $result->close();
} else {
    // Handle error if query fails
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        #container {
            width: 80%;
            margin: 50px auto;
            text-align: center;
        }

        h1 {
            color: #008000;
            margin-bottom: 30px;
        }

        .kpi-boxes {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .kpi-box {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 10px;
            padding: 20px;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .kpi-box:hover {
            transform: translateY(-5px);
        }

        .kpi-box h2 {
            color: #008000;
            margin: 0 0 10px 0;
        }

        .button {
            background-color: #008000;
            color: white;
            border: none;
            padding: 20px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #005700;
        }

        .row {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include"./php/backbutton.php" ;?>

<div id="container">
    <h1>Admin Page</h1>
    <div class="kpi-boxes">
        <div class="kpi-box">
            <h2>Skills Count</h2>
            <p><?php echo $count_table1; ?></p>
        </div>
        <div class="kpi-box">
            <h2>Jobs Count</h2>
            <p><?php echo $count_table2; ?></p>
        </div>
        <div class="kpi-box">
            <h2>Users Count</h2>
            <p><?php echo $count_table3; ?></p>
        </div>
        <div class="kpi-box">
            <h2>Business Count</h2>
            <p><?php echo $count_table4; ?></p>
        </div>
        <div class="kpi-box">
            <h2>Needs</h2>
            <p><?php echo $count_table4; ?></p>
        </div>
        <div class="kpi-box">
            <h2>News</h2>
            <p><?php echo $count_table4; ?></p>
        </div>
    </div>
    <div class="row">
        <a href="admin/BlockEmailForm.php" class="button">Delete Entry</a>
        <a href="admin/CompanyProfileForm.php" class="button">Edit Company Profile Data</a>
        <a href="admin/JobPostEditForm.php" class="button">Edit Job Post</a>
    </div>
    <div class="row">
        <a href="admin/NeedPostEditForm.php" class="button">Edit Need Post</a>
        <a href="admin/SkillPostEditForm.php" class="button">Edit Skill Post</a>
        <a href="admin/UserDataForm.php" class="button">Edit User Data Form</a>
    </div>
</div>

</body>
</html>
