<?php require_once('../functions/config.php');

if (isset($_POST['update'])) {
    $chapter = $_POST['chapter'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $chapter_id = $_POST['chapter_id'];
    $novel_id = $_POST['novel_id'];

    $data = [
        'chapter_number' => $chapter,
        'title' => $title,
        'content' => $content,
    ];
    $update = update('chapters', ['chapter_id' => $chapter_id], $data);
    if ($update) {
        setFlash('success', 'Chapter Updated Successfully');
        redirect('../viewchapter', ['chapter_id' => $chapter_id, 'novel_id' => $novel_id]);
    }
}
