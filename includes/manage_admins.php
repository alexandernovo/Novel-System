<?php
require_once('../functions/config.php');
if (isset($_POST['save_admin'])) {
    $save = save('users', [
        'users_username' => $_POST['username'],
        'users_pwd' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'users_email' => $_POST['email'],
        'users_role' => 'ADMIN'
    ]);

    if ($save) {
        setFlash('success', 'Admin Added Successfully');
        redirect('../user_roles/admin/admin-dashboard');
    }
}

if (isset($_POST['update_admin'])) {
    $users_id = $_POST['users_id'];
    if (!empty($_POST['password'])) {
        $data = [
            'users_username' => $_POST['username'],
            'users_pwd' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'users_email' => $_POST['email'],
        ];
    } else {
        $data = [
            'users_username' => $_POST['username'],
            'users_email' => $_POST['email'],
        ];
    }
    $update = update('users', ['users_id' => $_POST['users_id']], $data);
    if ($update) {
        setFlash('success', 'Admin Updated Successfully');
        redirect('../user_roles/admin/admin-dashboard');
    }
}

if (isset($_GET['delete'])) {
    $delete = delete('users', ['users_id' => $_GET['users_id']]);
    if ($delete) {
        setFlash('success', 'Admin Deleted Successfully');
        redirect('../user_roles/admin/admin-dashboard');
    }
}
