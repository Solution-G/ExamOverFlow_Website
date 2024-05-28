<?php
include '../db_connection.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
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

        <div class="close-side-bar">
            <i class="fas fa-times"></i>
        </div>

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
            <a href="playlists.php"><i class="fa-solid fa-bars-staggered"></i><span>playlists</span></a>
            <a href="contents.php"><i class="fas fa-graduation-cap"></i><span>contents</span></a>
            <a href="comments.php"><i class="fas fa-comment"></i><span>comments</span></a>
            <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"><i
                    class="fas fa-right-from-bracket"></i><span>logout</span></a>
        </nav>

    </div>

    <!-- side bar section ends -->








    <section class="home-grid">

        <h1 class="heading">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <h3>welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="profile.php" class="btn">view profile</a>
            </div>

            <div class="box">
                <h3><?= $total_contents; ?></h3>
                <p>total contents</p>
                <a href="add_content.php" class="btn">add new content</a>
            </div>

            <div class="box">
                <h3><?= $total_playlists; ?></h3>
                <p>total playlists</p>
                <a href="add_playlist.php" class="btn">add new playlist</a>
            </div>

            <div class="box">
                <h3><?= $total_likes; ?></h3>
                <p>total likes</p>
                <a href="contents.php" class="btn">view contents</a>
            </div>

            <div class="box">
                <h3><?= $total_comments; ?></h3>
                <p>total comments</p>
                <a href="comments.php" class="btn">view comments</a>
            </div>

            <div class="box">
                <h3>quick select</h3>
                <p>login or register</p>
                <div class="flex-btn">
                    <a href="login.php" class="option-btn">login</a>
                    <a href="register.php" class="option-btn">register</a>
                </div>
            </div>

        </div>

    </section>















    <footer class="footer">
        &copy; copyright @ 2024 by <span>Solution Team</span> | All rights reserved!
    </footer>

    <script src="../js/script.js"></script>

</body>

</html>