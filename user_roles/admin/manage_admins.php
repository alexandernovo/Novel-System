<?php
require_once('header.php');
$admins = find_where('users', ['users_role' => 'ADMIN']);
?>
<div class="container my-3">
    <div class="d-flex justify-content-between mb-2">
        <h3 style="font-weight:bold"><i class="fa fa-user"></i> Manage Admins</h3>
        <button type="button" class="btn btn-primary btn-sm px-4" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus-circle"></i>Add</button>
    </div>
    <table class="table" id="tables">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin) :
                if ($admin['users_id'] != $_SESSION['userid']) :
            ?>
                    <tr>
                        <td><?= $admin['users_username'] ?></td>
                        <td><?= $admin['users_email'] ?></td>
                        <td><?= $admin['users_role'] ?></td>
                        <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?= $admin['users_id'] ?>"><i class="fa fa-edit"></i> Update</button></td>
                        <td>
                            <a href="../../includes/manage_admins.php?delete&users_id=<?= $admin['users_id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a></td>
                    </tr>

                    <div class="modal fade" id="updateModal<?= $admin['users_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Admin</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="../../includes/manage_admins.php">
                                    <input type="hidden" name="users_id" value="<?= $admin['users_id'] ?>">
                                    <div class="modal-body">
                                        <div class="p-4">
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input class="form-control" value="<?= $admin['users_email'] ?>" name="email">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Username</label>
                                                <input class="form-control" value="<?= $admin['users_username'] ?>" name="username">
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
            endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Add Admin</h1>
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
<?php
require_once('footer.php');
?>