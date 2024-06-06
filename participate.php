<?php
include 'db_connection.php';

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
    <title>Watch Video</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="description">
        <section class="description-details">
            <div class="tutor">
                <?php foreach ($questions as $question) : ?>
                <div class="question-row">
                    <p><strong>Subject:</strong> <?= $question['subject']; ?></p>
                    <p><strong>Topic:</strong> <?= $question['topic']; ?></p>
                    <p><strong>Description:</strong> <?= $question['description']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <section class="comments">
        <h1 class="heading">Add a Comment</h1>
        <form action="" method="post" class="add-comment">
            <input type="hidden" name="content_id" value="<?= $get_id; ?>">
            <textarea name="comment_box" required placeholder="Write your comment..." maxlength="1000" cols="30"
                rows="10"></textarea>
            <input type="submit" value="Add Comment" name="add_comment" class="inline-btn">
        </form>

        <h1 class="heading">User Comments</h1>

        <div class="show-comments">
            <div class="box">


                <h3>Winner Winner</h3>
                <span>Best Comment</span>


            </div>
        </div>

        <div class="show-comments">
            <div class="box">


                <h3>Winner Winner</h3>
                <span>Best Comment</span>


            </div>
        </div>

        <div class="show-comments">
            <div class="box">


                <h3>Winner Winner</h3>
                <span>Best Comment</span>


            </div>
        </div>

        <div class="show-comments">
            <div class="box">


                <h3>Winner Winner</h3>
                <span>Best Comment</span>


            </div>
        </div>

        <div class="show-comments">
            <div class="box">


                <h3>Winner Winner</h3>
                <span>Best Comment</span>


            </div>
        </div>

    </section>

    <!-- Custom JS File Link -->
    <script src="js/script.js"></script>
</body>

</html>