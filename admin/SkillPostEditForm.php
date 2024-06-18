<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Post Edit Form</title>
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
        <h3 style = "text-align:center">Skill Post Edit</h3>
        <form action="update.php" method="post">
            <div class="form-group">
                <label for="id">Search ID:</label>
                <input type="text" id="id" name="id" class="form-input" required>
                <button class="button">Search</button>
            </div>
            <div class="form-group">
                <label for="input-file">Upload Image</label>
                <input type="file" accept="image/jpeg, image/png" class="form-input">
            </div>
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Name" required class="form-input">
                <input type="text" name="email" id="email" placeholder="Email" required class="form-input">
            </div>
            <div class="form-group">
                <input type="text" name="ph" placeholder="Contact" required class="form-input">
                <input type="text" name="JobTitle" placeholder="Skills" required class="form-input">
            </div>
            <div class="form-group">
                <label for="description">Experience (years):</label>
                <textarea name="description" rows="6" class="form-textarea" required></textarea>
            </div>
            <div class="form-group">
                <label for="links">Links:</label>
                <input type="text" name="links" placeholder="GitHub Link" class="form-input">
                <input type="text" name="links" placeholder="LinkedIn Link" class="form-input">
            </div>
            <div class="form-group">
                <label for="resume">Attach Resume:</label>
                <input type="file" class="form-input">
            </div>
            <div class="form-group">
                <button type="submit" class="button" name="update_skill_post">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
