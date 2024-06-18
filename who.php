<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/normal.css">
    <style>
        body {
            background: linear-gradient(to right, #54a0ff, #acb6e5); /* Set background color */
            font-family: Arial, sans-serif; /* Set font family */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }

        .button {
            background-color: #4CAF50; /* Green background color */
            border: none; /* Remove border */
            color: white; /* White text color */
            padding: 15px 32px; /* Padding for button */
            text-align: center; /* Center text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Display as inline block */
            font-size: 16px; /* Font size */
            margin-top: 20px; /* Margin from top */
            cursor: pointer; /* Cursor style */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for background color */
        }

        .button:hover {
            background-color: #45a049; /* Darker green color on hover */
        }
    </style>
    <script>
      // Function to get the value of a specific query parameter
      function getQueryParameter(name) {
          const params = new URLSearchParams(window.location.search);
          return params.get(name);
      }

      // When the page loads, check for the 'username' query parameter and display an alert
      window.onload = function() {
          const username = getQueryParameter("error");
          if (username) {
              alert("ALERT...! " + username + "!");
          }
      };
  </script>
</head>
<body>
<div id="myNavbar" style="width: 92%;margin-left: 3%;margin-top: -30px;">
        <div class="container">
    <ul>
    <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
    <li class="right-nav"><a href="explore.php"><span style="border: 3px solid white;padding: 10px;border-radius: 20px;" class="medium">Explore</span></a></li>
    <li class="right-nav"><a href="homepage.php"><span style="border: 3px solid white;padding: 10px;border-radius: 20px;" class="medium">Home</span></a>/</li> 
    </ul>
        </div>
    </div>
    <div>
        <div class="who" >
          <h1 id="login" style="text-align: center;font-weight: bolder;font-size: 50px; font-family: Arial, sans-serif;padding-top: 50px;">Join Our Community</h1>
          <br>
          <div style="display: flex;">
          <div style="width: 50%;">
            <a href="user.html"><img class="whoimage" src="./images/219970.png" style="margin-left: 25%;" width="500px" alt=""></a>
            <h1 style="text-align: center;margin-left: 18%;">FREELACER</h1>
          </div>
          <div style="width: 50%;">
          <a href="business.html"><img class="whoimage" src="./images/man-1351346_1280.webp" style="border-radius: 100%; height: 450px;padding-top: 35px;" width="550px">
          </a>
            <h1 style="text-align: center;margin-left: -28%;padding-top: 15px;">JOB PROVIDER</h1>
        </div>
        </div>
        <a href="login.php"> <button class="button" style="margin-left: 35%;width:400px;height:100px"><h1>Login</h1></button></a> <br><br> 
        </div>
        </div>
        
      
      </div>
      <?php include './php/footer.php'; ?>
</body>
</html>
