<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/normal.css">
    <link rel="stylesheet" href="./css/explore.css">
    <script>
        // Function to get the value of a specific query parameter
        function getQueryParameter(name) {
            const params = new URLSearchParams(window.location.search);
            return params.get(name);
        }

        // When the page loads, check for the 'username' query parameter and display an alert
        window.onreload = function() {
            const message = getQueryParameter("message");
            if (message) {
                alert( message);
            }
        };
    </script>
</head>
<body style="background: linear-gradient(to right, lightblue, lightgreen);">
<?php
session_start();
$email=$_SESSION['email'];?>    
<div style="width: 98%;background-color: white;margin-left: 1%;">
<div id="myNavbar" style="width: 98%;margin-left: -0.5%;">
        <div class="container">
    <ul>
      <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
      <li class="right-nav"><?php echo "<a href='applicants.php?email=" . $email . "'>"; ?><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">Applicants</span></a></li>
      <li class="right-nav"><a href="postajob.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A JOB</span></a>/</li> 
      <li class="right-nav"><a href="companey_updates.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">NEWS</span></a>/</li> 
      <li class="right-nav"><a href="addnews.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">ADD NEWS</span></a>/</li> 
    </ul>
        </div>
    </div>
    <div style="display: flexbox;" >
 .  <img src="./images/joblist.png" style="width: 100%;margin-top: 50px;margin-left: 0px;">
    <form methord="get">
    <div class="searchbar">
    <input type="text" id="title" name="keyword" placeholder="ENTER KEYWORD" style="width: 300px;height: 50px;border-radius: 6px;text-align: center;">

    <select name="type" id="type"  style="width: 300px;height: 50px;border-radius: 6px;text-align: center;">
                <option value="IT">IT</option>
                <option value="MARKETING">MARKETING</option>
                <option value="TECHNOLOGY">TECHNOLOGY</option>
                <option value="FOOD">FOOD</option>
                <option value="CUSTOMER SERVICE">CUSTOMER SERVICE</option>
                <option value="BANKING">BANKING</option>
                <option value="MUSIC">MUSIC</option>
            </select> 
    <select name="exp" id=""  style="width: 300px;height: 50px;border-radius: 6px;text-align: center;">
        <option value="0">Fresher</option>
        <option value="1"> less than 1 year</option>
        <option value="2"> less than 3 year</option>
        <option value="3"> less than 5 year</option>
        <option value="4"> less than 10 year</option>
        <option value="5"> more than 10 year</option>

    </select>

    <input type="radio" name="posttype" id="posttype" value='Job Post' class='button'>JOBS &nbsp;
    <input type="radio" name="posttype" id="posttype" value='need post' class='button'>NEEDS&nbsp;
    <input type="radio" name="posttype" id="posttype" value='Skill Post' class='button'>TALENTS&nbsp;


        <!-- <button class="button">/button>
        <button class="button">JOBS</button>
        <button class="button">NEEDS</button>
        <button class="button">TALENTS</button> -->
        <input type="submit" value="🔎" class="button" style='width: 60px;height: 50px;'><br><br>
        


    </form>
    

    </div>

    <div class="content" style="background-color: rgb(255, 255, 255);margin-top: 20px; margin-left:3%;margin-top: 100px;margin-bottom: 50px ;">
<?php include "./php/explorecontent.php"; ?>




    </div>
    <?php include './php/footer.php'; ?>
    
</div>
</body>
</html>