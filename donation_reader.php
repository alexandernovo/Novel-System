<?php require_once('header3.php');
$author = first('users', ['users_id' => $_GET['users_id']]);
?>
<div class="reviews col-4 p-5 mx-auto mt-5 mb-5">
    <div class="row mx-auto mb-3">
        <h5 class="text-light">
            <i class="fa fa-donate"></i>
            Donating to <?= $author['users_username'] ?>
        </h5>
    </div>
    <div class="row mx-auto mb-3">
        <div class="form-group">
            <input type="hidden" value="<?php echo $_GET['novel_id'] ?>" id="novel_id">
            <input type="hidden" value="<?php echo $_GET['users_id'] ?>" id="author_id">
            <label class="text-light" id="myname"><?php echo isset($_SESSION['userid']) ? 'Name' : 'Name (Optional)' ?></label>
            <input type="hidden" name="users_id" id="users_id" value="<?php echo isset($_SESSION['userid']) ? $_SESSION['userid'] : 0 ?>">
            <input type="hidden" id="isLogin" value="<?php echo isset($_SESSION['userid']) ? 1 : 2 ?>" />
            <input class="form-control mb-2" type="text" step="0.01" id="name" user-name="<?php echo isset($_SESSION['userid']) ?  $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] : 0 ?>" placeholder="Name" <?php echo isset($_SESSION['userid']) ? 'readonly' : '' ?> value="<?php echo isset($_SESSION['userid']) ? $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] : '' ?>">
            <?php if (isset($_SESSION['userid'])) { ?>
                <div class="form-check d-flex justify-content-end align-items-center">
                    <input class="form-check-input p-1" type="checkbox" value="0" id="anonymous">
                    <label class="form-check-label text-light mt-1 ms-1" style="font-size:12px" for="anonymous">
                        Anonymous
                    </label>
                </div>
            <?php } else { ?>
                <input type="hidden" value="1" id="anonymous">
            <?php } ?>
            <label class="text-light">Donation Amount (Php)</label>
            <input class="form-control" type="number" step="0.01" id="payment_amount" placeholder="Amount">
        </div>
    </div>
    <div class="row mx-auto">
        <div class="form-group">
            <div class="row mx-auto">
                <div id="paypal-button-container" class="px-0"></div>
            </div>
        </div>
    </div>
</div>
<?php require_once('paymentfooter.php'); ?>