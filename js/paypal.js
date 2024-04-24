$(document).ready(function () {
    var novel_id = $('#novel_id').val();
    var author_id = $('#author_id').val();

    paypal.Buttons({
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: `${$('#payment_amount').val()}`,
                        currency_code: 'PHP'
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                $.ajax({
                    url: '../novel_arch/ajax/paypal.php',
                    type: 'POST',
                    data: {
                        payment: true,
                        name: $('#name').val(),
                        isLogin: $('#isLogin').val(),
                        users_id: $('#users_id').val(),
                        anonymous: $('#anonymous').val(),
                        author_id: author_id,
                        payment_amount: $('#payment_amount').val(),
                    },
                    success: function (response) {
                        response = JSON.parse(response);
                        if (response.status == 'success') {
                            success(`Successfully donated to ${response.author}`, author_id, novel_id);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        },
        onError: function (error) {
            console.log(error);
        }
    }).render('#paypal-button-container');

    function success(message, id, id2) {
        Swal.fire({
            title: 'Success',
            text: message,
            icon: 'success',
            confirmButtonText: 'Yes',
            cancelButtonText: false
        }).then(function (result) {
            if (result.isConfirmed) {
                window.location.href = `../novel_arch/profile_donate.php?users_id=${id}&novel_id=${id2}`;
            }
        })
    }

    function failed(message) {
        Swal.fire({
            title: 'Failed',
            text: message,
            icon: 'warning',
            confirmButtonText: 'Okay',
            cancelButtonText: false
        })
    }
});
