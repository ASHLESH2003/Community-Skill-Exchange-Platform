<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $sql = "INSERT INTO blocked_emails (email) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "Email blocked successfully";
    } else {
        echo "Error blocking email: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
