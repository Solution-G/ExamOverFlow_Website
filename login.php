<?php
session_start();




include 'db_connection.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id']; // Start session and set session variable
      setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
      header('location:home.php');
   }else{
      $message[] = 'Incorrect email or password!';
   }
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="padding-left: 0;">

    <header class="header">
        <section class="flex">
            <a href="home.php" class="logo">Exam Overflow</a>

            <div class="icons">
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>
        </section>
    </header>

    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Login Now</h3>
            <img class="logo-img" src="./images/icons/logo.jpg" alt="Exam Overflow">
            <?php
            if (isset($message)) {
                foreach ($message as $msg) {
                    echo '<p class="error-message">' . $msg . '</p>';
                }
            }
            ?>
            <p>Your email <span>*</span></p>
            <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
            <p>Your password <span>*</span></p>
            <input type="password" name="pass" placeholder="Enter your password" required maxlength="20" class="box">
            <input type="submit" value="Login Now" name="submit" class="btn">
            <p><a href="forgot_account.php" class="forget-account" style="color:#888;">Forgot Account?</a></p>
            <p>Don't have an account? <a href="register.php"
                    style="display: inline-block; white-space: nowrap; padding: 15px 85px; margin-left:30px; margin-top:20px; font-size: 16px; text-decoration: none; color: #fff; background-color: #007bff; border: none; border-radius: 5px; cursor: pointer;">Register</a>
            </p>
        </form>
    </section>

    <footer class="footer">
        &copy; Copyright @ 2024 by <span>Solution Team</span> | All rights reserved!
    </footer>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>