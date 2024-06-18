<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post Form</title>
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
        }
        .action h3 {
            margin-top: 0;
        }
        input[type="text"] {
            padding: 5px;
            margin-right: 10px;
            width: 200px;
        }
        input[type="submit"] {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="action">
        <h3 style = "text-align:center">Delete Post</h3>
        <form action="php/delete_post.php" method="post">
            <label for="post_id">Post ID:</label>
            <input type="text" id="post_id" name="post_id" placeholder="Enter Post ID">
            <input type="submit" value="Delete Post">
        </form>
    </div>
</body>
</html>
