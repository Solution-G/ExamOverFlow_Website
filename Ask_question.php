<?php

include 'db_connection.php';



if(isset($_POST['submit'])){
   $id = unique_id();
   $subject =$_POST['subject'];
   $subject =filter_var($subject, FILTER_SANITIZE_STRING);
   $topic = $_POST['topic'];
   $topic = filter_var($topic, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
 
      $add_playlist = $conn->prepare("INSERT INTO `questions`(id, subject, topic, description) VALUES(?,?,?,?)");
      $add_playlist->execute([$id, $subject, $topic, $description]);
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

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="video-form">
        <h1 class="heading">upload content</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <p>subject <span>*</span></p>
            <input type="text" name="subject" maxlength="100" required placeholder="subject" class="box">
            <p>Topic <span>*</span></p>
            <input type="text" name="topic" maxlength="100" required placeholder="topic" class="box">
            <p>question <span>*</span></p>
            <textarea name="description" class="box" required placeholder="write your question" maxlength="1000"
                cols="30" rows="10"></textarea>
            <input type="submit" value="post Question " name="submit" class="btn">
        </form>

    </section>
















    <script src="../js/admin_script.js"></script>

</body>

</html>