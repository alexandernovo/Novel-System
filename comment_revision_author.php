<?php require_once('header.php');
$novel = first('novels', ['id' => $_GET['novel_id']]);
?>
<div class="col-8 mx-auto mt-4">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h3 class="text-bold"><i class="fa fa-history"></i> Revision Submit Comment for <?= $novel['title'] ?></h3>
        <a href="view.php?id=<?php echo $_GET['novel_id'] ?>" class="btn btn-secondary me-2 btn-sm px-4"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <form method="POST" action="includes/comments_author.php">
        <input type="hidden" name="novel_id" value="<?php echo $_GET['novel_id'] ?>">
        <textarea class="form-control" rows="6" placeholder="Comments" name="comment"></textarea>
        <button type="submit" class="btn btn-success float-end mt-2" name="comment_author"><i class="fa fa-check"></i> Submit</button>
    </form>
</div>

<?php require_once('footer.php') ?>