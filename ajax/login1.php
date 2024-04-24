<?php
require_once('../functions/config.php');


if ($_POST['username'] && $_POST['password']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = first('users', ['users_username' => $username]);

    if ($user) {
        if (password_verify($password, $user['users_pwd'])) {
            //set session
            setFlash('success', 'Login Successfully');
            $_SESSION["userid"] = $user["users_id"];
            $_SESSION["userusername"] = $username;
            $_SESSION["users_role"] = $user["users_role"];
            $_SESSION["users_status"] = $user["users_status"];

            $response['status'] = 'success';
            $response['message'] = 'Login successful';
        } else {
            $response['status'] = 'error_password';
            $response['message'] = 'Incorrect password';
        }
    } else {
        $response['status'] = 'error_username';
        $response['message'] = 'Username does not exist';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Data is not Provided';
}

header('Content-Type: application/json');

echo json_encode($response);
