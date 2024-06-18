<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .action {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .action h3 {
            margin-top: 0;
        }
        input[type="text"] {
            padding: 5px;
            margin-right: 10px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="action">
        <h3 style = "text-align:center">Delete User</h3>
        <form action="php/delete_user.php" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" placeholder="Enter User ID" required>
            <input type="submit" value="Delete User">
        </form>
    </div>
</body>
</html>
