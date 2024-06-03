<?php
include '../db_connection.php';
if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:Admin_login.php');
}
session_start();


// Handle feedback deletion
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_feedback = $conn->prepare("DELETE FROM feedback WHERE id = ?");
    $delete_feedback->execute([$delete_id]);
    header('location:admin_feedback.php');
    exit();
}

$select_feedback = $conn->prepare("SELECT * FROM feedback ORDER BY created_at DESC");
$select_feedback->execute();
$feedbacks = $select_feedback->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
    .feedback-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 20px;
    }

    .feedback-item {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        background: #f9f9f9;
    }

    .feedback-item p {
        margin: 5px 0;
    }

    .delete-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 5px 10px;
        background: #e74c3c;
        color: #fff;
        text-decoration: none;
        border-radius: 3px;
    }

    .delete-btn:hover {
        background: #c0392b;
    }
    </style>
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
            <a href="Admin_feedback.php"><i class="fa-solid fa-bars-staggered"></i><span>Feedback</span></a>
            <a href="admin_logout.php"><i class="fas fa-graduation-cap"></i><span>logout</span></a>

        </nav>

    </div>

    <section class="feedback">
        <h3 class="title">Feedbacks</h3>
        <div class="feedback-list">
            <?php if ($feedbacks): ?>
            <?php foreach ($feedbacks as $feedback): ?>
            <div class="feedback-item">
                <p><strong>Name:</strong> <?= htmlspecialchars($feedback['name']); ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($feedback['email']); ?></p>
                <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($feedback['message'])); ?></p>
                <p><strong>Date:</strong> <?= $feedback['created_at']; ?></p>
                <a href="admin_feedback.php?delete=<?= $feedback['id']; ?>"
                    onclick="return confirm('Are you sure you want to delete this feedback?');"
                    class="delete-btn">Delete</a>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No feedbacks found.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer class="footer">
        &copy; copyright @ 2024 by <span>Solution Team</span> | all rights reserved!
    </footer>

    <script src="../js/script.js"></script>
</body>

</html>