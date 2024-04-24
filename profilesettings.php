<?php
include_once 'header.php';
$query = first('profiles', ['users_id' => $_SESSION['userid']]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Novel Details</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

            .novel-details {
                background: #f5f5f5;
                padding: 50px;
            }

            body {
                font-family: "Poppins";
            }
        </style>
    </head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between my-4">
            <h1><i class="fa fa-cog"></i> Profile Settings</h1>
            <div>
                <a href="profile.php" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="includes/create_profile.php" method="post" enctype="multipart/form-data">
            <div class="d-flex align-items-start">
                <div style="width:300px">
                    <div class="border mb-2" style="height:300px; width:300px" id="image-container">
                        <img id="preview-image" src="<?php echo !empty($query['profile_picture']) ? $query['profile_picture'] : 'images/placeholder.jpg' ?>" alt="Preview Image">
                    </div>
                    <div style=" width:300px" class="mb-2">
                        <div class="form-group">
                            <input type="file" id="image-upload" required name="profile" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="ms-2">
                    <div class="form-group mb-2">
                        <label>Firstname</label>
                        <input class="form-control" name="firstname" value="<?= $query['firstname'] ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Lastname</label>
                        <input class="form-control" name="lastname" value="<?= $query['lastname'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Birthday</label>
                        <input type="date" name="birthday" value="<?= !empty($query['birthday']) ? $query['birthday'] : '' ?>" class="form-control">
                    </div>
                </div>
            </div>
            <input type="hidden" name="users_id" value="<?php echo $_SESSION['userid'] ?>">
            <p>Put Your Intro Here</p>
            <textarea name="introtitle" rows="3" cols="150" class="form-control" placeholder="Intro"><?php echo !empty($query['profiles_introtitle']) && $query['profiles_introtitle'] ? $query['profiles_introtitle'] : ''   ?></textarea>
            <br></br>
            <p>Tell them about yourself</p>
            <textarea name="about" rows="8" cols="150" class="form-control" placeholder="About"><?php echo !empty($query['profiles_about']) && $query['profiles_about'] ? $query['profiles_about'] : '' ?></textarea>
            <br></br>
            <p>Edit your posts here</p>
            <textarea name="introtext" rows="8" class="form-control" cols="150" placeholder="Posts"><?php echo !empty($query['profiles_introtext']) && $query['profiles_introtext'] ? $query['profiles_introtext'] : '' ?></textarea>
            <br></br>
            <div class="form-element">
                <button type="submit" name="create_profile" class="btn btn-success">Save Changes</button>
            </div>
            <br></br>
        </form>
    </div>
    <?php require_once('footer.php') ?>