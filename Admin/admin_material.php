<?php
include '../db_connection.php';
session_start();
if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:Admin_login.php');
}
// Code to handle deletion of material
if(isset($_POST['delete'])){
    if(isset($_POST['material_id'])) {
        $material_id = $_POST['material_id'];
        $delete_material = $conn->prepare("DELETE FROM materials WHERE id = ?");
        $delete_material->execute([$material_id]);
    } else {
        // Handle the case when material_id is not set
        $message[] = 'Material ID is not set!';
    }
}

// Fetch existing materials
$select_materials = $conn->prepare("SELECT * FROM materials");
$select_materials->execute();
$materials = $select_materials->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message form"><span>' . $message . '</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
        }
    }
    ?>
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
    <section class="material">

        <!-- Display existing materials with delete button -->
        <div class="box-container">
            <a href="Admin_add_material.php" class="btn"
                style="  width:30%;  padding: 0 40px;  justify-content :center; margin-bottom: 20px; ">
                Add material </a>
            <h3 class="title">Existing Materials</h3>
            <?php foreach ($materials as $material) { ?>
            <div class="box">
                <h3 class="title">Course Name: <?= $material['name'] ?></h3>
                <p class="tutor">Grade: <?= $material['grade'] ?></p>
                <form action="" method="post">
                    <input type="hidden" name="material_id" value="<?= $material['id'] ?>">
                    <button type="submit" name="delete" class="btn">Delete</button>
                </form>
            </div>
            <?php } ?>
        </div>
    </section>
    <script src="../js/script.js"></script>
</body>

</html>