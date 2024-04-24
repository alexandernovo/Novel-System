<?php require_once('header.php');
$users_id = $_SESSION['userid'];

$query = "SELECT * FROM donations WHERE author='$users_id' OR donator='$users_id' ORDER BY date_donate DESC";


$result = mysqli_query($conn, $query);
?>
<div class="container my-4 p-0">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-bold d-flex align-items-center"><i class="fa fa-donate"></i>Donations Received and Sent <span style="font-size: 11px; margin-left:3px"> (tips: Donating without logging in will not be recorded in your account)</span></h3>
        <!-- <a href="donate_sent.php" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> Donated</a> -->
    </div>
    <table class="table table-bordered" id="tables">
        <thead>
            <tr>
                <th>No.</th>
                <th>Donated By</th>
                <th>Donated To</th>
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
                    <td><?php
                        if ($fetch['donator'] == $_SESSION['userid']) {
                            echo 'You';
                        } else {
                            if ($fetch['donator'] != null) {
                                if (!empty($fetch['name'])) {
                                    echo $fetch['name'];
                                } else {
                                    $name = first('profiles', ['users_id' => $fetch['donator']]);
                                    echo $name['firstname'] . ' ', $name['lastname'];
                                }
                            } else {
                                echo $fetch['name'];
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($fetch['author'] == $_SESSION['userid']) {
                            echo 'You';
                        } else {
                            $name_author = first('profiles', ['users_id' => $fetch['author']]);
                            echo $name_author['firstname'] . ' ' . $name_author['lastname'];
                        }
                        ?>
                    </td>
                    <td><?= $fetch['amount'] ?></td>
                    <td>
                        <?php if ($fetch['donator'] == $_SESSION['userid']) { ?>
                            Sent
                        <?php } else { ?>
                            Received
                        <?php } ?>
                    </td>
                    <td><?php echo date('M d, Y, h:i:s', strtotime($fetch['date_donate'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php require_once('footer.php'); ?>