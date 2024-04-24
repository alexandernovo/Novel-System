<?php
require("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT users_id, users_role, users_pwd FROM users WHERE users_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($users_id, $users_role, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['users_id'] = $users_id;
            $_SESSION['users_role'] = $users_role;
            if($users_role == 'ADMIN'){
                header("Location: admin/admin-dashboard.php");
                exit();
            }
            else if($users_role == 'EDITOR'){
                header("Location: editor/editor-dashboard.php");
                exit();
            }
            else{
                header("Location: login.php?error=Invalid%20Role");
                exit();
            }
            
        }
    }

    // Invalid credentials
    header("Location: login.php?error=Invalid%20credentials");
    exit();
}
?>
