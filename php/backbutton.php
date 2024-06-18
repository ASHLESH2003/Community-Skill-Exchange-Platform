<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Button</title>
    <style>
        #backForm {
            display: inline;
        }

        #backButton {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        #backButton:hover {
            background-color: #45a049; /* Darker green */
        }

        .arrow {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<form id="backForm" action="" method="post">
    <button type="submit" id="backButton" name="backButton">
        <span class="arrow">&larr;</span> Back
    </button>
</form>

<script>
    document.getElementById('backForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        window.history.back(); // Go back in history
    });
</script>

</body>
</html>
