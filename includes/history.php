<?php
require_once('../functions/config.php');
$novel_id = $_GET['novel_id'];

if (!empty($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
    $check_exist = first('history', ['users_id' => $user_id, 'novel_id' => $novel_id]);
    if ($check_exist) {
        $save = update('history', ['users_id' => $user_id, 'novel_id' => $novel_id], ['read_date' => date('Y-m-d h:i:s')]);
    } else {
        echo 'yow';
        $save = save('history', ['users_id' => $user_id, 'novel_id' => $novel_id, 'read_date' => date('Y-m-d h:i:s')]);
    }
    if ($save) {
        redirect('../publish_view', ['id' => $novel_id]);
    }
} else {
    redirect('../publish_view', ['id' => $novel_id]);
}