<?php require_once('header.php');
$users_id = $_SESSION['userid'];

$query = "SELECT * FROM users INNER JOIN donations ON users.users_id=donations.author WHERE donations.donator='$users_id' ORDER BY date_donate DESC";


$result = mysqli_query($conn, $query);
?>
<div class="container my-4 p-0">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-bold"><i class="fa fa-donate"></i>Donations Sent</h3>
        <a href="donated.php" class="btn btn-secondary btn-sm px-3"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <table class="table table-bordered" id="tables">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 1;
            while ($fetch = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $index;
                        $index++; ?></td>
                    <td><?= $fetch['users_username'] ?></td>
                    <td><?= $fetch['amount'] ?></td>
                    <td>Sent</td>
                    <td><?php echo date('M d, Y, h:i:s a', strtotime($fetch['date_donate'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php require_once('footer.php'); ?>