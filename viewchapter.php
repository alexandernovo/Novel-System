<?php require_once('header.php');
$chapter = first('chapters', ['chapter_id' => $_GET['chapter_id']]);
?>

<div class="card col-11 mt-3 mx-auto p-5 mb-3">

    <form method="post" action="includes/update_chapter.php">
        <input type="hidden" name="chapter_id" value="<?php echo $_GET['chapter_id'] ?>">
        <input type="hidden" name="novel_id" value="<?php echo $_GET['novel_id'] ?>">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <p style="font-size:30px" class="m-0 mb-2 me-1">Chapter:</p>
                <input class="h3 text-bold form-control  py-0" style="font-size:30px; width:100px" value="<?php echo $chapter['chapter_number'] ?>" name="chapter">
            </div>
            <a href="view.php?id=<?php echo $_GET['novel_id'] ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <div class="d-flex align-items-center">
            <p style="font-size:30px" class="m-0 mb-2 me-1">Title:</p>
            <input class="h3 text-bold form-control  py-0" style="font-size:30px" value="<?php echo $chapter['title'] ?>" name="title">
        </div>

        <textarea class="form-control chapters" name="content"><?php echo $chapter['content']; ?></textarea>
        <button class="btn btn-primary float-end mt-3" type="submit" name="update"><i class="fa fa-edit"></i> Update Chapter</button>
    </form>
</div>
<?php require_once('footer.php'); ?>