
To display all the fields from the "needs" table, you first need to fetch the data from the database and then output the field values within a suitable HTML structure. Here's an example script that fetches a record based on an ID retrieved from the URL, then outputs the data in a structured way:

php
Copy code
<?php
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the URL
if (isset($_GET['id'])) {
    $need_id = intval($_GET['id']);  // Convert to integer to ensure valid ID
    
    // Fetch the record from the 'needs' table using the given ID
    $query = "SELECT * FROM needs WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $need_id);  // Bind the ID parameter
    $stmt->execute();
    $result = $stmt->get_result();  // Fetch the result set
    
    if ($result->num_rows > 0) {
        // Fetch the record
        $need = $result->fetch_assoc();
    }
}