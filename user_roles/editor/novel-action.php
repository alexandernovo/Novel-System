<?php
session_start();
require_once('../../functions/config.php');
require("../database.php");

if (isset($_GET['approve'])) {
    $approve = $_GET['approve'];

    $sql = "UPDATE novels SET status = 'APPROVAL' WHERE id = '$approve'";
    $result = mysqli_query($conn, $sql);
    $save_audit = save(
        'audit_trail',
        [
            'users_id' => $_SESSION['userid'],
            'novel_id' =>  $approve,
            'audit_description' => $description_enum[3],
            'audit_status' => $status_enum[3],
        ]
    );
    if ($result) {
        // Update successful
        setFlash('success', 'Approved Novel Succesfully');
        header("Location: editor-dashboard.php");
    } else {
        // Error occurred
        echo "Error: " . mysqli_error($conn);
    }
}
