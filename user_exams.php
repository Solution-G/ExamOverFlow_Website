<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:main_page.php');
    exit();
}

$select_exams = $conn->prepare("SELECT * FROM exams");
$select_exams->execute();
$exams = $select_exams->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams</title>
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
        <h3>Available Exams</h3>
        <?php foreach ($exams as $exam) { ?>
        <div class="box">
            <h3><?= $exam['title'] ?> (Grade: <?= $exam['grade'] ?>)</h3>
            <a href="view_exams.php?exam_id=<?= $exam['id'] ?>" class="btn">View Exam</a>
        </div>
        <?php } ?>
    </section>
</body>

</html>