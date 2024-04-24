<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
    $pwdRepeat = htmlspecialchars($_POST["pwdrepeat"], ENT_QUOTES, 'UTF-8');

    include "../classes/database.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($firstname, $lastname, $username, $email, $pwd, $pwdRepeat);

    $signup->signupUser();

    // $userId = $signup->fetchUserId($username);

    // include "../classes/profileinfo.classes.php";
    // include "../classes/profileinfo-contr.classes.php";
    // $profileInfo = new ProfileInfoContr($userId, $username);
    // $profileInfo->defaultProfileInfo();

    // header("location: ../index.php?error=none");

}
