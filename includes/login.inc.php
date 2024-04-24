<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');

    include "../classes/database.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($username, $pwd);
    $login->loginUser();
}
