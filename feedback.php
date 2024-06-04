<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:main_page.php');
    exit();
}

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

// Handle feedback form submission
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    // Insert feedback into the database
    $insert_feedback = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $insert_feedback->execute([$name, $email, $msg]);

    $message[] = "Feedback submitted successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <header class="header">
        <section class="flex">
            <a href="home.php" class="logo1">
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
            <?php
            $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>" class="image" alt="">
            <h3 class="name"><?= $fetch_profile['name']; ?></h3>
            <p class="role">student</p>
            <a href="profile.php" class="btn">view profile</a>
            <?php
            }
            ?>
        </div>

        <nav class="navbar">
            <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
            <a href="feedback.php"><i class="fa-regular fa-comment"></i><span>feedback</span></a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Log out</span></a>
        </nav>
    </div>

    <section class="contact">
        <h3 class="title">You can directly submit your feedback by filling the entries below</h3>

        <div class="row">
            <div class="image">
                <img src="images/contact-img.svg" alt="">
            </div>

            <form action="" method="post">
                <h3>FEEDBACK/REPORT A PROBLEM</h3>
                <input type="text" placeholder="enter your name" name="name" required maxlength="50" class="box">
                <input type="email" placeholder="enter your email" name="email" required maxlength="50" class="box">
                <textarea name="msg" class="box" placeholder="enter your message" required maxlength="1000" cols="30"
                    rows="10"></textarea>
                <input type="submit" value="send message" class="inline-btn" name="submit"
                    onclick="return displayConfirmation();">
            </form>

        </div>
    </section>

    <footer class="footer">
        &copy; copyright @ 2024 by <span>Solution Team</span> | all rights reserved!
    </footer>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>