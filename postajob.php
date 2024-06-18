<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #2ecc71, #27ae60);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            max-height:1000px;
            margin: 20px auto;
            padding: 20px;
            padding-bottom: 950px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2ecc71;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
            height: 150px;
        }

        input[type="file"] {
            margin-bottom: 5px;
        }

        img {
            display: block;
            max-width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #2ecc71;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Post a Job</h1>
        <form id="jobForm" method="post" action="./php/jobs.php" enctype="multipart/form-data">
            <label for="logo" >Upload Banner:</label>
            <input type="file"  id="logo" name="logo" accept="image/png, image/jpeg" onchange="previewLogo(event)" required>

            <img id="logoPreview" src="#" alt="Logo Preview" style="display: none;">

            <label for="name">Company Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="name">Company email:</label>
            <input type="text" id="email" name="email" required>
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="salary">Salary / month:</label>
            <input type="text" id="salary" name="salary" required>

            <label for="description">Job Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="responsibilities">Responsibilities:</label>
            <textarea id="responsibilities" name="responsibilities" required></textarea>

            <label for="qualifications">Qualifications:</label>
            <textarea id="qualifications" name="qualifications" required></textarea><br>
            <label for="exp">Experience:</label>
            <select name="exp" id="exp"  style="width: 300px;height: 50px;border-radius: 6px;text-align: center;">
                <option value="0">Fresher</option>
                <option value="1"> less than 1 year</option>
                <option value="2"> less than 3 year</option>
                <option value="3"> less than 5 year</option>
                <option value="4"> less than 10 year</option>
                <option value="5"> more than 10 year</option>
        
            </select><br>

            <label for="skill">Skills Required:</label>
            <input type="text" id="skill" name="skill" required>
            <label for="vacancy">Vacancy:</label>
            <input type="number" id="vacancy" name="vacancy" required>

            <label for="nature">Nature:</label>
            <select id="nature" name="nature" required>
                <option value="fulltime">Full-time</option>
                <option value="parttime">Part-time</option>
                <option value="contract">Contract</option>
            </select>

            <label for="published_date">PUBLISHED DATE:</label>
            <input type="datetime-local" id="published_date" name="published_date" required> <br><br>
            <label for="type">TYPE:</label>
            <select name="type" id="type">
                <option value="MARKETING">MARKETING</option>
                <option value="TECHNOLOGY">TECHNOLOGY</option>
                <option value="IT">IT</option>
                <option value="FOOD">FOOD</option>
                <option value="CUSTOMER SERVICE">CUSTOMER SERVICE</option>
                <option value="BANKING">BANKING</option>
                <option value="MUSIC">MUSIC</option>
            </select> <br><br>
            <label for="application_deadline">Deadline for Applying:</label>
            <input type="datetime-local" id="application_deadline" name="application_deadline" required> <br><br>

            <input type="submit" value="Submit">
        </form>
    </div>  <?php include './php/footer.php'; ?>

    <script>
        function previewLogo(event) {
            const logoPreview = document.getElementById('logoPreview');
            const file = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function() {
                logoPreview.src = reader.result;
                logoPreview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    </script>
      
</body>
</html>
