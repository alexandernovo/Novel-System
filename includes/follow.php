<?php require_once('../functions/config.php');

$novel_id = $_GET['novel_id'];
$users_id = $_GET['users_id'];
$follower_id = $_SESSION['userid'];
$check = first('followers', ['members_id' => $follower_id, 'author_id' => $users_id]);

if ($check) {
    $actions = delete('followers', ['followers_id' => $check['followers_id']]);
    redirect('../profile_donate', ['users_id' => $users_id, 'novel_id' => $novel_id]);
} else {
    $actions = save('followers', ['members_id' => $follower_id, 'author_id' => $users_id, 'date_followed' => date('Y-m-d h:i:s')]);
    redirect('../profile_donate', ['users_id' => $users_id, 'novel_id' => $novel_id]);
}
