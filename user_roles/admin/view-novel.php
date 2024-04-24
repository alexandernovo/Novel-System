<?php
require_once('header.php');
$novel = first('novels', ['id' => $_GET['view']]);
$genres = find_where('genre',  ['novel_id' => $_GET['view']]);
?>

<div class="container my-3">
    <div class="d-flex justify-content-end">
        <a href="novel-management.php" class="btn btn-secondary btn-sm px-4"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="col-8 mx-auto border p-3 rounded shadow">
        <div class="col-12 mb-3">
            <div class="row g-0 mb-2 overflow-hidden " style="height:530px">
                <div class="border col-6 rounded overflow-hidden" style="height: 100%;">
                    <img src="../../<?= $novel['novel_image'] ?>" class="picture_novel">
                </div>
                <div class="col-6 px-3 pt-2 overflow-auto" style="height:500px">
                    <p style="font-size: 18px;"><span class="text-bold">Title:</span> <?= $novel['title'] ?></p>
                    <p><span class="text-bold">Alternate:</span> <?= $novel['subtitle'] ?></p>
                    <p><span class="text-bold">Genre:</span>
                        <?php
                        $count = count($genres);
                        foreach ($genres as $index => $genre) {
                            echo $genre['genre_name'];
                            if ($index != $count - 1) {
                                echo ', ';
                            }
                        }
                        ?>
                    </p>
                    <p><span class="text-bold">Synopsis:</span>
                    <p class="synopsis"><?= $novel['synopsis'] ?></p>
                    </p>
                </div>
            </div>
            <div class="row mx-auto g-0">
                <div class="col-6">
                    <div class="row mx-auto me-1">
                        <?php $first = first('chapters', ['novel_id' => $_GET['view']]); ?>
                        <a href="<?php echo $first ? 'read-novel.php?chapter_id=' . $first['chapter_id'] . '&novel_id=' . $_GET['view'] : '#' ?>" class="btn btn-primary mb-2 btn-sm"><i class="fa fa-book"></i> Read First</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row mx-auto ms-1">
                        <?php $last = last('chapters', ['novel_id' => $_GET['view']], 'chapter_number'); ?>
                        <a href="<?php echo $last ? 'read-novel.php?chapter_id=' . $first['chapter_id'] . '&novel_id=' . $_GET['view'] : '#' ?>" class="btn btn-primary mb-2 btn-sm"><i class="fa fa-book"></i> Read Last</a>
                    </div>
                </div>
            </div>
            <div class="row mx-auto g-0">
                <div class="col-6">
                    <div class="row mx-auto me-1">
                        <a href="comments_deny.php?deny=<?php echo $_GET['view'] ?>" class="btn btn-danger me-2 btn-sm"><i class="fa fa-times"></i> Deny</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row mx-auto ms-1">
                        <a href="novel-action.php?approve=<?php echo $_GET['view'] ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Publish</a>
                    </div>
                </div>
            </div>
            <div class="row mx-auto" style="max-height: 300px; overflow-y:auto; overflow-x:hidden;">
                <p class="text-bold mb-0 mt-3">Chapters:</p>
                <div class="mx-2 mt-2">
                    <?php $chapters = find_where('chapters', ['novel_id' => $_GET['view']]); ?>
                    <?php foreach ($chapters as $chapter) : ?>
                        <p class="mb-2"><a href="read-novel.php?chapter_id=<?= $chapter['chapter_id'] ?>&novel_id=<?php echo $_GET['view'] ?>" class="text-dark "><?= 'Chapter: ' . $chapter['chapter_number'] . ' ' . $chapter['title'] ?></a></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- <div class="row mx-auto mt-3">
                <hr class="mt-5">
                <p class="text-bold mb-0">Comments:</p>
                <?php $comments = joinTable('comments', [['users', 'comments.users_id', 'users.users_id']], ['comments.novel_id' => $_GET['view']]); ?>
                <div class="mx-2 mt-3">
                    <?php foreach ($comments as $comment) : ?>
                        <p class="text-secondary "><span class="text-dark text-bold text-decoration-underline"><?= $comment['users_username'] . '(editor)' ?></span>: <?= $comment['comments_text'] ?></p>
                    <?php endforeach; ?>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>