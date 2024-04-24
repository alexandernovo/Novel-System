<?php
    include_once 'components/header.php';
    include "includes/database.php";
    include "classes/database.classes.php";
    include "classes/profileinfo.classes.php";
    include "classes/profileinfo-view.classes.php";
    $profileInfo = new ProfileInfoView();
    $id = $_GET['id'];

    if(isset($_SESSION['userid'])){

    $user_id = $_SESSION["userid"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
    crossorigin="anonymous">
    <title>Novel Details</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        .novel-details {
            background: #f5f5f5;
            padding: 50px;
        }
        body{
            font-family: "Poppins";
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between my-4">
            <h1>Profile</h1>
            <div>
                <a href="add_editor_action.php" class="btn btn-primary">Become an Editor</a>
                <a href="profilesettings.php" class="btn btn-secondary">Profile Settings</a>
                <button onclick="window.history.back()" class="btn btn-warning">Back</a>
            </div>
    </div>
        <div class="novel-details my-4">
            <?php
                

                $sql = "SELECT * FROM `users` 
                INNER JOIN profiles ON profiles.users_id = users.users_id
                WHERE users.users_id='$id'";
                $result = $conn->query($sql);
                if ($result) {
                            while ($row = $result->fetch_assoc()) 
                            {               
                                
                                

                                echo "<h2>Profile Name</h2>";
                                echo "<p>$row[users_username]</p>";
                                echo "<h2>Donation Link</h2>";
                                echo "<p>$row[profiles_introtext]</p>";
                                echo "<h2>About</h2>";
                                echo "<p>$row[profiles_introtitle]</p>";
                                echo "<h2>Novels Created</h2>";
                                echo "<p>$row[profiles_introtitle]</p>";

                        ?>

                        <?php
                            }
                        }
                        
                        $followers = "SELECT COUNT(followers_id) AS follows FROM followers WHERE author_id = '$id'";
                        
                        
                            $countFollowers = $conn->query($followers);
                            while($row2 = $countFollowers->fetch_assoc())
                            {
                            ?>
                                <p>Followers: <?php echo $row2['follows']?></p>
                            <?php
                            }
                        ?>
                        
            

        </div>
        <div class="container">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <td>Novel Title</td>
                        <td>Novel Subtitle</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $novelsql = $conn->query("SELECT * FROM novels WHERE users_id='$id'");
                    while($row3 = $novelsql->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $row3['title']?></td>
                            <td><?php echo $row3['subtitle']?></td>
                            <td><a href="view.php?id=<?php echo $row3['id']?>" class="btn btn-success">View</a></td>
                        </tr>
                        <?php
                    }
                ?>
                    

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>