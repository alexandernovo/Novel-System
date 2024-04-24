<?php
require_once('../functions/config.php');

if (isset($_POST['create_profile'])) {
    $donation_link = $_POST['donation_link'];
    $introtitle = $_POST['introtitle'];
    $about = $_POST['about'];
    $introtext = $_POST['introtext'];
    $users_id = $_POST['users_id'];
    $check = first('profiles', ['users_id' => $users_id]);

    if (!empty($_FILES['profile'])) {
        $file_name = $_FILES['profile']['name'];
        $file_temp = $_FILES['profile']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_new_name = uniqid() . '.' . $file_ext;
        $file_dest = '../images/profile/' . $file_new_name;
        if (move_uploaded_file($file_temp, $file_dest)) { //move the file to the folder
            $data = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'birthday' => $_POST['birthday'],
                'profiles_about' => $about,
                'profiles_introtitle' => $introtitle,
                'profiles_introtext' => $introtext,
                'users_id' => $users_id,
                'profile_picture' => 'images/profile/' . $file_new_name
            ];
        }
    } else {
        $data = [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'birthday' => $_POST['birthday'],
            'profiles_about' => $about,
            'profiles_introtitle' => $introtitle,
            'profiles_introtext' => $introtext,
            'users_id' => $users_id
        ];
    }

    if ($check) {
        $profile = update('profiles', ['users_id' => $users_id], $data);
    } else {
        $profile = save('profiles', $data);
    }

    if ($profile) {
        redirect('../profile');
    }
}
