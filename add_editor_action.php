<?php
require_once('functions/config.php');

if (!isset($_SESSION['userid'])) {
    exit;
}

$add_editor = update('users', ['users_id' => $_SESSION['userid']], ['users_status' => 'PENDING']);

if ($add_editor) {
    setFlash('success', 'Applied for Editor Successfully');
    redirect('profile');
}
