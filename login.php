<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./css/style2.css">
    <title>Login to NovArch</title>
</head>

<body>
    <div class="home">
        <a href="index.php">NovArch</a>
    </div>
    <form action="includes/login.inc.php" method="post">
        <div class="col-4 mx-auto p-4 rounded mt-5 pb-5 bg-custom" style="border:1px solid teal">
            <div class="col-5 mx-auto">
                <img class="novel_picture" src="images/login_image.png">
            </div>
            <h3 class="text-white mb-3 text-center"><i class="fa fa-sign-in"></i> LOGIN</h3>
            <div class="form-group">
                <label class="text-white label-now">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>

            <?php if (isset($_GET["empty"])) { ?>
                <p class="error"><?php echo $_GET['empty'] ?></p>
            <?php } ?>
            <div class="form-group mt-2">
                <label class="text-white label-now">Password</label>
                <input type="password" class="form-control" name="pwd" placeholder="Password">
            </div>
            <?php if (!isset($_GET['error']) && isset($_GET["empty"])) { ?>
                <p class="error"><?php echo $_GET['empty'] ?></p>
            <?php } ?>
            <?php if (isset($_GET["error"])) { ?>
                <p class="error"><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <div class="row mx-auto">
                <button type="submit" class="mt-3 btn btn-primary btn-sm button-teal" name="submit">Login</button>
                <p class="label-now text-center text-white m-0 mt-2">No Account? <a href="signup.php" class="text-primary">Signup here</a></p>
            </div>
        </div>
    </form>


</body>

</html>