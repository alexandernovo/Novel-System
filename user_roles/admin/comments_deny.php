<?php
require("../database.php");
require_once('header.php')
?>
<div class="col-8 mx-auto mt-4">
    <h3 class="text-bold mb-3"><i class="fa fa-history"></i> Comment for Denying</h3>
    <form method="POST" action="novel-action.php">
        <input type="hidden" name="novel_id" value="<?php echo $_GET['deny'] ?>">
        <textarea class="form-control" rows="5" name="comment"></textarea>
        <button type="submit" class="btn btn-success float-end mt-2" name="comment_admin"><i class="fa fa-check"></i> Submit</button>
    </form>
</div>
<?php
require_once('footer.php');
?>