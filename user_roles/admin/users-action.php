<?php
session_start();
require("../database.php");
require("../../functions/database.php");
if ($_SESSION['users_role'] == 'ADMIN') {


    if (isset($_GET['approve'])) {
        $approve = $_GET['approve'];


        // Update the user's role and status in the database
        $sql = "UPDATE users SET users_role = 'EDITOR', users_status = '' WHERE users_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $approve);
        $stmt->execute();

        // Redirect to the user management page
        header("Location: user-management.php");
        exit();
    }

    if (isset($_GET['deny'])) {
        $deny = $_GET['deny'];
        // Update the user's role and status in the database
        $sql = "UPDATE users SET users_role = 'AUTHOR', users_status = '' WHERE users_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $deny);
        $stmt->execute();

        // Redirect to the user management page
        header("Location: user-management.php");
        exit();
    }

    if (isset($_GET['demote'])) {
        $demote = $_GET['demote'];
        // Update the user's role and status in the database
        $sql = "UPDATE users SET users_role = 'AUTHOR', users_status = '' WHERE users_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $demote);
        $stmt->execute();

        // Redirect to the user management page
        header("Location: admin-dashboard.php");
        exit();
    }
    if (isset($_GET['promote'])) {
        $promote = $_GET['promote'];
        $check = first('users', ['users_id' => $demote]);
        if ($check['users_role'] == "AUTHOR") {
            $role = "READER";
        }
        if ($check['users_role'] == "EDITOR") {
            $role = "AUTHOR";
        }
        if ($check['users_role'] == "ADMIN") {
            $role = "EDITOR";
        }
        // Update the user's role and status in the database
        $sql = "UPDATE users SET users_role = '$role', users_status = '' WHERE users_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $promote);
        $stmt->execute();
        // Redirect to the user management page
        header("Location: admin-dashboard.php");
        exit();
    }
} else {
    header("Location: ../login.php");
}
