<?php
include_once 'header.php';
require("includes/database.php");
?>


<div class="container my-4">
    <div class="d-flex justify-content-between my-4">
        <h2 class="text-bold h2">Create a New Novel</h2>
        <div>
            <a href="library.php" class="btn btn-secondary btn-sm px-4"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <form action="includes/process.php" method="post" enctype="multipart/form-data">
        <div class="border my-3 col-4" id="image-container">
            <img id="preview-image" src="images/placeholder.jpg" alt="Preview Image">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="file" id="image-upload" required name="novel_image" class="form-control" accept="image/*">
            </div>
        </div>
        <div class="h3 form-element my-4">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required placeholder="Title">
        </div>
        <div class="h3 form-element my-4">
            <label for="" class="form-label">Subtitle</label>
            <input type="text" class="form-control" name="subtitle" required placeholder="Subtitle">
        </div>
        <div class="h3 form-element my-4">
            <label for="" class="form-label">Synopsis</label>
            <textarea rows="10" class="form-control" name="synopsis" required placeholder="Synopsis"></textarea>
        </div>
        <div class="my-4">
            <label for="" class="h3 form-label">Genre</label>
            <div class="row mx-auto">
                <?php
                foreach ($genre_enum as $index => $value) {
                ?>
                    <div class="col-3">
                        <input class="form-check-input" type="checkbox" value="<?php echo $index ?>" name="genre[]">
                        <label class="form-check-label" for="genre<?php echo $genre_row['genre_select'] ?>">
                            <?php echo  $value ?>
                        </label>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="row mx-auto mx-auto p-0 mt-4" id="row-cloned">
                <div class="col-md-3 row-of-form">
                    <div class="form-group">
                        <label>Custom Genre</label>
                        <div class="d-flex align-items-center">
                            <input class="form-control genre me-1" name="custom_genre[]" placeholder="New Genre">
                            <i class="fa fa-times remove text-danger cursor-pointer" style="display: none;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mx-auto mt-2">
                <div class="col-12">
                    <button class="btn btn-primary me-2 btn-sm px-4" type="button" id="add"><i class="fa fa-plus-circle text-size"></i> Genre</button>
                </div>
            </div>

        </div>
        <input type="hidden" name="id" value="<?php echo $_SESSION["userid"]; ?>">
        <div id="chaptersContainer"></div>

        <!-- Hidden input field to store the number of chapters -->
        <input type="hidden" name="chapter_count" id="chapterCount" value="0">

        <!-- Submit button to save the novel -->
        <div class="modal-footer">
            <button type="submit" name="create" class="btn btn-primary btn-sm px-4 mt-5"><i class="fa fa-save"></i> Save Novel</button>
        </div>
    </form>
</div>
<?php require_once('footer.php'); ?>