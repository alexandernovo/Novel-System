<?php
require_once('../../functions/config.php');
include '../../includes/database.php';

if (isset($_POST['revise'])) {
    $update = update('novels', ['id' => $_POST['deny']], ['status' => 'Revision']);
    $save_audit = save(
        'audit_trail',
        [
            'users_id' => $_SESSION['userid'],
            'novel_id' => $_POST['deny'],
            'audit_description' => $description_enum[2],
            'audit_status' => $status_enum[2]
        ]
    );
    $comment = save('comments', ['audit_trail_id' => $save_audit, 'comments_text' => $_POST['comments']]);

    if ($comment) {
        setFlash('success', 'Submit for Revision Successfully');
        redirect('editor-dashboard');
    }
}
