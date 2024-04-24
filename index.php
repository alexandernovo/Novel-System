<?php require_once('header2.php'); ?>
<div class="col-11 mx-auto my-4 mangga_read">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-white" id="search_text"><i class="fa fa-line-chart "></i> Releases</h3>
        <?php if (isset($_SESSION['userid'])) : ?>
            <?php
            $status = first('users', ['users_id' => $_SESSION['userid']]);
            if ($status['users_role'] === "READER") {
            ?>
                <a href="includes/author_apply.php?apply_author" class="btn btn-customize-author btn-sm"><i class="fa fa-pen me-1"></i> Become an Author</a>
            <?php } else { ?>
                <p class="author_text text-white"><i class="fa fa-pen me-1"></i>Author</p>
            <?php } ?>
        <?php endif; ?>
    </div>
    <div class="row mx-auto mt-3" id="result">
        <!-- Automatic Render the Novels Here -->
    </div>
</div>
<?php require_once('footer.php'); ?>