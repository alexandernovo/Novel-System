<?php
require_once("functions/config.php");
require_once("includes/database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/newcss.css">

    <title>NovArch (Alpha)</title>
</head>

<body>
    <header class="position-sticky top-0" style="z-index:2">
        <div class="navbar">
            <a href="index.php">NovArch</a>
            <nav>
                <?php
                if (isset($_SESSION) && isset($_SESSION['users_role'])) {
                    if ($_SESSION["users_role"] == 'AUTHOR') {
                        echo "<a href='index.php'><i class='fa fa-home'></i> Home</a>";
                        echo "<a href='history_page.php'><i class='fa fa-history'></i> History</a>";
                        echo "<a href='library.php'><i class='fa fa-book'></i> Library</a>";
                        echo "<a href='donated.php'><i class='fa fa-donate'></i> Donation</a>";
                        echo "<a href='profile.php'><i class='fa fa-user-circle'></i> Profile</a>";
                        echo "<a href='logout.php'><i class='fa fa-sign-out'></i> Logout</a>";
                    }
                    if ($_SESSION["users_role"] == 'READER') {
                        echo "<a href='index.php'><i class='fa fa-home'></i> Home</a>";
                        echo "<a href='history_page.php'><i class='fa fa-history'></i> History</a>";
                        echo "<a href='donated_reader.php'><i class='fa fa-donate'></i> Donation</a>";
                        echo "<a href='logout.php'><i class='fa fa-sign-out'></i> Logout</a>";
                    }
                } else {
                    echo "<a href='signup.php'>Signup</a>";
                    echo "<a href='login.php'>Login</a>";
                }
                ?>
            </nav>
        </div>

    </header>