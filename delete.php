<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include("includes/database.php");

    $sql6 = "DELETE comments, audit_trail
    FROM comments
    INNER JOIN audit_trail ON comments.audit_trail_id = audit_trail.audit_trail_id
    WHERE audit_trail.novel_id = $id;
    ";
    $sql5 = "DELETE FROM ratings WHERE novel_id=$id";
    $sql4 = "DELETE FROM history WHERE novel_id=$id";
    $sql3 = "DELETE FROM genre WHERE novel_id=$id";
    $sql2 = "DELETE FROM chapters WHERE novel_id=$id";
    $sql = "DELETE FROM novels WHERE id = $id";

    if (mysqli_query($conn, $sql2)) {
        mysqli_query($conn, $sql6);
        mysqli_query($conn, $sql5);
        mysqli_query($conn, $sql4);
        mysqli_query($conn, $sql3);
        mysqli_query($conn, $sql);
        session_start();
        $_SESSION["delete"] = "Novel Deleted!";
        header("Location: library.php");
    }
}
