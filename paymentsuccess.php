<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f7f9fc;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .checkmark-circle {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 1rem;
        }

        .checkmark-circle .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            background-color: #4CAF50;
            border-radius: 50%;
        }

        .checkmark-circle .checkmark {
            position: absolute;
            top: 25px;
            left: 25px;
            width: 50px;
            height: 25px;
            border: 5px solid white;
            border-top: none;
            border-right: none;
            transform: rotate(-45deg);
        }

        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
        }

        p {
            color: #666;
            margin-bottom: 2rem;
        }

        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 20px;
        }

        button:hover {
            background: #45a049;
        }

        .rating {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
        }

        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #ffcc00;
        }

        .rating input:checked ~ label ~ label {
            color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="checkmark-circle">
                <div class="background"></div>
                <div class="checkmark"></div>
            </div>
            <h1>Payment Successful</h1>
            <p>Thank you for your purchase! Your transaction has been completed successfully. <br> <br>Rate your experience with the Freelancer..!</p>
            <form action="" method="get">
                <div class="rating">
                    <input type="radio" name="rating" id="star1" value="1">
                    <label for="star5" onclick="setRating(1)">★</label>
                    <input type="radio" name="rating" id="star2" value="2">
                    <label for="star4" onclick="setRating(2)">★</label>
                    <input type="radio" name="rating" id="star3" value="3">
                    <label for="star3" onclick="setRating(3)">★</label>
                    <input type="radio" name="rating" id="star4" value="4">
                    <label for="star2" onclick="setRating(4)">★</label>
                    <input type="radio" name="rating" id="star5" value="5">
                    <label for="star1" onclick="setRating(5)">★</label>
                </div>
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
                <button type="submit">Submit Rating</button>
            </form>
            <button onclick="redirectToHome()">Go to Homepage</button>
        </div>
    </div>

    <script>
        function redirectToHome() {
            window.location.href = 'homepage.php';  // Change this to your desired URL
        }

        function setRating(rating) {
            document.querySelectorAll('.rating label').forEach((label, index) => {
                label.style.color = index < 5 - rating ? '#ddd' : '#ffcc00';
            });
        }
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['rating']) && isset($_GET['email'])) {
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fyproject";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $rating = intval($_GET['rating']);
        $email = $conn->real_escape_string($_GET['email']);

        // Update the rating and no_ppl_voted in the database
        $stmt = $conn->prepare("UPDATE explore SET rating = rating + ?, no_ppl_voted = no_ppl_voted + 1 WHERE email = ?");

        $stmt->bind_param("is", $rating, $email);

        if ($stmt->execute()) {
            echo "<script>alert('Rating updated successfully');</script>";
        } else {
            echo "<script>alert('Error updating rating: " . $conn->error . "');</script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
