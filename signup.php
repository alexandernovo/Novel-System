<?php require_once('functions/functions.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <title>Signup to NovArch</title>
</head>

<body>
    <div class="home position-sticky top-0">
        <a href="index.php">NovArch</a>
    </div>
    <form action="includes/signup.inc.php" method="post">
        <div class="col-4 mx-auto p-4 rounded mt-2 pb-5 bg-custom mb-3" style="border:1px solid teal">
            <div class="col-5 mx-auto">
                <img class="novel_picture" src="images/login_image.png">
            </div>
            <h3 class="text-white mb-3 text-center"><i class="fa fa-user-circle"></i> SIGNUP</h3>

            <?php if (showError('empty')) :
                echo showError('empty');
            endif; ?>
            <div class="form-group mb-2">
                <label class="text-white label-now">Firstname</label>
                <input type="text" name="firstname" placeholder="Firstname" class="form-control" value="<?php echo getValue('firstname'); ?>">
                <?php if (showError('firstname')) :
                    echo showError('firstname');
                endif; ?>
            </div>
            <div class="form-group mb-2">
                <label class="text-white label-now">Lastname</label>
                <input type="text" name="lastname" placeholder="Lastname" class="form-control" value="<?php echo getValue('lastname'); ?>">
                <?php if (showError('lastname')) :
                    echo showError('lastname');
                endif; ?>
            </div>
            <div class="form-group mb-2">
                <label class="text-white label-now">Username</label>
                <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo getValue('username'); ?>">
                <?php if (showError('username')) :
                    echo showError('username');
                endif; ?>
            </div>
            <div class="form-group mb-2">
                <label class="text-white label-now">Email</label>
                <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo getValue('email'); ?>">
                <?php if (showError('email')) :
                    echo showError('email');
                endif; ?>
            </div>

            <div class="form-group mb-2">
                <label class="text-white label-now">Password</label>
                <input type="password" name="pwd" class="form-control" placeholder="Password">
            </div>
            <div class="form-group mb-3">
                <label class="text-white label-now">Confirm Password</label>
                <input type="password" name="pwdrepeat" class="form-control" placeholder="Confirm Password">
                <?php if (showError('password')) :
                    echo showError('passwrod');
                endif; ?>
            </div>
            <div class="row mx-auto">
                <button type="submit" class="btn btn-primary btn-sm button-teal" name="submit">Sign up</button>
                <p class="label-now text-center text-white m-0 mt-2">Already have account? <a href="login.php" class="text-primary">Login here</a></p>
            </div>
        </div>
    </form>


</body>

</html>