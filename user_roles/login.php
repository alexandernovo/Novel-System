<?php
    require("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="height:100vh;width:100%">
        <div class="card p-5" style="height:400px;width:600px">
            <form action="login-check.php" method="POST">
                <label class="form-label" for="username">Username</label>
                <input type="text" class="form-control mb-3" name="username">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control mb-3" style="width:100%" name="password">
                <button class="btn btn-primary" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>