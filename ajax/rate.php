<?php
require_once('../functions/config.php');

$user_id = $_POST['user_id'];
$novel_id = $_POST['novel_id'];
$user_review = $_POST['user_review'];
$ratings = $_POST['ratings'];

$check = first('ratings', ['users_id' => $user_id, 'novel_id' => $novel_id]);
if ($check) {
    $save = update('ratings', ['novel_id' => $novel_id, 'users_id' => $user_id], ['user_rating' => $ratings, 'user_rev' => $user_review,]);
    $message = "Review updated successfully";
} else {
    $save = save('ratings', [
        'users_id'          => $user_id,
        'user_rating'       => $ratings,
        'user_rev'          => $user_review,
        'novel_id'          => $novel_id,
        'date'              => date('Y-m-d')
    ]);
    $message = "Review saved successfully";
}

if ($save) {
    setFlash('success', $message);
    $response = array('status' => 'success', 'message' => 'Review saved successfully');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Failed to save review');
    echo json_encode($response);
}
