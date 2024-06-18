<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Need</title>
    <link rel="stylesheet" href="./css/explore.css">
    <style>
        body {
            font-family: Arial, sans-serif;

            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 50%;
            padding: 60px;
            background-color: #fff;
            border-radius: 10px;
            margin-left:18%;
            margin-top:-10%;
            box-shadow:0.3px 2px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: auto; /* Ensure content doesn't get cut off */
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], input[type="datetime-local"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            font-size: 14px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            margin-top:1400px;
            margin-left:-82%;
            position: relative;
            width:1400px;
            bottom: 0;
        }


    </style>
</head>
<body>
    <!-- <div id="myNavbar" style="width: 98%;margin-left:1%">
        <div class="container">
    <ul>
      <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
      <li class="right-nav"><a href="postaskill.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A SKILL</span></a></li>
      <li class="right-nav"><a href="postaneed.php "><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A NEED</span></a>/</li> 
      <li class="right-nav"><a href="companey_updates.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">NEWS</span></a>/</li> 
    </ul>
        </div>
    </div><br><br><br><br><br> -->

<div style="margin-top:-1500px;">
<?php include './php/backbutton.php'; ?><br>
</div>
    

<div class="container">
    <form id="need" method="post" action="./php/need.php" enctype="multipart/form-data">

        <label for="Username">Username:</label>
        <input type="text" name="Username" id="Username" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="deal">Deal Amount:</label>
        <input type="text" name="deal" id="deal" required>
        
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>
        
        <label for="deadline">Deadline:</label>
        <input type="datetime-local" name="deadline" id="deadline" required>

        <label for="JobTitle">Your Need Title:</label>
        <input type="text" name="JobTitle" id="JobTitle" required>
        <label for="JobTitle">Experience:</label>
        <select name="exp" id="exp"  style="width: 300px;height: 50px;border-radius: 6px;text-align: center;">
            <option value="0">Fresher</option>
            <option value="1"> less than 1 year</option>
            <option value="2"> less than 3 year</option>
            <option value="3"> less than 5 year</option>
            <option value="4"> less than 10 year</option>
            <option value="5"> more than 10 year</option>
    
        </select><br><br>
        <label for="type">TYPE:</label>
            <select name="type" id="type"  style="width: 300px;height: 50px;border-radius: 6px;text-align: center;">
                <option value="MARKETING">MARKETING</option>
                <option value="TECHNOLOGY">TECHNOLOGY</option>
                <option value="IT">IT</option>
                <option value="FOOD">FOOD</option>
                <option value="CUSTOMER SERVICE">CUSTOMER SERVICE</option>
                <option value="BANKING">BANKING</option>
                <option value="MUSIC">MUSIC</option>
            </select> <br><br>
        <br>
        <label for="description">Description of your Need:</label>
        <textarea name="description" id="description" rows="6" required></textarea>

        <label for="skill">Skills needed:</label>
        <input type="text" id="skill" name="skill">
        <label for="resume">Attach Description (if any):</label>
        <input type="file" id="resume" name="resume">

        <label for="banner">Choose Banner Image:</label>
        <input type="file" id="banner" name="banner">

        <input type="submit" value="Submit">
    </form>
</div></div>
    </div>
    <?php include './php/footer.php'; ?> 

</body>



</html>
