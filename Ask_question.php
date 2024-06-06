<?php
include 'db_connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:main_page.php');
    exit();
}

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

if(isset($_POST['submit'])){
   $subject =$_POST['subject'];
   $subject =filter_var($subject, FILTER_SANITIZE_STRING);
   $topic = $_POST['topic'];
   $topic = filter_var($topic, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
    
      $add_playlist = $conn->prepare("INSERT INTO `questions`(subject, topic, description, user_id) VALUES(?,?,?,?)");
      $add_playlist->execute([$subject, $topic, $description, $user_id]);
      $message[] = 'new course uploaded!';
   }

   



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!--This is the script-->

</head>

<body>
    <section class="video-form">
        <h1 class="heading">Post a question here!</h1>

        <form action="view_question.php" method="post" enctype="multipart/form-data" onsubmit="return validateQuestion()">
            <p>If you have any question that you are strugling with, let other students help you!</p>
            
            <br>
            
            <p>subject <span>*</span></p>
            <input type="text" name="subject" maxlength="100" required placeholder="subject" class="box" id="subject">
            <p>Topic <span>*</span></p>
            <input type="text" name="topic" maxlength="100" required placeholder="topic" class="box" id="topic">
            <p>question <span>*</span></p>
            <textarea name="description" class="box" required placeholder="write your question" maxlength="1000"
                cols="30" rows="10" id="question "></textarea>
            <input type="submit" value="post Question " name="submit" class="btn">
        </form>
    </section>
















    <script src="../js/admin_script.js"></script>
    <script src="js/script.js"></script>

</body>

</html>