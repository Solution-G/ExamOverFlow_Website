<?php
include '../db_connection.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:Admin_login.php');
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <header class="header">

        <section class="flex">

            <a href="dashboard.php" class="logo">Admin.</a>

            <form action="search_page.php" method="post" class="search-form">
                <input type="text" name="search" placeholder="search here..." required maxlength="100">
                <button type="submit" class="fas fa-search" name="search_btn"></button>
            </form>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>

        </section>

    </header>


    <!-- side bar section starts  -->

    <div class="side-bar">

        <div id="close-btn"><i class="fas fa-times"></i></div>

        <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="image" alt="">
            <h3 class="role">Admin</h3>
            <h3 class="role "><?= $fetch_profile['name']; ?></h3>

            <a href="profile.php" class="btn">view profile</a>
            <?php
            }
         ?>
        </div>

        <nav class="navbar">
            <a href="dashboard.php"><i class="fas fa-home"></i><span>home</span></a>
            <a href="Admin_feedback.php"><i class="fa-solid fa-bars-staggered"></i><span>Feedback</span></a>
            <a href="admin_logout.php"><i class="fas fa-graduation-cap"></i><span>logout</span></a>

        </nav>

    </div>

    <!-- side bar section ends -->


    <section class="home-grid">

        <h1 class="heading">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <h3>feedback</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="Admin_feedback.php" class="btn">view profile</a>
            </div>
        </div>
        <div class="box-container">

            <div class="box">
                <h3>Add materials here </h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="Admin_material.php" class="btn">view profile</a>
            </div>
        </div>
        <div class="box-container">

            <div class="box">
                <h3>welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="profile.php" class="btn">view profile</a>
            </div>
        </div>
        <div class="box-container">

            <div class="box">
                <h3>welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="profile.php" class="btn">view profile</a>
            </div>
        </div>
        <div class="box-container">

            <div class="box">
                <h3>welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="profile.php" class="btn">view profile</a>
            </div>
        </div>
        <div class="box-container">

            <div class="box">
                <h3>welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="profile.php" class="btn">view profile</a>
            </div>
        </div>



    </section>















    <footer class="footer">
        &copy; copyright @ 2024 by <span>Solution Team</span> | All rights reserved!
    </footer>

    <script src="../js/script.js"></script>

</body>

</html>