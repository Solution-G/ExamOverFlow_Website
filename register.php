<?php
include 'db_connection.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {

    $id = unique_id();  // Assume unique_id() is a function that generates a unique ID
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['c_pass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $gender = $_POST['gender'];
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);
    $grade = $_POST['grade'];
    $grade = filter_var($grade, FILTER_SANITIZE_STRING);
    $stream = $_POST['stream'];
    $stream = filter_var($stream, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/' . $rename;

    // Check if user already exists
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);

    if ($select_user->rowCount() > 0) {
        $message[] = 'Email already taken!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'Confirm password does not match!';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, gender, grade, stream, image) VALUES(?,?,?,?,?,?,?,?)");
            $insert_user->execute([$id, $name, $email, $pass, $gender, $grade, $stream, $rename]);
            move_uploaded_file($image_tmp_name, $image_folder);

            $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
            $verify_user->execute([$email, $pass]);
            $row = $verify_user->fetch(PDO::FETCH_ASSOC);

            if ($verify_user->rowCount() > 0) {
                setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
                header('location:home.php');
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">


    <script>
    function validateForm() {

        var email = document.forms["form"]["email"].value;
        var password = document.forms["form"]["pass"].value;
        var cpassword = document.forms["form"]["c_pass"].value;



        // Validate Email
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Not a valid email address.");
            return false;
        }

        // Validate Password
        if (password == null || password == "") {
            alert("Password must be filled out.");
            return false;
        }
        if (password.length < 5 || password.length > 25) {
            alert("Passwords must be 5 to 14 characters long.");
            return false;
        }

        // Validate Confirm Password
        if (cpassword != password) {
            alert("Passwords must match.");
            return false;
        }

        return true;
    }
    </script>

</head>

<body style="padding-left: 0;">

    <header class="header">
        <section class="flex">
            <a href="register.php" class="logo">Exam Overflow</a>
            <div class="icons">
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>
        </section>
    </header>

    <section class="form-container">
        <form action="register.php" method="post" enctype="multipart/form-data" name="form"
            onsubmit="return validateForm()">
            <h3>Register Now</h3>
            <img class="logo-img" src="./images/icons/logo.jpg" alt="Exam Overflow">
            <p>Your Name <span>*</span></p>
            <input type="text" name="name" placeholder="Enter your name" required maxlength="50" class="box">
            <p>Your Email <span>*</span></p>
            <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
            <p>Your Password <span>*</span></p>
            <input type="password" name="pass" placeholder="Enter your password" required maxlength="20" class="box">
            <p>Confirm Password <span>*</span></p>
            <input type="password" name="c_pass" placeholder="Confirm your password" required maxlength="20"
                class="box">
            <p>Gender <span>*</span></p>
            <select name="gender" required class="box">
                <option value disabled selected>Select your gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <p>Grade <span>*</span></p>
            <select name="grade" required class="box">
                <option value disabled selected>Select your grade</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
                <option value="11">Grade 11</option>
                <option value="12">Grade 12</option>
            </select>
            <p>Stream <span>*</span></p>
            <select name="stream" required class="box">
                <option value disabled selected>Select your stream</option>
                <option value="Natural">Natural</option>
                <option value="Social">Social</option>
            </select>
            <p>Select Profile <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
            <input type="submit" value="Register" name="submit" class="btn">
            <p>You have an Account ?<a href="login.php"
                    style="display: inline-block; white-space: nowrap; padding: 15px 85px; margin-left:85px;margin-top:20px; font-size: 16px; text-decoration: none; color: #fff; background-color: #007bff; border: none; border-radius: 5px; cursor: pointer;">Login</a>
            </p>
        </form>
    </section>

    <footer class="footer">
        &copy; copyright @ 2024 by <span>Solution Team</span> | All rights reserved!
    </footer>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>