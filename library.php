<?php
require_once('header.php');
?>

<div class="container">
    <div class="d-flex justify-content-between my-4">
        <h2 class="text-bold"><i class="fa fa-book"></i> Library</h2>
        <div>
            <a href="create.php" class="btn btn-primary btn-sm px-4"><i class="fa fa-plus"></i> Create Novel</a>
            <a href="index.php" class="btn btn-secondary btn-sm px-4"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

    </div>
    <?php
    if (isset($_SESSION["create"])) {
    ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION["create"];
            unset($_SESSION["create"]);
            ?>
        </div>
    <?php
    }
    ?>
    <?php
    if (isset($_SESSION["update"])) {
    ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION["update"];
            unset($_SESSION["update"]);
            ?>
        </div>
    <?php
    }
    ?>
    <?php
    if (isset($_SESSION["delete"])) {
    ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
            ?>
        </div>
    <?php
    }
    ?>
    <table class="table table-bordered" id="tables">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Author</th>
                <th>Subtitle</th>
                <th>Genre</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/database.php");
            $sql = "SELECT * FROM novels where users_id = $_SESSION[userid]";
            $result = mysqli_query($conn, $sql);
            $index = 1;
            while ($row = mysqli_fetch_array($result)) {
                $novel_id = $row['id'];
            ?>
                <tr>
                    <td><?php echo $index;
                        $index++; ?></td>
                    <td width="16%"><?php echo $row["title"]; ?></td>
                    <td><?php echo $_SESSION["firstname"] . ' ' . $_SESSION["lastname"]; ?></td>

                    <td width="13%"><?php echo $row["subtitle"]; ?></td>
                    <td width="14%"><?php
                                    $genre_show = $conn->query("SELECT * FROM  genre WHERE novel_id = '$novel_id'");
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

                                    ?></td>
                    <td class="<?php echo $row["status"] == 'PUBLISHED' ? 'text-success' : ($row["status"] == 'Pending' ? 'text-info' : ($row["status"] == 'Revision' ? 'text-warning' : ($row["status"] == 'Denied' ? 'text-danger' : ''))) ?>"><?php echo $row["status"]; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-sm"><i class="fa fa-book"></i> Novel Profile</a>
                        <?php if ($row['status'] != 'PUBLISHED') : ?>
                            <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <?php endif; ?>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#audit_trail<?= $row['id'] ?>"><i class="fa fa-history"></i> Audit Trail</button>
                        <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Drop</a>
                    </td>
                </tr>
                <?php $audit = joinTable('audit_trail', [['novels', 'novels.id', 'audit_trail.novel_id'], ['users', 'users.users_id', 'audit_trail.users_id'], ['profiles', 'profiles.users_id', 'users.users_id']], ['novels.id' => $row['id']]);
                // print_r($audit);
                ?>
                <div class="modal fade" id="audit_trail<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" style="font-weight: bold;" id="exampleModalLabel"><i class="fa fa-history"></i> Audit Trail</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5 py-3" style="height: 460px; overflow-x:auto;">
                                <!-- Section: Timeline -->
                                <section class="">
                                    <ul class="timeline-with-icons">
                                        <?php foreach ($audit as $trail) : ?>

                                            <?php
                                            if ($trail['audit_status'] == $status_enum[4]) {
                                                $icon = "fa fa-upload";
                                                $description = "Author" . ' ' . $description_enum[4];
                                                $color = "bg-primary";
                                                $user = "Published by: " . $trail['users_username'];
                                            } else if ($trail['audit_status'] == $status_enum[2]) {
                                                $icon = "fa fa-history";
                                                $description = "Editor " . $description_enum[2];
                                                $color = "bg-warning";
                                                $user = "Revised Requested by: " . $trail['firstname'] . ' ' . $trail['lastname'];
                                            } else if ($trail['audit_status'] == $status_enum[3]) {
                                                $icon = "fa fa-thumbs-up";
                                                $description = "Editor " . $description_enum[3];
                                                $color = "bg-success";
                                                $user = "Approved by: " . $trail['firstname'] . ' ' . $trail['lastname'];
                                            } else if ($trail['audit_status'] == $status_enum[5]) {
                                                $icon = "fa fa-times";
                                                $description = "Admin " . $description_enum[5];
                                                $color = "bg-danger";
                                                $user = "Rejected by: " . $trail['users_username'];
                                            } else if ($trail['audit_status'] == $status_enum[1]) {
                                                $icon = "fa fa-check";
                                                $description = "Author " . $description_enum[1];
                                                $color = "bg-info";
                                                $user = "Submitted by: " . $trail['firstname'] . ' ' . $trail['lastname'];
                                            }
                                            ?>
                                            <li class="timeline-item mb-5">
                                                <span class="timeline-icon <?php echo $color ?>">
                                                    <i class="<?php echo $icon ?> text-white fa-sm fa-fw"></i>
                                                </span>

                                                <h5 class="fw-bold"><?php echo $description ?></h5>

                                                <p class="text-muted mb-2 fw-bold"><?php echo date('M d, Y h:i A', strtotime($trail['audit_datetime'])); ?></p>
                                                <p class="text-muted mb-2">
                                                    <?php echo $user; ?>
                                                </p>
                                                <?php $comment_now = find_where('comments', ['audit_trail_id' => $trail['audit_trail_id']]);
                                                if (!empty($comment_now)) :
                                                    echo '<div class="border rounded p-2">';
                                                    echo '<div class="d-flex justify-content-between"><p class="m-0 text-bold">Commented</p><button style="font-size:13px" class="btn m-0 p-0 comment_view" audit-id="' . $row['id'] . '" comment-id="' . $trail['audit_trail_id'] . '" >View</button></div>';
                                                    foreach ($comment_now as $cm) :
                                                ?>
                                                        <p class="mb-2" style="font-size:13px">-<?= $cm['comments_text'] ?></p>
                                                <?php endforeach;
                                                    echo '</div>';
                                                endif;
                                                ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </section>
                                <!-- Section: Timeline -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary main-close" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-custom modal-close col-3 p-3 rounded border shadow bg-white d-none" id="comments_<?= $row['id'] ?>">
                    <p class="text-bold m-0 mb-1 bg-white" style="z-index:9"><i class="fa fa-message"></i> Comments</p>
                    <div class="scroll_comment">
                        <?php
                        $comment_audit = joinTable('comments', [['audit_trail', 'audit_trail.audit_trail_id', 'comments.audit_trail_id'], ['users', 'users.users_id', 'audit_trail.users_id'], ['profiles', 'profiles.users_id', 'users.users_id']], ['audit_trail.novel_id' => $row['id']]);
                        foreach ($comment_audit as $comment) :
                        ?>
                            <div id="audit_trail_<?= $comment['audit_trail_id'] ?>" class="border p-2 rounded mb-2 font-bold" style="font-size:13px"><?= !empty($comment['firstname']) ? $comment['firstname'] . ' ' . $comment['lastname'] : $comment['users_username'] ?>: <p style="font-weight:400 !important"> <?= $comment['comments_text'] ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </tbody>
    </table>

</div>
<?php require_once('footer_audit.php') ?>