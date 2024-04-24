<?php require_once('header.php'); ?>
<?php
$novel = first('novels', ['id' => $_GET['novel_id']]);
$chapter = first('chapters', ['chapter_id' => $_GET['chapter_id']]);
?>
<div class="container my-3">
    <div class="col-9 mx-auto ">
        <div class="col-4 mx-auto overflow-hidden rounded" style="height:500px">
            <img src="../../<?= $novel['novel_image'] ?>" class="picture_novel">
        </div>
        <h3 class="text-center text-bold mt-4"><?= $novel['title'] ?></h3>
        <h4 class="text-center text-bold mt-4">Author: <?= $novel['author'] ?></h4>
        <p class="text-secondary text-center mt-4">©NovArch</p>
        <div class="d-flex justify-content-center">
            <a href="view-novel.php?view=<?php echo $_GET['novel_id'] ?>" class="btn btn-secondary btn-sm px-4"><i class="fa fa-home"></i> Home</a>
        </div>
        <p class="text-center mt-5">
            ----------------------------------------------------<i class="fa fa-book"></i>----------------------------------------------------
        </p>
        <p class="m-0 text-bold">Chapter: <?= $chapter['chapter_number'] . ' ' . $chapter['title'] ?></p>
        <p class="m-0 mb-4 mt-1" style="white-space: pre-line;">
            <?= $chapter['content'] ?>
        </p>
        <div class="row mx-auto mb-5">
            <div class="d-flex justify-content-end">
                <?php
                $chapter1 = first('chapters', ['novel_id' => $_GET['novel_id']]);
                $chapternext = first('chapters', ['chapter_id' => $_GET['chapter_id'] + 1]);
                $chapterprev = first('chapters', ['chapter_id' => $_GET['chapter_id'] - 1]);
                ?>

                <?php if ($chapter1['chapter_number'] != $chapter['chapter_number']) : ?>
                    <?php if ($chapterprev) : ?>
                        <a href="read-novel.php?chapter_id=<?= $chapterprev['chapter_id'] ?>&novel_id=<?php echo $_GET['novel_id'] ?>" class="btn btn-primary px-4 me-2"><i class="fa fa-angle-left text-bold"></i> Prev</a>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($chapternext) : ?>
                    <a href="read-novel.php?chapter_id=<?= $chapternext['chapter_id'] ?>&novel_id=<?php echo $_GET['novel_id'] ?>" class="btn btn-primary px-4">Next <i class="fa fa-angle-right text-bold"></i></a>
                <?php endif; ?>

            </div>

        </div>
    </div>

</div>
<?php require_once('footer.php'); ?>