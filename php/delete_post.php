<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];

    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        echo "Post deleted successfully";
    } else {
        echo "Error deleting post: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
