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
            <label class="text-light">Name (Optional)</label>
            <input class="form-control mb-2" type="text" step="0.01" id="name" placeholder="Name">
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