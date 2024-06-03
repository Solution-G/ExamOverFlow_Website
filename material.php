<?php
include 'db_connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:main_page.php');
    exit();
}

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message"><span>' . $message . '</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
    }
}

$selected_grade = isset($_POST['grade']) ? $_POST['grade'] : '';
$selected_subject = isset($_POST['subject']) ? $_POST['subject'] : '';


// to filter the file from material


$query = "SELECT * FROM `materials` WHERE 1";
$params = [];

if ($selected_grade != '') {
    $query .= " AND grade = ?";
    $params[] = $selected_grade;
}

if ($selected_subject != '') {
    $query .= " AND name = ?";
    $params[] = $selected_subject;
}

$select_courses = $conn->prepare($query);
$select_courses->execute($params);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .filter-form {
        display: flex;
        justify-content: right;
        margin-bottom: 20px;
        gap: 10px;
    }

    .filter-form select,
    .filter-form button {
        padding: 5px;
        font-size: 14px;
    }

    .filter-form button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .filter-form button:hover {
        background-color: #0056b3;
    }
    </style>
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
        <div id="close-btn"><i class="fas fa-times"></i></div>
        <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                echo '<img src="uploaded_files/' . $fetch_profile['image'] . '" class="image" alt="">';
                echo '<h3 class="name">' . $fetch_profile['name'] . '</h3>';
                echo '<p class="role">student</p>';
                echo '<a href="profile.php" class="btn">view profile</a>';
            }
            ?>
        </div>
        <nav class="navbar">
            <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
            <a href="feedback.php"><i class="fa-regular fa-comment"></i><span>feedback</span></a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
        </nav>
    </div>

    <section class="material">
        <form action="" method="post" class="filter-form">
            <select name="grade">
                <option value="">Select Grade</option>
                <option value="9" <?= $selected_grade == '9' ? 'selected' : '' ?>>Grade 9</option>
                <option value="10" <?= $selected_grade == '10' ? 'selected' : '' ?>>Grade 10</option>
                <option value="11" <?= $selected_grade == '11' ? 'selected' : '' ?>>Grade 11</option>
                <option value="12" <?= $selected_grade == '12' ? 'selected' : '' ?>>Grade 12</option>
            </select>
            <select name="subject">
                <option value="">Select Subject</option>
                <option value="Mathematics" <?= $selected_subject == 'Mathematics' ? 'selected' : '' ?>>Mathematics
                </option>
                <option value="Biology" <?= $selected_subject == 'Biology' ? 'selected' : '' ?>>Biology</option>
                <option value="Chemistry" <?= $selected_subject == 'Chemistry' ? 'selected' : '' ?>>Chemistry</option>
                <option value="Physics" <?= $selected_subject == 'Physics' ? 'selected' : '' ?>>Physics</option>
                <!-- Add more subjects as needed -->
            </select>
            <button type="submit">Filter</button>
        </form>

        <div class="box-container">
            <?php
            if ($select_courses->rowCount() > 0) {
                while ($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="box">';
                    echo '<h3 class="title">' . $fetch_course['name'] . '</h3>';
                    echo '<p class="tutor">Grade ' . $fetch_course['grade'] . '</p>';
                    echo '<a href="uploaded_files/' . $fetch_course['file'] . '" class="btn" download>Download</a>';
                    echo '</div>';
                }
            } else {
                echo '<p class="empty">No courses added yet!</p>';
            }
            ?>
        </div>
    </section>

    <footer class="footer">
        &copy; copyright @ 2024 by <span>Solution Team</span> | all rights reserved!
    </footer>

    <script src="js/script.js"></script>
</body>

</html>