<?php
require_once('../functions/config.php');

if (isset($_GET['apply_author'])) {
    $update = update('users', ['users_id' => $_SESSION['userid']], ['users_role' => "AUTHOR"]);
    if ($update) {
        setFlash('success', "Please Logout your account to save changes.");
        redirect('../index');
    }
}
