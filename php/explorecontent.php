<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$keyword = $_GET['keyword'] ?? '';
$type = $_GET['type'] ?? '';
$exp = $_GET['exp'] ?? 0;
$exp = (int)$exp;
$posttype = $_GET['posttype'] ?? '';

$keyword = '%' . $keyword . '%';

// Query to fetch filtered results
$query_filtered = "
    SELECT explore.*, users.profile_image, business.logo
    FROM explore
    LEFT JOIN users ON explore.email = users.email
    LEFT JOIN business ON explore.email = business.email
    WHERE explore.searchtype = ? 
    AND explore.exp <= ? 
    AND explore.type = ? 
    AND explore.description LIKE ?
";

$stmt = $conn->prepare($query_filtered);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("siss", $type, $exp, $posttype, $keyword);
$stmt->execute();
$result_filtered = $stmt->get_result();

function displayCard($row) {
    $link = "";
    if ($row['type'] === "Job Post") {
        $link = "discription.php?id=" . htmlspecialchars($row['id']) . "&email=" . htmlspecialchars($row['email']);
    } elseif ($row['type'] === "need post") {
        $link = "need-display.php?id=" . htmlspecialchars($row['id']) . "&email=" . htmlspecialchars($row['email']);
    } elseif ($row['type'] === "Skill Post") {
        $link = "skill-display.php?id=" . htmlspecialchars($row['id']) . "&email=" . htmlspecialchars($row['email']);
    }

    echo "<a href=\"$link\" class='container'>
            <div class=\"card\">
                <img src=\"data:image/jpeg;base64," . base64_encode($row['banner']) . "\" alt=\"\">
                <div>";

    // Display the profile image or business logo
    if (!empty($row['profile_image'])) {
        echo "<img class=\"dp\" src=\"data:image/jpeg;base64," . base64_encode($row['profile_image']) . "\" alt=\"Profile Image\">";
    } elseif (!empty($row['logo'])) {
        echo "<img class=\"dp\" src=\"data:image/jpeg;base64," . base64_encode($row['logo']) . "\" alt=\"Business Logo\">";
    } else {
        echo "<img class=\"dp\" src=\"./images/default.png\" alt=\"Default Image\">";
    }

    echo "<span style=\"width: 260px;\">" . htmlspecialchars($row['name']) . "</span><span>";

    if ($row['type'] === "Skill Post") {
        $rating = $row['rating'];
        $no_ppl_voted = $row['no_ppl_voted'];

        if ($no_ppl_voted > 0) {
            $avg_rating = $rating / $no_ppl_voted;
            $full_stars = floor($avg_rating);
            $half_star = $avg_rating - $full_stars >= 0.5;

            for ($i = 0; $i < $full_stars; $i++) {
                echo "🌟";
            }

            if ($half_star) {
                echo "⭐"; // Adjust this to a half star if you have an icon or specific style
            }

            echo "<span style=\"font-size: 10px;\">(" . htmlspecialchars($no_ppl_voted) . ")</span>";
        } else {
            echo "<span>No ratings yet.</span>";
        }
    }

    echo " </span>   </div>
            <br>";

    $truncated_description = substr(htmlspecialchars($row['information']), 0, 100) . '...';

    echo "<p>" . htmlspecialchars($row['description']) . "<br><a href=\"$link\"><span style=\"color: grey; font-size: small;\">$truncated_description </span><span style=\"color: green;\">Read More</span></a></p>";

    echo "</div>
        </a>";
}

if ($result_filtered === false) {
    echo "<div>No records found.<br></div>";
} else {
    if ($result_filtered->num_rows > 0) {
        while ($row = $result_filtered->fetch_assoc()) {
            displayCard($row);
        }
    } else {
        echo "No results found<br>";
    }

    echo "_____________________________________________________________________________________________________________________________________________________________<br><br><br><br><br>";

    // Query to fetch all results
    $query_all = "
        SELECT explore.*, users.profile_image, business.logo
        FROM explore
        LEFT JOIN users ON explore.email = users.email
        LEFT JOIN business ON explore.email = business.email
    ";
    $result_all = $conn->query($query_all);

    if ($result_all->num_rows > 0) {
        while ($row = $result_all->fetch_assoc()) {
            displayCard($row);
        }
    } else {
        echo "No results found.<br>";
    }
}

$stmt->close();
$conn->close();
?>
