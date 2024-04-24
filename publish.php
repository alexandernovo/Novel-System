<?php
include 'includes/database.php';
require_once('functions/config.php');

$id = $_POST['id'];
$status = $status_enum[1];
$query = "UPDATE `novels` SET status = 'Pending' WHERE `id`='$id' ";
$save_audit = save('audit_trail', [
    'users_id' => $_SESSION['userid'],
    'novel_id' => $id,
    'audit_description' => $description_enum[1],
    'audit_status' => $status_enum[1]
]);
$result = $conn->query($query);

$run = mysqli_query($conn, $query);

setFlash('success', 'Novel pending. This process will undergo viewing. Thank you!');
header("refresh:0; url=library.php"); //redirect to prev pages
