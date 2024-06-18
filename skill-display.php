<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/normal.css">
    <link rel="stylesheet" href="./css/details.css">
</head>

<?php
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
    $skill_id = intval($_GET['id']);  // Convert to integer to ensure valid ID
    
    // Fetch the record from the 'skills' table using the given ID
    $query = "SELECT * FROM skills WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $skill_id);  // Bind the ID parameter
    $stmt->execute();
    $result = $stmt->get_result();  
    $skill = $result->fetch_assoc();
}

?>



<body style="background: linear-gradient(to right, lightblue, lightgreen);">
    <div style="width: 90%;margin-left: 0%;background-color: white;">
    <div id="myNavbar" style="width: 90%;margin-left: 5%;">
        <div class="container">
    <ul>
    <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
    <li class="right-nav"><a href="who.html" style="background-color: green;padding-right: 60px;color: white;padding-top: 30px;padding-bottom: 10px;"><span class="medium">LOGIN</span></a></li> 
    <li class="right-nav"><a href="explore.php"><span style="border: 3px solid white;padding: 10px;border-radius: 20px;" class="medium">Explore</span></a>/</li>
    <li class="right-nav"><a href="homepage.php"><span style="border: 3px solid white;padding: 10px;border-radius: 20px;" class="medium">Home</span></a>/</li> 
    </ul>
        </div>
    </div></div>
    <?php echo "<img src='data:image/jpeg;base64," . base64_encode($skill['banner']) . "' style='width: 90%;margin-left: 5%;margin-top: 67px;height: 600px;' alt='Banner'>";  ?>
    <div style="width: 90%;margin-left: 5%;background-color: white;margin-top: -5px;">
        <div style="display: flex;">
            <!-- left -->
            <div style="width: 70%;">
                <div style="height: 150px;background-color: rgb(255, 255, 255);display: flex;">
                    <div style="display: flex;margin-top: 45px;margin-left: 2%;">
                        <div style="">
                        <?php 
                        // Display a profile image with base64-encoded data, applying multiple inline styles
                        echo "<img src='data:image/jpeg;base64," . base64_encode($skill['profile_image']) . "' 
                                alt='Profile Image' 
                                style='border-radius: 50%; width: 100px; height: 100px; object-fit: cover;'>";
                        ?>
</div>
                    <div style="display: block;padding: 15px;font-size: x-large;font-weight: bolder;"><h1 style="margin-top: 2px;color: black;"> <?php echo htmlspecialchars($skill['name']); ?> </h1>

                    </div>
                    </div>

                </div>
                <div><h1><?php echo htmlspecialchars($skill['title']); ?> </h1>
                    <p><?php echo htmlspecialchars($skill['description']); ?> </p>
                </div>
                <div>
                    <h1>SKILLS</h1>
                    <p><?php echo htmlspecialchars($skill['skill_explanation']); ?></p>

                </div>
               <div>
                
               </div>
            </div>
            <!-- right -->
            <div style="width: 33%;margin-top: 5%;">
                <div style="background-color: rgba(0, 255, 115, 0.099);margin:5px;padding: 10px;">
                <h1 style="color: black;text-align: start;margin-left: 8%;">Skill Summary</h1>
                <ul style="margin-top: 40px;font-size:5px">
                    <li class="li">USERNAME: <?php echo htmlspecialchars($skill['name']); ?></li>
                    <li class="li">EMAIL: <?php echo htmlspecialchars($skill['email']); ?></li>
                    <li class="li">Contact: <?php echo htmlspecialchars($skill['contact']); ?></li>
                    <li class="li">Skills: <?php echo htmlspecialchars($skill['skills']); ?></li>
                    <li class="li">Deal: <?php echo htmlspecialchars($skill['deal']); ?> USD</li>
                    </ul>
                    <br><br><br>
                    <?php
                    $amt = $skill['deal'] * 100; // Assuming $skill contains the data with the 'deal' field
                    $email = $_GET['email']; // Assuming $skill contains the data with the 'email' field
                    echo '<a href="paymenttest.php?price=' . $amt . '&email=' . $email . '">
                            <button style="width: 40%; background-color: lightgreen; border: 0px; margin-left: 30%; height: 30px;">
                                PAYMENT
                            </button>
                        </a>';
                    ?>
             
            </div>
       
            </div>
        </div>
        <?php 
            // Display a button that creates a mailto link to contact
            echo '<a href="mailto:' . htmlspecialchars($skill['contact']) . '">
                    <button style="width: 20%; height: 30px; margin-left: 25%; background-color: lightgreen;">CONTACT</button>
                </a>'; 
            ?>            
            <div>
            <h1>WORKS</h1>
            <?php
                if (isset($skill['resume']) && !empty($skill['resume'])) {
                    $pdfData = base64_encode($skill['resume']);  // Encode the BLOB data into base64
                    
                    echo "<object data='data:application/pdf;base64,{$pdfData}' 
                            width='100%' 
                            height='500' 
                            type='application/pdf' 
                            style='border: none;'>
                            This browser does not support PDFs. Please download the PDF to view it: 
                            <a href='data:application/pdf;base64,{$pdfData}' download='resume.pdf'>Download PDF</a>.
                        </object>";
                } else {
                    echo "<p>No resume available.</p>";  // Handle case when there's no resume data
                }
                ?>

        
        </div>
    
    </div>
    </div>


</div>

<?php $conn->close(); ?>
    
</body>
</html>