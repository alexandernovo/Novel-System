<?php
require_once('header.php');
require("includes/database.php");
$novel_id = $_GET['id'];
?>

<div class="container my-3 mb-5">
    <div class="d-flex justify-content-between my-4">
        <h2 class="h2 text-bold"><i class="fa fa-edit"></i> Edit Novel</h2>
        <div>
            <a href="library.php" class="btn btn-secondary btn-sm px-4"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <?php
    $novel_info = $conn->query("SELECT * FROM novels WHERE id = '$novel_id'");
    while ($novel_row = $novel_info->fetch_assoc()) {
    ?>
        <form action="includes/process.php" method="post" enctype="multipart/form-data">

            <input type="hidden" value="<?php echo $_GET['id'] ?>" name="novel_id">
            <?php $picture = first('novels', ['id' => $novel_id]); ?>

            <div class="border my-3 col-4" id="image-container">
                <img id="preview-image" src="<?php echo !empty($picture['novel_image']) ? $picture['novel_image'] : 'images/placeholder.jpg' ?>" alt="Preview Image">
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="file" id="image-upload" required name="novel_image" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="form-element my-4">
                <label>Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" value='<?php echo $novel_row['title'] ?>'>
            </div>

            <div class="form-element my-4">
                <label>Subtitle</label>
                <input type="text" class="form-control" name="subtitle" placeholder="Subtitle" value='<?php echo $novel_row['subtitle'] ?>'>
            </div>

            <div class="form-element my-4">
                <label>Synopsis</label>
                <textarea rows="10" class="form-control" name="synopsis" placeholder="Synopsis"><?php echo $novel_row['synopsis'] ?></textarea>
            </div>

            <div class="row mx-auto my-4">
                <?php
                $genre_select = $conn->query("SELECT * FROM genre WHERE novel_id ='$novel_id'");
                while ($genre_row = $genre_select->fetch_assoc()) {
                    $genre_id = $genre_row['genre_id'];
                    $novel_genre = $conn->query("SELECT * FROM genre WHERE novel_id ='$novel_id' AND genre_id='$genre_id'");
                    $checked = $novel_genre->num_rows > 0 ? 'checked' : '';
                ?>
                    <div class="col-3">
                        <input class="form-check-input" type="checkbox" value="<?php echo $genre_row['genre_name'] ?>" name="genre[]" id="genre<?php echo $genre_row['genre_id'] ?>" <?php echo $checked ?>>
                        <label class="form-check-label" for="genre<?php echo $genre_row['genre_id'] ?>">
                            <?php echo $genre_row['genre_name'] ?>
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


            <div class="modal-footer">
                <button type="submit" name="update" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Update Novel</button>
            </div>
        </form>
    <?php
    }
    ?>

</div>
<?php require_once('footer.php') ?>