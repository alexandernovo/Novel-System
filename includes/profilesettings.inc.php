<?php


session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION["userid"];
    $username = $_SESSION["userusername"];
    $about = htmlspecialchars($_POST["about"], ENT_QUOTES, "UTF-8");
    $introTitle = htmlspecialchars($_POST["introtitle"], ENT_QUOTES, "UTF-8");
    $introText = htmlspecialchars($_POST["introtext"], ENT_QUOTES, "UTF-8");

    include "../classes/database.classes.php";
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";
    $profileInfo = new ProfileInfoContr($id, $username);

    $profileInfo->updateProfileInfo($about, $introTitle, $introText);
    
    header("location: ../profile.php?error=none");
}