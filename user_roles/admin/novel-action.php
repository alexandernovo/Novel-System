<?php
require_once('../../functions/config.php');
require("../database.php");

if (isset($_GET['approve'])) {
    $approve = $_GET['approve'];

    $sql = "UPDATE novels SET status = 'PUBLISHED' WHERE id = '$approve'";
    $result = mysqli_query($conn, $sql);
    $save_audit = save(
        'audit_trail',
        [
            'users_id' => $_SESSION['userid'],
            'novel_id' =>  $approve,
            'audit_description' => $description_enum[4],
            'audit_status' => $status_enum[4],
        ]
    );
    if ($result) {
        // Update successful
        setFlash('success', 'Publish Successfully');
        header("Location: novel-management.php");
    } else {
        // Error occurred
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['comment_admin'])) {
    $novel_id = $_POST['novel_id'];

    $sql = "UPDATE novels SET status = 'Denied' WHERE id = '$novel_id'";
    $result = mysqli_query($conn, $sql);
    $save_audit = save(
        'audit_trail',
        [
            'users_id' => $_SESSION['userid'],
            'novel_id' => $novel_id,
            'audit_description' => $description_enum[5],
            'audit_status' => $status_enum[5],
        ]
    );
    $comment = save('comments', ['audit_trail_id' => $save_audit, 'comments_text' => $_POST['comment']]);
    if ($result) {
        // Update successful
        setFlash('success', 'Denied Successfully');
        header("Location: novel-management.php");
    } else {
        // Error occurred
        echo "Error: " . mysqli_error($conn);
    }
}
