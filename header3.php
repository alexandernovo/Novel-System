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
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6),
                    rgba(0, 0, 0, 0.6)), url('images/bg-index.jpg');
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            overflow-y: auto !important;
            overflow-x: hidden;
        }

        .table-custom th,
        .table-custom td {
            background-color: transparent;
            color: white
        }

        .form-select {
            background-color: transparent;
            color: white
        }

        .form-select option {
            background-color: transparent !important;
            color: white;
        }

        .dataTables_filter input {
            background-color: transparent;
            color: white
        }

        .dataTables_filter input:focus {
            background-color: transparent;
            color: white
        }
    </style>
    <title>NovArch (Alpha)</title>
</head>

<body>
    <header class="position-sticky top-0 nav-custom" style="z-index:3">
        <div class="navbar nav-custom"><a href="index.php" class='hover_nav mx-3 py-1'>NovArch</a>

            <nav><?php
                    if (isset($_SESSION) && isset($_SESSION['users_role'])) {
                        if ($_SESSION["users_role"] == 'AUTHOR') {
                            echo "<a href='index.php' class='mx-3 py-1  hover_nav'><i class='fa fa-home'></i> Home</a>";
                            echo "<a href='history_page.php' class='mx-3 py-1  hover_nav'><i class='fa fa-history'></i> History</a>";
                            echo "<a href='library.php' class='mx-3 py-1  hover_nav'><i class='fa fa-book'></i> Library</a>";
                            echo "<a href='donated.php' class='mx-3 py-1  hover_nav'><i class='fa fa-donate'></i> Donation</a>";
                            echo "<a href='profile.php' class='mx-3 py-1  hover_nav'><i class='fa fa-user-circle'></i> Profile</a>";
                            echo "<a href='logout.php' class='ms-3 py-1  hover_nav'><i class='fa fa-sign-out'></i> Logout</a>";
                        }
                        if ($_SESSION["users_role"] == 'READER') {
                            echo "<a href='index.php'><i class='fa fa-home'></i> Home</a>";
                            echo "<a href='history_page.php'><i class='fa fa-history'></i> History</a>";
                            echo "<a href='donated_reader.php'><i class='fa fa-donate'></i> Donation</a>";
                            echo "<a href='logout.php'><i class='fa fa-sign-out'></i> Logout</a>";
                        }
                    } else {
                        echo "<a href='signup.php' class='mx-3 py-1  hover_nav'><i class='fa fa-user-plus'></i> Signup</a>";
                        echo "<a href='login.php' class='ms-3 py-1  hover_nav'><i class='fa fa-sign-in'></i> Login</a>";
                    }
                    ?></nav>
        </div>

    </header>