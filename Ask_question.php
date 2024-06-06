<?php
include 'db_connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:main_page.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])){
   $id = unique_id();
   $subject = $_POST['subject'];
   $subject = filter_var($subject, FILTER_SANITIZE_STRING);
   $topic = $_POST['topic'];
   $topic = filter_var($topic, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);

   $add_question = $conn->prepare("INSERT INTO questions (id, subject, topic, description, created_at) VALUES (?, ?, ?, ?, NOW())");
   $add_question->execute([$id , $subject, $topic, $description]);
   $message[] = 'New question posted!';
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
</head>

<body>


    <section class="question-form">
        <h1 class="heading">Post a Question</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <p>Subject <span>*</span></p>
            <input type="text" name="subject" maxlength="100" required placeholder="Subject" class="box">
            <p>Topic <span>*</span></p>
            <input type="text" name="topic" maxlength="100" required placeholder="Topic" class="box">
            <p>Question <span>*</span></p>
            <textarea name="description" class="box" required placeholder="Write your question" maxlength="1000"
                cols="30" rows="10"></textarea>
            <input type="submit" value="Post Question" name="submit" class="btn">
        </form>
    </section>


</body>

</html>