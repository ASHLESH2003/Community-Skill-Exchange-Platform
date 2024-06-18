<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analysis Page</title>
    <link rel="stylesheet" href="./css/normal.css">
    <link rel="stylesheet" href="./css/explore.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            rgb(230, 244, 243);
            padding: 0;
    Green linear gradient */
        }
        .centered-div {
            width: 90%; /* Adjust width as needed */
            margin: 0 auto; /* Center the div */
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        }
        .section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 60px;
        }
        .graph-container,
        .text-container {
            width: 48%;
        }
        .graph-container img {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .text-container {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 15px;
            margin-left: 205px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            

        }
    </style>
</head>
<body>
<div style="width: 98%;background-color: white;margin-left: 5%;">
<div id="myNavbar" style="width:92%">
    <div class="container">
<ul>
  <!-- <li style="float:left"><a href="#home"><img class="navlogo" src="images/logo4.png" alt=""></a></li> -->
  <li style="float:left;margin-top: -25px;"><a href="homepage.php"><span  class="title" style="padding-top: -10px;"><span >S</span>kill <span>D</span>ealers</span></a></li>
      <li class="right-nav"><a href="postaskill.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A SKILL</span></a></li>
      <li class="right-nav"><a href="postaneed.php "><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">POST A NEED</span></a>/</li> 
      <li class="right-nav"><a href="companey_updates.php"><span style="border: 3px solid white;padding: 10px;font-size:medium;" class="medium">NEWS</span></a>/</li> 
    </ul>
</ul>
     </div>
</div>
<?php
    exec('python py/analysis.py');
    ?>
    
    <div class="centered-div" >
        <h1 style="text-align: center; color: rgba(0,0,5); text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);margin-top:70px;font-size:50px">Our Analysis</h1>
        <span>Welcome to our Analysis Page! Here, we delve into the intricate details of various job sectors to provide you with comprehensive insights. Our goal is to equip you with the necessary knowledge to navigate the competitive job market successfully.The primary motive of this page is to analyze job trends, skill demands, and organizational needs. By doing so, we aim to highlight key areas for skill development and help you align your professional growth with industry requirements.We believe that awareness is the first step towards growth. Our analyses shed light on the evolving job market and the skills that are in high demand. By staying informed, you can make better career decisions and stay ahead in your professional journey</span><br><br>
        <div class="section" style="align-self: right;">
        
        <div>
             
        </div>
            <div class="graph-container">
                <img src="./images/plot1.png" alt="Jobs Analysis" style="width: 100%;">
            </div>
            <div class="text-container">
                <h2>Jobs Analysis</h2>
                <p>To excel in today's competitive job market, it's crucial to understand the evolving landscape of job requirements. Analyzing job postings provides invaluable insights into the specific skills and qualifications that employers are seeking. By identifying trends and patterns in job descriptions, individuals can tailor their learning and professional development efforts to align with industry demands. This analysis sheds light on the essential skills and competencies necessary to secure employment opportunities, guiding individuals towards areas of focus for learning and practice.</p>
            </div>
        </div>

        <div class="section">
            
            <div class="text-container" >
                <h2>Skill Analysis</h2>
                <p>In today's dynamic workforce, possessing the right skills is paramount for career success. Analyzing skill trends across various industries and job roles offers valuable guidance for individuals seeking to enhance their employability. By identifying the most in-demand skills, individuals can strategically invest their time and resources in acquiring or refining competencies that are highly sought after by employers. This analysis empowers individuals to make informed decisions about skill development, ensuring they remain competitive in the ever-changing job market.</p>
            </div>
            <div class="graph-container">
                <img src="./images/plot2.png" alt="Skill Analysis" style="width: 100%;">
            </div>
        </div>

        <div class="section">
            <div class="graph-container">
                <img src="./images/plot3.png" alt="Needs Analysis" style="width: 100%;">
            </div>
            <div class="text-container">
                <h2>Needs Analysis</h2>
                <p>Understanding the needs and requirements of both employers and employees is essential for fostering a thriving workforce ecosystem. Conducting a needs analysis enables organizations to pinpoint areas for improvement and identify opportunities for growth. By assessing the current state of affairs and anticipating future challenges, organizations can develop targeted strategies to address gaps and meet evolving demands. This analysis serves as a roadmap for organizations to allocate resources effectively, cultivate talent, and create a supportive environment conducive to individual and organizational success.</p>
            </div>
        </div>
        <div class="section">
            <div class="text-container">
                <h2>Fields To Focus</h2>
                <p>Our website hosts a myriad of posts covering a diverse array of fields depicted in our graphs. From intricate analyses of the IT sector to savory insights into the food industry and groundbreaking revelations in the telecommunications sphere, our platform serves as a comprehensive repository of knowledge. Whether delving into the complexities of technology, exploring the tantalizing world of cuisine, or uncovering the latest advancements in communication, our posts offer invaluable insights and enriching experiences for enthusiasts and professionals alike</p>
             </div>
             <div class="graph-container">
                <img src="./images/plot4.png" alt="Needs Analysis" style="width: 100%;">
            </div>
        </div>
        <div class="section">
        <div class="graph-container">
                <img src="./images/plot5.png" alt="Needs Analysis" style="width: 100%;">
            </div>
        <div class="graph-container">
                <img src="./images/plot6.png" alt="Needs Analysis" style="width: 100%;">
            </div>
        </div>
        
    </div>
</body>
</html>
