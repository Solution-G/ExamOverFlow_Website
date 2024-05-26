<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:main_page.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>materials</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <header class="header">

        <section class="flex">

            <a href="home.html" class="logo1">

                <img class="logo-img" src="./images/icons/logo.jpg" alt="Exam Overflow">
                <span class="logo">Exam Overflow</span>
            </a>


            <form action="search.php" method="post" class="search-form">
                <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
                <button type="submit" class="fas fa-search"></button>
            </form>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>

        </section>

    </header>

    <div class="side-bar">

        <div id="close-btn">
            <i class="fas fa-times"></i>
        </div>

        <div class="profile">
            <img src="images/pic-1.jpg" class="image" alt="">
            <h3 class="name">Akrem</h3>
            <p class="role">student</p>
            <a href="profile.php" class="btn">view profile</a>

        </div>

        <nav class="navbar">

            <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
            <a href="contact.php"><i class="fas fa-headset"></i><span>contact</span></a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> </i><span>Log out</span></a>
        </nav>

    </div>
    <section class="material">
        <div class="box-container">
            <div class="box">
                <h3 class="title">Mathematics</h3>
                <p class="tutor">Grade 12</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>

            </div>

        </div>
        <div class="box-container">
            <div class="box">
                <h3 class="title">Biology</h3>
                <p class="tutor">Grade 11</p>
                <p class="tutor1">barr</p>

            </div>

        </div>
    </section>
    <footer class="footer">

        &copy; copyright @ 2024 by <span>Solution Team</span> | all rights reserved!

    </footer>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>