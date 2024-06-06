<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:main_page.php');
    exit();
}

if (!isset($_GET['exam_id'])) {
    header('location:user_exams.php');
    exit();
}

$exam_id = $_GET['exam_id'];

$select_exam = $conn->prepare("SELECT * FROM exams WHERE id = ?");
$select_exam->execute([$exam_id]);
$exam = $select_exam->fetch(PDO::FETCH_ASSOC);

$select_questions = $conn->prepare("SELECT * FROM exam_details WHERE exam_id = ?");
$select_questions->execute([$exam_id]);
$questions = $select_questions->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $exam['title'] ?> - Exam</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <section class="flex">
            <a href="home.php" class="logo">Exam Overflow</a>
        </section>
    </header>

    <section class="form-container">
        <h3><?= $exam['title'] ?> (Grade: <?= $exam['grade'] ?>)</h3>
        <?php foreach ($questions as $question) { ?>
        <div class="box">
            <p>Q: <?= $question['question'] ?></p>
            <p>A: <?= $question['answer'] ?></p>
        </div>
        <?php } ?>
    </section>
</body>

</html>