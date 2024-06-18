<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #d0e1f9, #4d648d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 30%;
            border: 2px solid black;
            border-radius: 10px;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: x-large;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            height: 40px;
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            height: 40px;
            border-radius: 10px;
            background-color: lightgreen;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        .extra-links {
            text-align: center;
            margin-top: 15px;
        }

        .extra-links a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .extra-links a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <br><br>
    <div style="margin-top:-700px;margin-left:-540px;padding-right:330px"><?php include"./php/backbutton.php" ;?></div>
    <div class="login-container">
 
        <h1>Login</h1>
        
        <form action="./php/login.php" method="post">
            <div class="form-group">
                <label for="email">Email ID:</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" name="pass" id="pass" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <div class="extra-links">
        </div>
    </div>
</body>
</html>
