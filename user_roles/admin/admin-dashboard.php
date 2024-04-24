<?php
require("../database.php");
require_once('header.php')
?>
<div class="container my-3">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="h3 text-bold mb-3"><i class="fa fa-user" /></i> User Controls</h3>
        <button type="button" class="btn btn-primary btn-sm px-4" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus-circle"></i>Admin</button>
    </div>

    <table class="table" id="tables">
        <thead>
            <tr>
                <td>Username</td>
                <td>Role</td>
                <td>Status</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = $conn->query("SELECT * FROM users");
            while ($row = $sql->fetch_assoc()) {
                if ($row['users_id'] != $_SESSION['userid']) :
            ?>
                    <tr>
                        <td><?php echo $row['users_username'] ?></td>
                        <td><?php echo $row['users_role'] ?></td>
                        <td>
                            <?php
                            if ($row['users_role'] === "ADMIN") {
                                echo 'N/A';
                            } else {
                                echo !empty($row['users_status']) ? $row['users_status'] : 'No Request';
                            }
                            ?>
                        </td>

                        <td>
                            <?php
                            $role = $row['users_role'];
                            $status = $row['users_status'];

                            $canPromote = ($role === 'AUTHOR' || $role === 'EDITOR' || $role == 'ADMIN');
                            $promoteAction = $canPromote ? 'demote' : 'promote';
                            ?>

                            <a class="btn btn-<?php echo $canPromote ? 'danger' : 'secondary'; ?> btn-sm" href="<?php if ($canPromote) {
                                                                                                                    echo "users-actions-reader.php?" . $promoteAction . "=" . $row['users_id'];
                                                                                                                } else {
                                                                                                                    echo "#";
                                                                                                                } ?>">
                                <i class="fa fa-arrow-<?php echo $canPromote ? 'down' : 'down'; ?>"></i> <?php echo $canPromote ? 'Demote' : 'Demote'; ?>
                            </a>

                            <?php
                            $canPromoteReader = ($status === "PENDING" || $role === 'READER' || $role === 'AUTHOR' || $role === 'EDITOR') && $role !== 'ADMIN';
                            $readerPromoteAction = $canPromoteReader ? 'promote' : 'promote';
                            ?>

                            <a class="btn btn-<?php echo $canPromoteReader ? 'success' : 'secondary'; ?> btn-sm" href="  <?php if ($canPromoteReader) {
                                                                                                                                echo "users-actions-reader.php?" . $readerPromoteAction . "=" . $row['users_id'];
                                                                                                                            } else {
                                                                                                                                echo "#";
                                                                                                                            } ?>">

                                <i class="fa fa-arrow-<?php echo $canPromoteReader ? 'up' : 'up'; ?>"></i> <?php echo $canPromoteReader ? 'Promote' : 'Promote'; ?>
                            </a>



                            <?php if ($row["users_role"] == "ADMIN") : ?>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?= $row['users_id'] ?>"><i class="fa fa-edit"></i> Update</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <div class="modal fade" id="updateModal<?= $row['users_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Admin</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="../../includes/manage_admins.php">
                                    <input type="hidden" name="users_id" value="<?= $row['users_id'] ?>">
                                    <div class="modal-body">
                                        <div class="p-4">
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input class="form-control" value="<?= $row['users_email'] ?>" name="email">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Username</label>
                                                <input class="form-control" value="<?= $row['users_username'] ?>" name="username">
                                            </div>
                                            <div class="form-group">
                                                <label>Password <span style="font-size:11px">(Leave blank if dont want to update)</span></label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="update_admin" class="btn btn-primary">Save Admin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                endif;
            }
            ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel"><i class="fa fa-plus-circle me-1"></i>Add Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../../includes/manage_admins.php">
                <div class="modal-body">
                    <div class="p-4">
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input class="form-control" name="email">
                        </div>
                        <div class="form-group mb-3">
                            <label>Username</label>
                            <input class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_admin" class="btn btn-primary">Save Admin</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php require_once('footer.php') ?>