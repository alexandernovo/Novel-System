<?php require_once('../functions/config.php');

if (isset($_POST['create'])) {
    $novel_id = $_POST['novel_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $chapter_number = $_POST['chapter_number'];

    foreach ($title as $key => $value) :
        $result = save('chapters', ['chapter_number' => $chapter_number[$key], 'title' => $title[$key], 'content' => $content[$key], 'novel_id' => $novel_id, 'chapter_date_added' => date('Y-m-d')]);
    endforeach;

    if ($result) {
        redirect('../view', ['id' => $novel_id]);
    }
}
