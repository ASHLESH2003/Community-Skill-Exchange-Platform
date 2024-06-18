<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Need Post Edit Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .section {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-input, .form-textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: #28a745;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="section">
        <h3 style = "text-align:center">Need Post Edit</h3>
        <form action="update.php" method="post">
            <div class="form-group">
                <label for="JobTitle">Need Title:</label>
                <input type="text" id="JobTitle" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="description">Description of your Need:</label>
                <textarea id="description" rows="6" class="form-textarea" required></textarea>
            </div>
            <div class="form-group">
                <label for="resume">Attach Description if exists:</label>
                <input type="file" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="banner">Choose Banner Image:</label>
                <input type="file" class="form-input">
            </div>
            <div class="form-group">
                <button type="submit" class="button" name="update_need_post">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
