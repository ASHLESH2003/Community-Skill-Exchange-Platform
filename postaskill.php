<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Skill</title>
    <link rel="stylesheet" href="./css/normal.css">
    <!-- <link rel="stylesheet" href="./css/details.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    /* 
            .navbar {
                background: linear-gradient(to right, lightblue, lightgreen);
                padding-right: 15px;
                padding-left: 15px;
            } */

        .container {
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
        }

        .logo a {
            font-size: 35px;
            font-weight: 600;
            color: black;
        }

        .hero {
            background-color: #fff;
            padding: 80px;

            text-align: center;
        }

        .card {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        .card h1 {
            font-weight: 500;
            color: #333;
            margin-bottom: 20px;
        }

        .card img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .card label {
            display: block;
            width: 200px;
            background: #007bff;
            color: #fff;
            padding: 12px;
            margin: 10px auto;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .card label:hover {
            background-color: #0056b3;
        }

        /* .card input {
            display: none;
        } */

        #form {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            flex-grow: 1;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: calc(50% - 10px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        textarea {
            height: 150px;
            resize: none;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
        }
    </style>
</head>

<body>
<div id="myNavbar" style="width: 98%;margin-left:1%">
        <div class="container">
    <ul>
      <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
      <li class="right-nav"><a href="postaskill.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A SKILL</span></a></li>
      <li class="right-nav"><a href="postaneed.php "><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A NEED</span></a>/</li> 
      <li class="right-nav"><a href="companey_updates.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">NEWS</span></a>/</li> 
    </ul>
        </div>
    </div><br><br><br><br><br>
    <?php include './php/backbutton.php'; ?><br>
    <div id="form">
        <form action="./php/skill.php" method="post" enctype="multipart/form-data" id="skill">

            <div class="hero">
                <div class="card">
                    <h1>Upload your profile pic</h1>
                    <img src="./images/219970.png" alt="Profile Pic" id="profile-pic">

                    <input type="file" accept="image/jpeg, image/png, image/jpg" id="profilepic" name="profile_image">
                    <label for="banner">Upload banner <input type="file" name="banner" accept="image/jpeg, image/png, image/jpg" id="banner" style="visibility: hidden;"> </label>
                </div>
            </div>
            
            <input type="text" name="name" id="name" placeholder="NAME" required>
            <input type="text" name="email" id="email"  placeholder="EMAIL" required><br>
            <input type="text" name="ph" id="ph"  placeholder="CONTACT" required>
            <input type="text" name="SKILLS" id="SKILLS"  placeholder="SKILLS" required>
                <br>
            <label for="title">TITTLE:</label>
            <textarea name="title"  rows="6" style="width: 100%;height: 50px;" required></textarea>
            <label for="description">DISCRIPTION:</label>
            <textarea name="description" rows="6" style="width: 100%;height: 80px;" required></textarea>

            <label for="skillexplain">Experience in that skill / No of years you have been working on that:</label>
            <textarea name="skillexplain" rows="6" style="width: 100%;" required></textarea>
<br><label for="exp">Experience</label>
            <select name="exp" id="exp"  style="width: 300px;height: 50px;border-radius: 6px;text-align: center;">
                <option value="0">Fresher</option>
                <option value="1"> less than 1 year</option>
                <option value="2"> less than 3 year</option>
                <option value="3"> less than 5 year</option>
                <option value="4"> less than 10 year</option>
                <option value="5"> more than 10 year</option>

            </select><br><br>
            <label for="type">TYPE:</label>
            <select name="type" id="type" style="width: 300px;height: 50px;border-radius: 6px;text-align: center;">
                <option value="MARKETING">MARKETING</option>
                <option value="TECHNOLOGY">TECHNOLOGY</option>
                <option value="IT">IT</option>
                <option value="FOOD">FOOD</option>
                <option value="CUSTOMER SERVICE">CUSTOMER SERVICE</option>
                <option value="BANKING">BANKING</option>
                <option value="MUSIC">MUSIC</option>
            </select> <br><br>
            <label for="links">Links:</label><br>
            <input type="text" name="links1" style="width:45%;" placeholder="GitHub Link">
            <input type="text" name="links2" style="width:45%;" placeholder="LinkedIn Link"><br>
    

            <label for="resume">Attach Resume:</label>
            <input type="file" id="resume" name="resume" required><br>
            <label for="amt">Enter Deal Amt in USD:</label>
            <input type="number" id="amt" name="amt" required> <br><br>


            <input type="submit" value="Submit">
        </form>
    </div>

    <?php include './php/footer.php'; ?>

    <script>
        let profilePic = document.getElementById("profile-pic");
        let inputFile = document.getElementById("profilepic");

        inputFile.onchange = function () {
            profilePic.src = URL.createObjectURL(inputFile.files[0]);
        };

    </script>
</body>
</html>
