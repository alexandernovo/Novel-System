<?php
session_start();
class Login extends Dbh
{
    protected function getUser($username, $pwd)
    {
        $stmt = $this->connect()->prepare('SELECT users_id, users_pwd, users_role, users_status FROM users WHERE users_username = ? OR users_email = ? LIMIT 1;');

        if (!$stmt->execute([$username, $username])) {
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //if wrong authentication
        if (!$user || !password_verify($pwd, $user["users_pwd"])) {
            header("Location: ../login.php?error=Invalid username or password");
            exit();
        }
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Welcome ' . $username
        ];
        $stmt2 = $this->connect()->prepare("SELECT * FROM profiles WHERE users_id=:users_id");
        $stmt2->execute([':users_id' => $user['users_id']]);
        $profile = $stmt2->fetch(PDO::FETCH_ASSOC);
        $_SESSION["userid"] = $user["users_id"];
        $_SESSION["userusername"] = $username;
        $_SESSION["users_role"] = $user["users_role"];
        $_SESSION["users_status"] = $user["users_status"];
        $_SESSION["firstname"] =  $profile["firstname"];
        $_SESSION["lastname"] =  $profile["lastname"];

        if ($user['users_role'] === 'ADMIN') {
            header("Location: ../user_roles/admin/admin-dashboard.php?success=Welcome " . $username);
        } else if ($user['users_role'] === 'EDITOR') {
            header("Location: ../user_roles/editor/editor-dashboard.php?success=Welcome " . $username);
        } else if ($user['users_role'] === 'AUTHOR') {
            header("Location: ../index.php?success=Welcome " . $username);
        } else if ($user['users_role'] === 'READER') {
            header("Location: ../index.php?success=Welcome " . $username);
        } else {
        }
    }
}
