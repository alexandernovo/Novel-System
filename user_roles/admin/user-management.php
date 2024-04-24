<?php
    session_start();
    require('../database.php');
    if($_SESSION['users_role'] == 'ADMIN'){
        $sess_id = $_SESSION['userid'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Verification</title>
</head>
<body>
    <div class="container">
    <div >
        <a href="admin-dashboard.php" class="btn btn-primary">User Management</a>
        <a href="user-management.php" class="btn btn-info">Verification</a>
        <a href="novel-management.php" class="btn btn-secondary">Novel Management</a>
        
    </div>
        <table class="table">
            <thead>
                <tr>
                    <td>Username</td>
                    <td>Role</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conn->query("SELECT * FROM users WHERE users_role = 'author' AND users_status = 'PENDING'");
                while ($row = $sql->fetch_assoc()){

                
                ?>
                <tr>
                    <td><?php echo $row['users_username']?></td>
                    <td><?php echo $row['users_role']?></td>
                    <td><?php echo $row['users_status']?></td>
                    <td><a class="btn btn-success" href="users-action.php?approve=<?php echo $row['users_id']?>">Approve</a>
                        <a class="btn btn-danger" href="users-action.php?deny=<?php echo $row['users_id']?>">Deny</a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
<?php
}
else{
    header("Location: ../login.php");
}
?>