<?php require_once('header.php'); ?>

<div class="container my-3">
    <h3 class="text-bold mb-3"><i class="fa fa-history"></i> Comment for Revision</h3>
    <form action="addcomments.php" method="post">
        <label for="comment" class="form-label">Add Comment</label>
        <input type="text" name="comments" class="form-control">
        <input type="hidden" name="deny" value="<?php echo $_GET['deny'] ?>">
        <button type="submit" name="revise" class="btn btn-primary px-4 mt-3">Submit</button>
    </form>
</div>
<?php require_once('footer.php'); ?>