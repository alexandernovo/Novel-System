<?php
require_once('../functions/config.php');
if (isset($_POST['payment'])) {

    $isLogin = $_POST['isLogin'];
    $users_id = $_POST['users_id'];
    $anonymous = $_POST['anonymous'];
    $name = $_POST['name'];
    if ($isLogin == 1) {
        if ($anonymous == 1) {
            $data = [
                'author' => $_POST['author_id'],
                'donator' => $_POST['users_id'],
                'name' => empty($name) ? 'Unknown' : $name,
                'amount' => $_POST['payment_amount'],
                'date_donate' => date('Y-m-d h:i:s')
            ];
        } else {
            $data = [
                'author' => $_POST['author_id'],
                'donator' => $_POST['users_id'],
                'amount' => $_POST['payment_amount'],
                'date_donate' => date('Y-m-d h:i:s')
            ];
        }
    } else {
        $data = [
            'author' => $_POST['author_id'],
            'name' => empty($name) ? 'Unknown' : $name,
            'amount' => $_POST['payment_amount'],
            'date_donate' => date('Y-m-d h:i:s')
        ];
    }

    $save = save('donations', $data);
    $user = first('users', ['users_id' => $_POST['author_id']]);
    if ($save) {
        http_response_code(200);
        echo json_encode(array("status" => "success", "message" => 'Success Donating', 'author' => $user['users_username']));
    } else {
        http_response_code(400);
        echo json_encode(array("status" => "error", "message" => "Error."));
    }
}
