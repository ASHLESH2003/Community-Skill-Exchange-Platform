<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/normal.css">
    <link rel="stylesheet" href="./css/details.css">
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
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    if (isset($_GET['id'])) {
        $need_id = intval($_GET['id']);  

        $query = "SELECT * FROM needs WHERE id = ?";
        $stmt = $conn->prepare($query);
        
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
    
        $stmt->bind_param("i", $need_id);  
        $stmt->execute();
        $result = $stmt->get_result();  
        
        if ($result->num_rows > 0) {
     
            $need = $result->fetch_assoc();
        }
    }
    
    ?>



    <div style="width: 95%;margin-left: 0%;background-color: white;">
    <div id="myNavbar" style="width: 90%;margin-left: 5%;">
        <div class="container">
    <ul>
    <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
      <li class="right-nav"><a href="postaskill.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A SKILL</span></a></li>
      <li class="right-nav"><a href="postaneed.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A NEED</span></a>/</li> 
      <li class="right-nav"><a href="companey_updates.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">NEWS</span></a>/</li> 
        </div>
    </div></div>
    <?php echo "<img src='data:image/jpeg;base64," . base64_encode($need['banner']) . "' alt='Banner' style='width: 90%;margin-left: 5%;margin-top: 67px;height: 600px;'>"; ?>
    <div style="width: 90%;margin-left: 5%;background-color: white;margin-top: -5px;">
        <div style="display: flex;">
            <!-- left -->
            <div style="width: 70%;">
                <div style="height: 150px;background-color: rgb(255, 255, 255);display: flex;">
                    <div style="display: flex;margin-top: 45px;margin-left: 2%;">
                        <div style="">
                        <?php

                            $query = "SELECT logo FROM business WHERE email = ?";
                            $stmt = $conn->prepare($query);

                            if (!$stmt) {
                                die("Error preparing business statement: " . $conn->error);
                            }

                            $stmt->bind_param("s", $need['email']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                // Fetch the logo from 'business'
                                $business = $result->fetch_assoc();
                                
                                if ($business['logo']) {
                              
                                    echo "<img src='data:image/jpeg;base64," . base64_encode($business['logo']) . "' alt='Business Logo' style='max-width: 100px;border-radius: 50%;'>";
                                } else {
                                    echo "<p>No logo found for this business.</p>";
                                }
                            } else {
                                // Check if the email matches in 'users'
                                $query = "SELECT profile_image FROM users WHERE email = ?";
                                $stmt = $conn->prepare($query);

                                if (!$stmt) {
                                    die("Error preparing users statement: " . $conn->error);
                                }

                                $stmt->bind_param("s", $need['email']);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    // Fetch the profile image from 'users'
                                    $user = $result->fetch_assoc();
                                    
                                    if ($user['profile_image']) {
                                
                                        echo "<img src='data:image/jpeg;base64," . base64_encode($user['profile_image']) . "' alt='User Profile Image' style='width: 100px;border-radius: 50%;'>";
                                    } else {
                                        echo "<p>No profile image found for this user.</p>";
                                    }
                                } else {
                                    echo "<p>No matching business or user found with this email.</p>";
                                }

                                $stmt->close();}




                        ?>
                       </div>
                    <div style="display: block;padding: 15px;font-size: x-large;font-weight: bolder;"><h1 style="margin-top: 2px;color: black;">@<?php  echo htmlspecialchars($need['username'])?></h1>

                    </div>
                    </div>

                </div>
                <div><h1><?php  echo htmlspecialchars($need['job_title'])?></h1>
                    <p><?php  echo htmlspecialchars($need['description'])?> </p>
                </div>
               <div>
                
               </div>
            </div>
            <!-- right -->
            <div style="width: 30%;margin-top: 5%;">
                <div style="height: 400px;background-color: rgba(0, 255, 115, 0.099);margin:5px;padding: 10px;">
                <h1 style="color: black;text-align: start;margin-left: 8%;">Need Summary</h1>
                <ul style="margin-top: 40px;">
                    <li class="li">USERNAME:<?php  echo htmlspecialchars($need['username'])?><li>
                    <li class="li">EMAIL:<?php  echo htmlspecialchars($need['email'])?><li>
                    <li class="li">DEAL:<?php  echo htmlspecialchars($need['deal_amount'])?></li>
                    <li class="li">Location:<?php  echo htmlspecialchars($need['location'])?></li>
                    <li class="li">Dead-Line:<?php  echo htmlspecialchars($need['deadline'])?></li>
                </ul>
                    
            </div>
       
            </div>
        </div>
        <?php 
        // Display a button that creates a mailto link to contact
        echo '<a href="mailto:' . htmlspecialchars($need['email']) . '">
                <button style="width: 20%; height: 30px; margin-left: 25%; background-color: lightgreen;">CONTACT</button>
              </a>'; 
        ?>            <div>
            <h1>DETAILED DISCRIPTION</h1>
            <object class="pdf" 
                    data="./images/sample-lean-and-cool-resume.pdf"
                    width="800"
                    height="500">
            </object>


        </div>
    
    </div>
    </div>


</div>

<?php $conn->close(); ?>
<?php include './php/footer.php'; ?> 
</body>
</html>