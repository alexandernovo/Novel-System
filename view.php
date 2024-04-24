<?php require_once('header.php');
$novel_spec = first('novels', ['id' => $_GET['id']]);
?>
<div class="container">

    <div class="d-flex justify-content-between my-4">
        <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            require("includes/database.php");
            $sql = "SELECT * FROM novels WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

        ?>
            <h2 class="text-bold h2"><i class="fa fa-book"></i> Novel Details</h2>
            <div class="d-flex align-items-center">
                <?php if ($novel_spec['status'] != $status_enum[2]) { ?>
                    <form action="publish.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button <?php
                                echo $novel_spec['status'] == "PUBLISHED" || $novel_spec['status'] == "Pending" || $novel_spec['status'] == "APPROVAL" ? 'disabled' : ($novel_spec['status'] == "Revision" ? 'name="republish"' : ($novel_spec['status'] == "Denied" ? 'disabled' : ''));
                                ?> class="btn <?php
                                                echo $novel_spec['status'] == "PUBLISHED" || $novel_spec['status'] == "APPROVAL" ? 'btn-dark' : ($novel_spec['status'] == "Revision" ? 'btn-warning' : ($novel_spec['status'] == "Denied" ? 'btn-danger' : ($novel_spec['status'] == "Pending" ? 'btn-secondary' : 'btn-success')));
                                                ?> me-2 btn-sm px-4">
                            <i class="fa fa-upload"></i>
                            <?php
                            echo $novel_spec['status'] == "PUBLISHED" ? 'Already Published' : ($novel_spec['status'] == "Revision" ? 'Resubmit' : ($novel_spec['status'] == "Denied" ? 'Denied Published' : ($novel_spec['status'] == "Pending" ? 'Already Submitted' : ($novel_spec['status'] == "APPROVAL" ? 'Waiting for Approval' : 'Submit'))));
                            ?>
                        </button>

                    </form>
                <?php } else { ?>
                    <a href="comment_revision_author.php?novel_id=<?php echo $_GET['id'] ?>" class="btn btn-warning me-2 btn-sm px-4"><i class="fa fa-history"></i> Resubmit</a>
                <?php } ?>
                <button type="button" onclick="window.history.back()" class="btn btn-secondary btn-sm px-4"><i class="fa fa-arrow-left"></i> Back</a>
            </div>



    </div>
    <div class="row mx-auto my-4 overflow-hidden" style="height: 500px;">
        <div class="col-3 border g-0 rounded overflow-hidden" style="height:100%">
            <img src="<?= $novel_spec['novel_image'] ?>" class="picture_novel">
        </div>
        <div class="col-9" style="height:100%; overflow-x:hidden; overflow-y:auto;">
            <h3>Title</h3>
            <p><?php echo $row["title"]; ?></p>
            <h3>Subtitle</h3>
            <p><?php echo $row["subtitle"]; ?></p>
            <h3>Genre</h3>
            <?php $novel_id = $row['id']; ?>
            <p><?php
                $genre_show = $conn->query("SELECT * FROM  genre WHERE  novel_id = '$id'");
                $num_rows = $genre_show->num_rows;
                $i = 0;

                while ($genre_row = $genre_show->fetch_assoc()) {
                    echo $genre_row['genre_name'];

                    // Check if it's the last iteration
                    if ($i < $num_rows - 1) {
                        echo ", ";
                    }

                    $i++;
                }

                ?></p>
        <?php
        }
        ?>
        <h3>Synopsis</h3>
        <p class="synopsis"><?php echo $row["synopsis"]; ?></p>

        </div>
    </div>

    <div class="my-3 d-flex justify-content-end">
        <?php if ($novel_spec['status'] != 'PUBLISHED') : ?>
            <a href="add_chapter.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm px-4" id="addChapterBtn"><i class="fa fa-plus"></i> Add Chapter</a>
        <?php endif; ?>
    </div>
    <div class="mb-5">
        <table class="table" id="tables">
            <thead>
                <tr class="table-dark">
                    <th scope="col">Chapter</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $chapterView = $conn->query("SELECT * FROM chapters WHERE novel_id = '$id' ORDER BY chapter_number");
                while ($chapterRow = $chapterView->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $chapterRow['chapter_number'] ?></td>
                        <td><?php echo $chapterRow['title'] ?></td>
                        <td><?php echo $chapterRow['chapter_date_added'] ?></td>
                        <td><a href="viewchapter.php?chapter_id=<?php echo $chapterRow['chapter_id'] ?>&novel_id=<?php echo $_GET['id'] ?>" class="btn btn-primary btn-sm px-4"><i class="fa fa-eye"></i> View</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- <div>
            <hr class="mt-5">
            <p class="text-bold">Comments:</p>
            <?php $comments = joinTable('comments', [['users', 'comments.users_id', 'users.users_id']], ['comments.novel_id' => $_GET['id']]); ?>
            <div class="px-2">
                <?php foreach ($comments as $comment) : ?>
                    <p class="text-secondary "><span class="text-dark text-bold text-decoration-underline"><?= $comment['users_username'] . '(editor)' ?></span>: <?= $comment['comments_text'] ?></p>
                <?php endforeach; ?>
            </div>
        </div> -->

    </div>
    <div class="modal fade" id="modalComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>