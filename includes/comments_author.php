<?php
session_start();
require_once('../functions/config.php');

if (isset($_POST['comment_author'])) {
    $novel_id = $_POST['novel_id'];
    $comment = $_POST['comment'];

    $save1 = update('novels', ['id' => $novel_id], ['status' => 'Pending']);
    $save2 = save('audit_trail', ['users_id' => $_SESSION['userid'], 'novel_id' => $novel_id, 'audit_description' => $description_enum[1], 'audit_status' => $status_enum[1], 'audit_datetime' => date('Y-m-d h:i:s')]);
    $save3 = save('comments', ['audit_trail_id' => $save2, 'comments_text' => $comment]);
    redirect('../view', ['id' => $novel_id]);
    setFlash('success', 'Resubmit Successfully');
}
