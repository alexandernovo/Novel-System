<?php
require_once('../functions/config.php');

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $synopsis = $_POST['synopsis'];
    if (isset($_POST['genre'])) {
        $genre = $_POST['genre'];
    }
    $author = $_POST['author'];
    $id = $_POST['id'];
    if (isset($_POST['custom_genre'])) {
        $custom_genre = $_POST['custom_genre'];
    }

    //image process
    $file_name = $_FILES['novel_image']['name'];
    $file_temp = $_FILES['novel_image']['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_new_name = uniqid() . '.' . $file_ext;
    $file_dest = '../images/novel_images/' . $file_new_name;

    if (move_uploaded_file($file_temp, $file_dest)) { //move the file to the folder

        $data = [
            'title' => $title,
            'subtitle' => $subtitle,
            'synopsis' => $synopsis,
            'status' => '',
            'novel_image' => 'images/novel_images/' . $file_new_name,
            'users_id' => $id,
        ];
        $novels = save('novels', $data);
        if ($novels) {
            if (!empty($custom_genre[0])) {
                foreach ($custom_genre as $key => $value) {
                    $cust_genre = save('genre', ['novel_id' => $novels, 'genre_name' => $value]);
                }
            }
            if (!empty($genre[0])) {
                foreach ($genre as $key => $value) {
                    $result = save('genre', ['novel_id' => $novels, 'genre_name' => $value]);
                }
            }

            setFlash('success', 'Novel Created Successfully');
            redirect('../library');
        }
    }
}



if (isset($_POST['update'])) {
    $novel_id = $_POST['novel_id'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $synopsis = $_POST['synopsis'];

    if (isset($_POST['genre'])) {
        $genre = $_POST['genre'];
    }

    if (isset($_POST['custom_genre'])) {
        $custom_genre = $_POST['custom_genre'];
    }

    if (!empty($_FILES['novel_image'])) {
        //image process
        $file_name = $_FILES['novel_image']['name'];
        $file_temp = $_FILES['novel_image']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_new_name = uniqid() . '.' . $file_ext;
        $file_dest = '../images/novel_images/' . $file_new_name;
        move_uploaded_file($file_temp, $file_dest);

        $data = [
            'title' => $title,
            'subtitle' => $subtitle,
            'synopsis' => $synopsis,
            'novel_image' => 'images/novel_images/' . $file_new_name,
        ];
    } else {

        $data = [
            'title' => $title,
            'subtitle' => $subtitle,
            'synopsis' => $synopsis,
        ];
    }

    $novels = update('novels', ['id' => $novel_id], $data);

    if (!empty($genre[0])) {
        $delete = delete('genre', ['novel_id' => $novel_id]);
        if ($delete) {
            foreach ($genre as $key => $value) {
                if (!$check) {
                    $result = save('genre', ['novel_id' => $novel_id, 'genre_name' => $value]);
                }
            }
        }
    }
    if (!empty($custom_genre[0])) {
        foreach ($custom_genre as $key => $value) {
            $cust_genre = save('genre', ['novel_id' => $novel_id, 'genre_name' => $value]);
        }
    }


    setFlash('success', 'Novel Updated Successfully');
    redirect('../library');
}
// custom_genre