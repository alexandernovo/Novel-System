<?php
require_once 'header.php';
$query = first('profiles', ['users_id' => $_SESSION['userid']]);
$novels = find_where('novels', ['users_id' => $_SESSION['userid']]);
?>

<div class="container">
    <div class="d-flex justify-content-between my-4">
        <h1><i class="fa fa-user"></i> Profile</h1>
        <div>
            <?php
            $status = first('users', ['users_id' => $_SESSION['userid']]);

            if ($status['users_role'] === "AUTHOR") {
            ?>
                <a href="<?php echo $status['users_status'] == 'PENDING' ? '#' : 'add_editor_action.php' ?>" class="btn btn-sm px-4 <?php echo $status['users_status'] == 'PENDING' ? 'btn-secondary' : 'btn-primary' ?>"><?php echo $status['users_status'] == 'PENDING' ? 'Already Applied for Editor'  : 'Become an Editor' ?></a>
            <?php

            } else { ?>
                <button class="btn btn-success">You are now an Editor</button>
            <?php } ?>

            <a href="profilesettings.php" class="btn btn-dark btn-sm px-4"><i class="fa fa-user"></i> Profile Settings</a>
            <a href="index.php" class="btn btn-secondary btn-sm px-4"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="novel-details my-4 mt-5">

        <div class="border mb-2" style="height:300px; width:300px">
            <img class="picture_novel" src="<?php echo !empty($query['profile_picture']) ? $query['profile_picture'] : 'images/placeholder.jpg' ?>" alt="Preview Image">
        </div>

        <div style="width:300px">
            <a href="donated.php" class="btn btn-primary btn-sm mb-2 w-100">
                <i class="fa fa-money text-light"></i>
                Donations
            </a>
        </div>

        <div>
            <h3><i class="fa fa-user"></i> Profile Name</h3>
            <p class="profile">
                <?php
                echo $query["firstname"] . ' ' . $query["lastname"];
                ?>
            </p>

            <h3><i class="fa fa-calendar"></i> Birthday</h3>
            <p class="profile">
                <?php
                echo date('M d, Y', strtotime($query['birthday']));
                ?>
            </p>

            <h3><i class="fa fa-info-circle"></i> About</h3>
            <p class="profile">
                <?php
                if (!empty($query['profiles_about'])) {
                    echo $query['profiles_about'];
                } else {
                    echo 'No written description about your self';
                }
                ?>
            </p>
            <h3><i class="fa fa-book"></i> Novels Created</h3>

            <?php
            if (!empty($novels)) {
                foreach ($novels as $novel) :
                    echo ' <p class="profile"><i class="fa fa-book"></i> ' . $novel['title'] . '<a href="view.php?id=' . $novel['id'] . '"><i class="fa fa-edit ms-1 cursor-pointer"></i></a></p>';
                endforeach;
            } else {
                echo '<p class="profile">No novel Created</p>';
            }
            ?>
        </div>
    </div>
</div>

<?php
require_once('footer.php');
?>