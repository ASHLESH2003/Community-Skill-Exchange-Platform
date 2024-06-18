<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Post Edit Form</title>
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
        <h3 style = "text-align:center">Job Post Edit</h3>
        <form action="update.php" method="post">
            <div class="form-group">
                <label for="id">Search ID:</label>
                <input type="text" id="id" name="id" class="form-input" required>
                <button class="button">Search</button>
            </div>
            <div class="form-group">
                <label for="logo">Upload Banner:</label>
                <input type="file" accept="image/jpeg, image/png" class="form-input">
            </div>
            <div class="form-group">
                <input type="text" id="name" placeholder="Company Name" class="form-input">
                <input type="text" id="location" placeholder="Location" class="form-input">
                <input type="text" id="salary" placeholder="Salary per Month" class="form-input">
            </div>
            <div class="form-group">
                <label for="description">Job Description:</label>
                <textarea id="description" name="description" class="form-textarea" required></textarea>
            </div>
            <div class="form-group">
                <label for="responsibilities">Responsibilities:</label>
                <textarea name="responsibilities" class="form-textarea" required></textarea>
            </div>
            <div class="form-group">
                <label for="qualifications">Qualifications:</label>
                <textarea name="qualifications" required class="form-textarea"></textarea>
            </div>
            <div class="form-group">
                <label for="vacancy">Vacancy:</label>
                <input type="number" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="nature">Nature:</label>
                <select class="form-input" required>
                    <option value="full-time">Full-time</option>
                    <option value="part-time">Part-time</option>
                    <option value="contract">Contract</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">Published Date:</label>
                <input type="datetime-local" class="form-input" required>
                <label for="deadline">Deadline for Applying:</label>
                <input type="datetime-local" class="form-input" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button" name="update_job_post">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
