<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Notifications</title>
    <link rel="stylesheet" href="./css/news.css">
    <link rel="stylesheet" href="./css/normal.css">

</head>
<body>

<div class="main-nav" style="margin-top: -20px;">
<div id="myNavbar" style="width: 95%;margin-top:10px;margin-left:35px;height:50px;padding-bottom:10px">
        <div class="container">
    <ul>
      <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="font-size:38px;margin-left:-100px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
      <li class="right-nav"><a href="postaskill.php"><span style="font-size:15px;padding:-10px" class="medium">POST A SKILL</span></a></li>
      <li class="right-nav"><a href="postaneed.php"><span style="font-size:15px;padding-10px" class="medium">POST A NEED</span></a>/</li> 
      <li class="right-nav"><a href="explore.php"><span style="font-size:15px;padding:-10px" class="medium">EXPLORE</span></a>/</li> 

    </ul>
        </div>
    </div>
</div>

<main class="content" style="width: 100%;background-color:white;color:black;font-size:medium;font-weight:">
<h1 style="text-align: center; color: rgba(0,0,5); text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);font-size:50px">Company Chronicles</h1>
We believe in transparency, communication, and keeping our stakeholders informed. Our news page serves as a central hub for all updates, announcements, and developments related to our company. Whether it's new product launches, strategic partnerships, team expansions, or industry insights, you'll find it all here.

Stay tuned to this space to get the latest scoop on what's happening behind the scenes . We're committed to sharing our journey with you, our valued stakeholders, and keeping you engaged every step of the way.

From exciting milestones to important initiatives, our news page is your go-to destination for staying in the loop. Join us as we continue to innovate, grow, and make strides.<div class="section" id="most-recent">
        <h1 class="section-title" style="color:black;font-size:30px">Most Recent</h1>
        <div class="cards">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "fyproject";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch most recent news
            $sql = "SELECT * FROM news_table ORDER BY created_at DESC LIMIT 2";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card">
                            <div class="card-header">
                                <img decoding="async" src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="news-image">
                            </div>
                            <div class="card-content">
                                <h3 class="news-title">' . $row["title"] . '</h3>
                                <h6 class="news-source">' . $row["source"] . '</h6>
                                <p class="news-desc">' . $row["description"] . '</p>
                                <p class="company-name">' . $row["company_name"] . '</p>
                            </div>
                          </div>';
                }
            } else {
                echo "<p>No recent news available.</p>";
            }
            ?>
        </div>
    </div>

    <div class="section" id="others">
        <h1 class="section-title" style="color:black;font-size:30px">Others</h1>
        <div class="cards">
            <?php
            // Fetch older news
            $sql = "SELECT * FROM news_table ORDER BY created_at DESC LIMIT 3, 100";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card">
                            <div class="card-header">
                                <img decoding="async" src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="news-image">
                            </div>
                            <div class="card-content">
                                <h3 class="news-title">' . $row["title"] . '</h3>
                                <h6 class="news-source">' . $row["source"] . '</h6>
                                <p class="news-desc">' . $row["description"] . '</p>
                                <p class="company-name">' . $row["company_name"] . '</p>
                            </div>
                          </div>';
                }
            } else {
                echo "<p>No other news available.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</main>
        </div>
        <?php include './php/footer.php'; ?>
</body>
</html>
