<?php require_once('header.php');
require_once('../../functions/config.php');
// Default values for the dropdown filter
$statusValues = ['Pending', 'PUBLISHED'];

// Check if the 'status_list' parameter is set and update $statusValues accordingly
if (isset($_GET['status_list'])) {
    if ($_GET['status_list'] === 'Pending') {
        $statusValues = ['Pending'];
    } else if ($_GET['status_list'] === 'PUBLISHED') {
        $statusValues = ['PUBLISHED'];
    }
}

$statusList = "'" . implode("','", $statusValues) . "'";
?>

<div class="container my-4">
    <div class="d-flex justify-content-between my-4">
        <h2 class="h2 text-bold"><i class="fa fa-book"></i> Novels For Approval</h2>
        <div>
            <?php
            $status = first('users', ['users_id' => $_SESSION['userid']]);

            if ($status['users_role'] === "EDITOR") {
            ?>
                <a href="<?php echo $status['users_status'] == 'PENDING' ? '#' : 'revert_author.php' ?>" class="btn btn-sm px-4 <?php echo $status['users_status'] == 'PENDING' ? 'btn-secondary' : 'btn-primary' ?>"><?php echo $status['users_status'] == 'PENDING ' ? 'Requesting to Revert'  : 'Revert to Author' ?></a>
            <?php

            } else { ?>
                <button class="btn btn-success">You are now an Author</button>
            <?php } ?>
        </div>
    </div>
    <div class="row mx-auto my-4 g-0">
        <form method="GET">
            <div class="col-3 offset-9 d-flex">
                <select class="form-select me-1" name="status_list">
                    <option value="All" <?php echo isset($_GET['status_list']) && $_GET['status_list'] === 'All' || !isset($_GET['status_list']) ? 'selected' : ''; ?>>All</option>
                    <option value="Pending" <?php echo isset($_GET['status_list']) && $_GET['status_list'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="PUBLISHED" <?php echo isset($_GET['status_list']) && $_GET['status_list'] === 'PUBLISHED' ? 'selected' : ''; ?>>Published</option>

                </select>
                <button type="submit" class="btn btn-primary d-flex align-items-center"><i class="fa fa-filter me-1"></i> Filter</button>
            </div>
        </form>
    </div>


    <table class="table" id="tables">
        <thead>
            <tr>
                <td class="d-none"></td>
                <td>Updated Status</td>
                <td>Novel</td>
                <td>Author</td>
                <td>Status</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_id = $_SESSION['userid'];
            $sql = "SELECT * FROM novels as n INNER JOIN profiles as p ON n.users_id=p.users_id WHERE n.status IN ($statusList) AND n.users_id != '$user_id' ORDER BY n.id DESC";
            $result = $conn->query($sql);
            $index = 1;
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td class="d-none"><?php echo $index;
                                        $index++; ?></td>
                    <td><?php echo $row['novel_added'] ?></td>
                    <td><?php echo $row['title'] ?></td>
                    <td><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></td>
                    <td class="<?php echo $row['status'] === "Pending" ? 'text-info' : 'text-success' ?>"><?php echo $row['status'] ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="view-novel.php?view=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i> View</a>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#audit_trail<?= $row['id'] ?>"><i class="fa fa-history"></i> Audit Trail</button>
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
                                                <p class="text-muted">
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
                                <button type="button" class="btn btn-secondary  main-close" data-bs-dismiss="modal">Close</button>
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
<?php require_once('footer.php') ?>