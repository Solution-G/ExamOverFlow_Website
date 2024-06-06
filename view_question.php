<?php
include 'db_connection.php';

// Fetch all questions from the database
$select_questions = $conn->prepare("SELECT * FROM `questions`");
$select_questions->execute();
$questions = $select_questions->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <section class="questions-container">
        <h1 class="heading">Questions</h1>
        <div class="row-container">
            <?php foreach ($questions as $question) : ?>
            <div class="question-row">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$question['user_id']]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>

           <h1 class="title"><?=$fetch_profile['name']?></h1> 
        <?php    
        }
            ?>
                <p><strong>Topic:</strong> <?= $question['topic']; ?></p>
                <p ><?= $question['subject']; ?></p>

                <a href="participate.php?" class="button">Answer</a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>

</html>