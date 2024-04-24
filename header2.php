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
    </style>
    <title>NovArch (Alpha)</title>
</head>

<body>
    <header class="position-sticky top-0 nav-custom" style="z-index:3">
        <form method="post" id="advance_search_form">
            <div class="navbar nav-custom"><a href="index.php" class='hover_nav mx-3 py-1'>NovArch</a>
                <div class="col-6 d-flex position-relative align-items-center">
                    <i class="fa fa-search text-white position-absolute ms-3"></i>
                    <input class="form-control search-form" placeholder="Search Novel or Genre..." name="search_form" id="search_now">
                    <i class="fa fa-caret-down advance_class text-teal position-absolute cursor-pointer" style="right:0; margin-right:20px; font-size:20px" id="advance_search"></i>
                </div>
                <nav><?php
                        if (isset($_SESSION) && isset($_SESSION['users_role'])) {
                            if ($_SESSION["users_role"] == 'READER' || $_SESSION["users_role"] == 'READER') {
                                echo "<a href='index.php' class='mx-2 py-1  hover_nav'><i class='fa fa-home'></i> Home</a>";
                                echo "<a href='history_page.php' class='mx-2 py-1  hover_nav'><i class='fa fa-history'></i> History</a>";
                                echo "<a href='donated_reader.php' class='mx-2 py-1  hover_nav'><i class='fa fa-donate'></i> Donation</a>";
                                echo "<a href='logout.php' class='ms-3 py-1  hover_nav'><i class='fa fa-sign-out'></i> Logout</a>";
                            }
                            if ($_SESSION["users_role"] == 'AUTHOR' || $_SESSION["users_role"] == 'AUTHOR') {
                                echo "<a href='index.php' class='mx-2 py-1  hover_nav'><i class='fa fa-home'></i> Home</a>";
                                echo "<a href='history_page.php' class='mx-2 py-1  hover_nav'><i class='fa fa-history'></i> History</a>";
                                echo "<a href='library.php' class='mx-2 py-1  hover_nav'><i class='fa fa-book'></i> Library</a>";
                                echo "<a href='donated.php' class='mx-2 py-1  hover_nav'><i class='fa fa-donate'></i> Donation</a>";
                                echo "<a href='profile.php' class='mx-2 py-1  hover_nav'><i class='fa fa-user-circle'></i> Profile</a>";
                                echo "<a href='logout.php' class='ms-3 py-1  hover_nav'><i class='fa fa-sign-out'></i> Logout</a>";
                            }
                        } else {
                            echo "<a href='signup.php' class='mx-3 py-1  hover_nav'><i class='fa fa-user-plus'></i> Signup</a>";
                            echo "<a href='login.php' class='ms-3 py-1  hover_nav'><i class='fa fa-sign-in'></i> Login</a>";
                        }
                        ?></nav>
            </div>
            <div class="position-absolute text-white advance-search p-5 d-none" id="advance_div">
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-advance"><i class="fa fa-search"></i> Advance Search</h4>

                        <div class="form-group mt-3 mb-2">
                            <label>Authors Name</label>
                            <input class="form-control search-forms" placeholder="Author..." name="author" id="author">
                        </div>
                        <h4 class="header-advance mt-5">Order By</h4>
                        <div class=" mt-4" style="height: 200px; overflow-y:auto; overflow-x:hidden;">
                            <div class="row mx-auto">
                                <div class="col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input radio-sm" checked type="radio" value="alphabetical" id="flexCheckDefault" name="order_by_fig">
                                        <label class="form-check-label check-label ms-1" for="flexCheckDefault">
                                            Alphabetical
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input radio-sm" checked type="radio" value="ASC" id="flexCheckDefault" name="order_by">
                                        <label class="form-check-label check-label ms-1" for="flexCheckDefault">
                                            Ascending
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input radio-sm" type="radio" value="release" id="flexCheckDefault" name="order_by_fig">
                                        <label class="form-check-label check-label ms-1" for="flexCheckDefault">
                                            Release Date
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input radio-sm" type="radio" value="DESC" id="flexCheckDefault" name="order_by">
                                        <label class="form-check-label check-label ms-1" for="flexCheckDefault">
                                            Descending
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="header-advance">Genre</h4>
                        <div class="mt-4" style="height: 300px; overflow-y:auto; overflow-x:hidden;">
                            <div class="row mx-auto">
                                <?php
                                $stmt = "SELECT *FROM genre GROUP BY genre_name";
                                $query = mysqli_query($conn, $stmt);
                                // $genres = findAll('genre');
                                ?>
                                <?php while ($genre = mysqli_fetch_assoc($query)) : ?>
                                    <div class="col-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input check-sm" type="checkbox" value="<?= $genre['genre_id'] ?>" id="flexCheckDefault" name="genre[]">
                                            <label class="form-check-label check-label ms-1" for="flexCheckDefault">
                                                <?= $genre['genre_name'] ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </header>