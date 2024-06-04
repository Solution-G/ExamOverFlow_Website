<?php
include '../db_connection.php';
session_start();
if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:Admin_login.php');
}



if (isset($_POST['submit'])) {
    $course_name = filter_var($_POST['course_name'], FILTER_SANITIZE_STRING);
    $grade = filter_var($_POST['grade'], FILTER_SANITIZE_STRING);
    $file = $_FILES['file'];

    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];

    if ($file_error === 0) {
        $file_destination = '../uploaded_files/' . $file_name;
        move_uploaded_file($file_tmp_name, $file_destination);

        $insert_course = $conn->prepare("INSERT INTO materials (name, grade, file) VALUES (?, ?, ?)");
        $insert_course->execute([$course_name, $grade, $file_name]);

        $message[] = 'Course added successfully!';
    } else {
        $message[] = 'Failed to upload file!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body style="padding-left: 0;">
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message form"><span>' . $message . '</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
        }
    }
    ?>
    <header class="header">
        <section class="flex">
            <a href="dashboard.php" class="logo">Exam Overflow</a>
            <div class="icons">
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>
        </section>
    </header>
    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="add-course">
            <h3>Add New Course</h3>
            <p>Course Name <span>*</span></p>
            <input type="text" name="course_name" placeholder="Enter course name" maxlength="100" required class="box">
            <p>Grade <span>*</span></p>
            <input type="text" name="grade" placeholder="Enter grade" maxlength="10" required class="box">
            <p>Upload File <span>*</span></p>
            <input type="file" name="file" required class="box">
            <input type="submit" name="submit" value="Add Course" class="btn">
        </form>
    </section>
    <script src="../js/script.js"></script>
</body>

</html>