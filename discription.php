<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/normal.css">
    <link rel="stylesheet" href="./css/details.css">
    <style>
        p{
            font-size: large;

        }
        li{
            font-size: medium;
        }

    </style>
</head>
<body style="background: linear-gradient(to right, lightblue, lightgreen);">


    <?php
// Error reporting for debugging
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

// Get the ID from the URL
if (isset($_GET['id'])) {
    $job_id = intval($_GET['id']);  // Use intval to ensure it's a valid integer
    
    // Fetch the record from the 'jobs' table using the given ID
    $query = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $job_id);  // Bind the ID parameter
    $stmt->execute();
    $result = $stmt->get_result();  // Fetch the result set
    
    if ($result->num_rows > 0) {
        // Fetch the record
        $job = $result->fetch_assoc();
    } else {
        echo "<p>No job found with ID: $job_id</p>";
    }

    $stmt->close();
} else {
    echo "<p>Job ID not provided in the URL.</p>";
}


?>


<div style="width: 98%;background-color: white;margin-left: 1%;">
    <div id="myNavbar" style="width: 92%;margin-left: 3%;">
        <div class="container">
    <ul>
    <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
    <li class="right-nav"><a href="who.php" style="background-color: green;padding-right: 60px;color: white;padding-top: 30px;padding-bottom: 10px;"><span class="medium">LOGIN</span></a></li> 
    <li class="right-nav"><a href="explore.php"><span style="border: 3px solid white;padding: 10px;border-radius: 20px;" class="medium">Explore</span></a>/</li>
    <li class="right-nav"><a href="homepage.php"><span style="border: 3px solid white;padding: 10px;border-radius: 20px;" class="medium">Home</span></a>/</li> 
    </ul>
        </div>
    </div></div>
    <?php 
echo "<img src='data:image/jpeg;base64," . base64_encode($job['banner']) . "' alt='Job Banner' style=\"width: 90%; margin-left: 5%; margin-top: 67px;\">"; 
?>

    <div style="width: 90%;margin-left: 5%;background-color: white;margin-top: -5px;">
        <div style="display: flex;">
            <!-- left -->
            <div style="width: 70%;">
            <div style="display: flex; margin-top: 45px; margin-left: 2%;">
    <?php
    // Fetch and display the company logo
    $company_logo = ''; // Initialize variable to store logo data
    $query_logo = "SELECT logo FROM business WHERE email = ?";
    $stmt_logo = $conn->prepare($query_logo);
    
    if ($stmt_logo) {
        $stmt_logo->bind_param("s", $job['email']);
        $stmt_logo->execute();
        $stmt_logo->store_result();

        if ($stmt_logo->num_rows > 0) {
            $stmt_logo->bind_result($logo);
            $stmt_logo->fetch();
            $company_logo = $logo;
        }
        
        $stmt_logo->close();
    }
    
    if (!empty($company_logo)) {
        echo '<div><img src="data:image/jpeg;base64,' . base64_encode($company_logo) . '" width="100px" alt=""></div>';
    } else {
        echo '<div><img src="./images/logo.png" width="100px" alt=""></div>'; // Placeholder image if logo is not found
    }
    ?>
    
    <div style="display: block; padding: 15px; font-size: x-large; font-weight: bolder; text-align: start;">
        <h1 style="margin-top: -20px; color: black;"><?php echo htmlspecialchars($job['company_name']); ?></h1>
        <div style="margin-top: 20px;">
            <?php echo "Location: " . htmlspecialchars($job['location']) . " 📍 fulltime⌚   Salary: " . htmlspecialchars($job['salary']) . " 💵"; ?>
        </div>
    </div>
</div>


           
                <div><h1>Job description</h1>
                <?php   echo "<p>" . nl2br(htmlspecialchars($job['job_description'])) . "</p>"; ?>
                    
            </div>
                <div><h1>Responsibility</h1>
                  <?php       echo "<p >" . nl2br(htmlspecialchars($job['responsibilities'])) . "</p>"; ?>
            </div>
                <div><h1>Qualifications</h1>
                <?php         echo "<p >" . nl2br(htmlspecialchars($job['qualifications'])) . "</p>"; ?>
                   
            </div>

                    <!--mail  -->
                <form  method="post" enctype="multipart/form-data">
                    <div style="padding: 30px;">
                        <h1 style="text-align: start;margin-top: 100px;color: black;">APPLY FOR JOB</h1>
                        <div>
                            <input type="text" style="width:415px" name='name' id='name' placeholder="YOUR NAME">
                            <input type="text" style="width:415px" name='email' id='email' placeholder="EMAIL">
                        </div>
                        <div style="margin-top: 20px;">
                            <input type="text" style="width:415px"  name='link' id='link' placeholder="LINKEDIN LINK">

                            <select name="exp" id="exp"  style="width: 415px;height: 42px;border-radius: 6px;text-align: center;">
                                <option value="0">Fresher</option>
                                <option value="1"> less than 1 year</option>
                                <option value="2"> less than 3 year</option>
                                <option value="3"> less than 5 year</option>
                                <option value="4"> less than 10 year</option>
                                <option value="5"> more than 10 year</option>
                        
                            </select>
                            <br>
                            <label for="resume" style="margin-top: 20px;" >UPLOAD RESUME:</label>
                            <input type="file" id="resume" name='resume' style="width:450px" >
                        </div>
                        <div style="margin-top: 20px;">
                                <textarea name="bio" id="bio" cols="30" style="width: 850px;" rows="10"></textarea>
                        </div>
                        <input type="submit" value="APPLY NOW" name="" id="" style="width: 95%;  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.406);height: 50px;margin-top: 20px;background-color: rgb(28, 133, 28);border: 0;font-size: x-large;color: white;font-weight: bolder;">
                    </div>
                </form>
                <?php

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data and validate them
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $linkedin = $_POST['link'] ?? '';
    $exp = $_POST['exp'] ?? '';
    $bio = $_POST['bio'] ?? '';

    
    // Fetch the company email from the URL
    $company_email = isset($_GET['email']) ? $_GET['email'] : null;
    
    // Handle the file upload (resume)
    $resume_blob = null;
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['resume']['tmp_name'];
        $resume_blob = file_get_contents($file_tmp);
    }

    // Prepare the SQL statement to insert data into the table
    $stmt = $conn->prepare("
        INSERT INTO applicants (name, email, linkedin, exp, description, resume, companey_email)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
    }

    // Bind the parameters and execute the query
    $stmt->bind_param("sssssss", 
        $name, 
        $email, 
        $linkedin, 
        $exp, 
        $bio, 
        $resume_blob,
        $company_email
    );

    if ($stmt->execute()) {
        echo "<p>Job application submitted successfully!</p>";
    } else {
        echo "<p>Error submitting job application: " . $stmt->error . "</p>";
    }

    $stmt->close();
}


?>
            </div>
            <!-- right -->
            <div style="width: 30%;margin-top: 5%;">
                <div style="background-color: rgba(0, 255, 115, 0.099);margin:5px;padding: 10px;">
                <h1 style="color: black;text-align: start;margin-left: 8%;">Job Summary</h1>
                <ul style="margin-top: 40px;">
                    <li class="li">Published On:<?php echo htmlspecialchars($job['published_date']) ; ?></li>
                    <li class="li">Vacancy: <?php echo htmlspecialchars($job['vacancy']) . "</p>"; ?></li>
                    <li class="li">Job Nature: <?php echo htmlspecialchars($job['nature']) ; ?></li>
                    <li class="li">Skills: <?php echo htmlspecialchars($job['skill']) ; ?></li>
                    <li class="li">Experience: <?php  echo htmlspecialchars($job['experience']) . " years</p>"; ?></li>
                    <li class="li">Salary: <?php echo htmlspecialchars($job['salary']) ; ?> </li>
                    <li class="li">Location: <?php echo htmlspecialchars($job['location']) ; ?></li>
                    <li class="li">Deadline: <?php echo htmlspecialchars($job['application_deadline']) ; ?></li>
                </ul>
                    
            </div>
                <div style="background-color:  rgba(0, 255, 115, 0.099);margin:5px;padding: 20px;">
                    <h1 style="color: black;text-align: start;margin-left: 8%;">Company Detail</h1>
                    <?php
                     $query = "SELECT * FROM business WHERE email = ?";
                     $stmt = $conn->prepare($query);
                     
                     if (!$stmt) {
                         die("Error preparing statement: " . $conn->error);
                     }
                 
                     $stmt->bind_param("s", $job['email']);  // Bind the ID parameter
                     $stmt->execute();
                     $result = $stmt->get_result();  // Fetch the result set
                     
                     if ($result->num_rows > 0) {
                         // Fetch the record
                         $dis = $result->fetch_assoc();
                         echo $dis['description'];
                     } else {
                         echo "no email found pls register";
                     }
                 
                     $stmt->close();

                    ?>

                </div>
            </div>
        </div>
    
    </div>
    </div>


</div>

<?php $conn->close(); ?>
    
</body>
</html>