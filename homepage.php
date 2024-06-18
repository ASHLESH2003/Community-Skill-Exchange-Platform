<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/homepage.css">
    <title>Document</title>
    <style> 
    .testimonialc {
            display: flex;
            padding-bottom: 20px;
            padding-left:50px;
            margin-bottom: -20px;
        }

        .testimonial {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 0 10px 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
           
        }

        .testimonial p {
            font-size: 18px;
            line-height: 1.6;
        }

        .testimonial .author {
            font-style: italic;
            margin-top: 10px;
        }

        .testimonial img {
            border-radius: 50%;
            margin-bottom: 20px;
            margin-left:140px;
            width: 130px;
            height: 130px;
        }</style>

</head>
<body>
  <?php session_start();
  ?>
<div class="bodytab">
  <div id="myNavbar">
    <div class="container">
<ul>
  <!-- <li style="float:left"><a href="#home"><img class="navlogo" src="images/logo4.png" alt=""></a></li> -->
  <li style="float:left;margin-top: -25px;"><a href="#home"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
  <li class="right-nav"><a href="who.php" style="background-color: green;padding-right:10px;color: white;padding-top: 30px;padding-bottom: 10px;"><span class="medium">@<?php echo $_SESSION['user'];?></span></a></li> 
  <li class="right-nav"><a href="#about"><span class="medium"></span>ABOUT</a></li>
  <li class="right-nav"><a href="#contact"><span class="medium">CONTACT</span></a></li>
  <?php
if (@$_SESSION['type']=='business') { 
  echo '<li class="right-nav"><a href="exploreforbusiness.php"><span class="medium" style="border: 4px solid white; padding: 10px; border-radius: 20px;">Explore</span></a></li>';
} else {
  echo '<li class="right-nav"><a href="explore.php"><span class="medium" style="border: 4px solid white; padding: 10px; border-radius: 20px;">Explore</span></a></li>';
}
?>

</ul>
     </div>
</div>
.
<div id="home" style="padding-top: 100px;background: linear-gradient(to right, lightblue, lightgreen);margin-top: 50px;">
  <div>
     <div class="explore"> <h2 style="font-size: 2em;color:black;">Trade skills, not cash.💰 <br> <span >This is the swap zone!🔀</span></h2>
      <a href="explore.php"><button class="button">Explore</button></a></div>
  </div>
<img src="./images/office-workers-sitting-desks-ezgif.com-gif-maker.gif" style="width: 55%;height: 30%;margin-left: 45%;" alt="">


<br><br><br>
<div class="vacancies-title" style="margin-left: 2%;color:whit;font-size: xx-large;">Vacancies</div>
<div class="vacancies-container" style="display: flex;">

<?php
// Establishing a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "fyproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the job types you want to sum up
$jobTypes = array("MARKETING", "TECHNOLOGY", "IT", "FOOD", "CUSTOMER SERVICE");

// Initialize variables to store the sum of vacancies and total posts
$totalVacancy = 0;
$totalPosts = 0;

// Loop through each job type
foreach ($jobTypes as $type) {
    // Query to fetch data for the specific job type
    $sql = "SELECT SUM(vacancy) AS total_vacancy, COUNT(*) AS total_posts FROM jobs WHERE job_type = '$type'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Add the sum of vacancies and total posts for the current job type to the overall totals
        $totalVacancy += $row["total_vacancy"];
        $totalPosts += $row["total_posts"];
        echo '<div class="vacancy-card">';
        echo '<div class="card-heading">' . $type . '</div>';
        echo '<ul class="card-statistics">';
        echo '<li>Total Posts: ' . $row["total_posts"] . '</li>';
        if ($row["total_vacancy"]){
        echo '<li>Total vacancy: ' . $row["total_vacancy"] . '</li>';}
        else{
          echo '<li>Total vacancy: 0</li>';
        }
        // You might need to query the total applicants from another table or calculate it differently
        echo '</ul>';
        echo '</div>';
    } else {
        // If no data found for the current job type, display zero
        echo '<div class="vacancy-card">';
        echo '<div class="card-heading">' . $type . '</div>';
        echo '<ul class="card-statistics">';
        echo '<li>Total Posts: 0</li>';
        echo '<li>Total vacancy: 0</li>';
        echo '</ul>';
        echo '</div>';
    }
}



$conn->close();
?>



  <a href="explore.php" style="text-decoration: none;color: white;">
    <div class="vacancy-card" style="background-color: lightgreen; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.406);">
      <div class="card-heading">EXPLORE MORE</div>
      <img src="./images/white-arrow-icon-5.png"  style="width: 90px;margin-left: 60%;" alt="">
    
    </div>
  </a>
</div>
 <br><br>
 <div class="vacancies-title" style="margin-left: 2%;color: rgb(0, 0, 0);font-size: xx-large;">Site Statistics</div>
 <div class="vacancies-container" style="display: flex;">
 
 <?php
// Establishing a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "fyproject"; // Assuming your database name is fyproject

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to count records in a table
function countRecords($conn, $tableName) {
    $sql = "SELECT COUNT(*) AS count FROM $tableName";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["count"];
    } else {
        return 0;
    }
}

// Fetch counts for each table
$usersCount = countRecords($conn, "users");
$businessCount = countRecords($conn, "business");
$jobsCount = countRecords($conn, "jobs");
$needsCount = countRecords($conn, "needs");

// Display counts in the specified format
echo '<div class="vacancy-card">';
echo '<div class="card-heading">FREELANCERS</div>';
echo '<ul class="card-statistics">';
echo '<h1>' . $usersCount . '</h1>';
echo '</ul>';
echo '</div>';

echo '<div class="vacancy-card">';
echo '<div class="card-heading">COMPANIES</div>';
echo '<ul class="card-statistics">';
echo '<h1>' . $businessCount . '</h1>';
echo '</ul>';
echo '</div>';

echo '<div class="vacancy-card">';
echo '<div class="card-heading">JOB POSTS</div>';
echo '<ul class="card-statistics">';
echo '<h1>' . $jobsCount . '</h1>';
echo '</ul>';
echo '</div>';

echo '<div class="vacancy-card">';
echo '<div class="card-heading">NEEDS</div>';
echo '<ul class="card-statistics">';
echo '<h1>' . $needsCount . '</h1>';
echo '</ul>';
echo '</div>';

$conn->close();
?>
</div>
<br><br><br>


<br>
<div style="display: flex; background-color: white; padding-top: 50px;">
  <div style="width: 40%;height: 500px;">
    <img id="about" src="./images/Screenshot 2024-04-10 071508.png" style="width:500px;margin: 20px;margin-top: -30px;">
        </div>
        <div style="width: 60%;padding:10px;padding-top: 100px;">
            <h2>We Help To Get The Best Job And Find A Talent</h2>
            <p style="font-size: medium;">
              Are you ready to embark on a journey of discovery and empowerment? Whether you're eager to showcase your expertise or thirsty for knowledge, our vibrant community of skill enthusiasts has something for everyone.
      Dive into a world of endless possibilities as you explore a diverse array of talents, from coding to cooking, gardening to graphic design, and everything in between. With Skill Dealers, the sky's the limit!
      Join us and unlock the secrets to success in an environment dedicated to fostering growth and collaboration. Our platform empowers you to thrive as you connect with like-minded individuals and exchange valuable skills.
      Best of all, it won't cost you a dime. At Skill Dealers, you "pay" with your time, investing in yourself and others as you swap skills and unlock new horizons.
      Ready to swap, learn, and grow? Start your journey with Skill Dealers today!
        </div>
</div><br><br><br>
<div style="display: flex; background-color: white; padding-top: 50px;">
  
  <div style="width: 60%;padding:10px;padding-top: 100px;">
    <h2>Look at Our Analysis, Make Good Decition</h2>
    <p style="font-size: medium;">
      Our platform offers insights derived from comprehensive analyses of posts and members. Are you ready to embark on a journey of discovery and empowerment? Whether you're eager to showcase your expertise or thirsty for knowledge, our vibrant community of skill enthusiasts has something for everyone.
      Dive into a world of endless possibilities as you explore a diverse array of talents, from coding to cooking, gardening to graphic design, and everything in between. With Skill Dealers, the sky's the limit!
      Join us and unlock the secrets to success in an environment dedicated to fostering growth and collaboration. Our platform empowers you to thrive as you connect with like-minded individuals and exchange valuable skills.
      Best of all, it won't cost you a dime. At Skill Dealers, you "pay" with your time, investing in yourself and others as you swap skills and unlock new horizons.
      Ready to swap, learn, and grow? Start your journey with Skill Dealers today!  <br>
   
    <div class="vacancy-card" style="background-color: lightgreen; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.406);height:6p0px">
    <a href="position.php" style="text-decoration: none;color: white;">
      <div class="card-heading">EXPLORE MORE</div>
      <img src="./images/white-arrow-icon-5.png"  style="width: 90px;margin-left: 60%;margin-top:-50px;" alt=""></a>
    
    </div>
  
    </p>
  </div>
  <div style="width: 40%;height: 500px;">
    <img id="about" src="./images/g.jpg" style="width:500px;margin: 20px;margin-top: 80px;">
  </div><br>
  
</div>
</a><br><br><br>
<div style=" background-color: white; padding-top: 50px;">
<h1 style="margin-left:460px">Customer Testimonials</h1>
        <div class="testimonialc" >
            
            <div class="testimonial">
                <img src="./images/depositphotos_65699901-stock-photo-black-man-keeping-arms-crossed.webp" alt="Avatar">
                <p>"Great service! I'm very satisfied with the results."</p>
                <p class="author">- John Doe</p>
            </div>
            <div class="testimonial">
                <img src="./images/1000_F_367709147_W4Q2pRjMcz7jUkuH4e1BIhmtCDceu3FH.jpg" alt="Avatar">
                <p>"Highly recommended. Professional and efficient."</p>
                <p class="author">- Jane Smith</p>
            </div>
            <div class="testimonial">
                <img src="./images/taha-abdel-dayem.jpg" alt="Avatar">
                <p>"Amazing experience. Will definitely use again!"</p>
                <p class="author">- Alice Johnson</p>
            </div>
        </div>
    </div>
<!-- jobs -->
<h1 style="margin-left: 40%;color: white;">JOBLISTINGS</h1>
<div class="vacancies-container" style="display: flex;"></div>

  <?php
// Enable error reporting for debugging
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

// Fetch data from the 'jobs' table
$query = "SELECT * FROM jobs";  // Retrieve all job records
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Loop through each record in the 'jobs' table
    while ($row = $result->fetch_assoc()) {
        // Extract relevant data
        $logo = base64_encode($row['banner']);  // Convert BLOB to base64 for image display
        $company_name = htmlspecialchars($row['company_name']);  // Escape HTML special characters
        $location = htmlspecialchars($row['location']);  // Escape HTML special characters
        $salary = htmlspecialchars($row['salary']);  // Escape HTML special characters
        
        // Output the job card HTML
        echo "
        <div class='job-card' style='display: flex; margin-bottom: 10px;'>
            <div style='display: flex; text-align: start;'>
                <div>
                    <img src='data:image/jpeg;base64, $logo' style='width: 90px;'>
                </div>
                <div style='width: 100%; margin-top: 5%; height: 50%; text-align: start;'>
                    <span style='font-size: larger; font-weight: bold;'>$company_name</span>
                </div>
            </div>
            <div style='display: flex; font-size: large; font-weight: bold; height: 50%; margin-top: 25px;'>
                <div style='width: 70%;'>
                    $location 📍
                </div>
                <div>
                    $salary  💵
                </div>
            </div>
            <div style='background-color: lightgreen; color: white; display: flex; align-items: center; padding: 10px;'>
                <h2 style='margin: 0;'>Apply Now</h2>
                <a href='discription.php?id={$row['job_id']}' style='margin-left: auto; text-decoration: none;'>
                    <img src='./images/white-arrow-icon-5.png' style='width: 90px;' alt=''>
                </a>
            </div>
        </div><br>
        ";
    }
} else {
    echo "No jobs found.";
}

$conn->close();
?>



  <a href="explore.php" ><button style="width: 65%;margin-left: 20%;  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.406);height: 50px;margin-top: 20px;background-color: rgb(28, 133, 28);border: 0;font-size: x-large;color: white;font-weight: bolder;">SHOW MORE</button></a>
  <br><br></div>
  
  </div>
</div></div>

<?php include './php/footer.php'; ?>
</div>
</body>
</html>