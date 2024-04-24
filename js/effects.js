const $input = $('#image-upload');
const $preview = $('#preview-image');
const $container = $('#image-container');

$input.on('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener('load', function () {
            $preview.attr('src', reader.result);
        });
        reader.readAsDataURL(file);
    }
    else {
        $preview.attr('src', '#');
    }
});

$container.on('dragover', function (e) {
    e.preventDefault();
    $container.addClass('dragover');
});

$container.on('dragleave', function (e) {
    e.preventDefault();
    $container.removeClass('dragover');
});

$container.on('drop', function (e) {
    e.preventDefault();
    $container.removeClass('dragover');
    const file = e.originalEvent.dataTransfer.files[0];
    if (file.type.match(/^image\//)) {
        const reader = new FileReader();
        reader.addEventListener('load', function () {
            $preview.attr('src', reader.result);
        });
        reader.readAsDataURL(file);
    }
});



$(document).ready(function () {
    function hove($id) {
        $(`#${$id}`).css('display', 'block');
    }
});

$(document).ready(function () {
    $('#advance_search').on('click', function (event) {
        event.stopPropagation(); // Prevent the click event from reaching the document level
        $('#advance_div').toggleClass('d-none');

        var $advanceDiv = $('#advance_search');
        var classAttr = $advanceDiv.attr('class');

        if (classAttr.includes('fa-caret-down')) {
            $advanceDiv.removeClass('fa-caret-down');
            $advanceDiv.addClass('fa-caret-up');
        } else if (classAttr.includes('fa-caret-up')) {
            $advanceDiv.removeClass('fa-caret-up');
            $advanceDiv.addClass('fa-caret-down');
        }
    });

    $(document).on('click', function (event) {
        var $advanceDiv = $('#advance_div');
        if (!$advanceDiv.is(event.target) && $advanceDiv.has(event.target).length === 0) {
            var $caret = $('#advance_search');
            $advanceDiv.addClass('d-none');
            $caret.removeClass('fa-caret-up');
            $caret.addClass('fa-caret-down');
        }
    });
});

$(document).ready(function () {
    let timeoutId;

    const search = (event) => {
        event.preventDefault();
        console.log('hey');
        clearTimeout(timeoutId); // Clear the previous timeout 
        timeoutId = setTimeout(function () {
            const form = $('#advance_search_form');

            $.ajax({
                url: "http://localhost/novel_arch/ajax/advance_search.php",
                method: "POST",
                data: new FormData(form[0]),
                dataType: "html", // Expect HTML response
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if ($('#search_now').val() !== '' || $('#author').val() !== '') {
                        $('#search_text').html('<i class="fa fa-search"></i> Search Result');
                    }
                    else {
                        $('#search_text').html('<i class="fa fa-line-chart "></i> Releases')
                    }
                    $("#result").html(response); // Insert HTML response
                },
                error: function (xhr, status, error) { // Handle error status, xhr object
                    console.log(error);
                },
            });
        }, 500);
    }
    search({ preventDefault: () => { } });
    $('#search_now').on('input', search);
    $('#author').on('input', search);
    // $('input[name="order_by_fig"]').on('change', search);
    // $('input[name="order_by"]').on('change', search);
    // $('input[name="genre"]').on('check', search);
});





$(document).ready(function () {
    $(document).on('mouseenter', '.submit_star', function () {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

            $('#submit_star_' + count).addClass('text-warning');

        }

    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {

            $('#submit_star_' + count).addClass('star-light');

            $('#submit_star_' + count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function () {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submit_star_' + count).removeClass('star-light');

            $('#submit_star_' + count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function () {
        rating_data = $(this).data('rating');
    });

    $('#save_reviews').on('click', function () {
        const $user_review = $('#user_review');
        console.log($user_review.val());
        if ($user_review.val() == '') {
            $('#warning_field').removeClass('d-none');
        } else {
            $('#warning_field').addClass('d-none');
        }

        if (rating_data == 0) {
            $('#warning_star').removeClass('d-none');
        }
        else {
            $('#warning_star').addClass('d-none');
        }

        if ($user_review.val() != '' && rating_data != 0) {
            $.ajax({
                url: "http://localhost/novel_arch/ajax/rate.php",
                method: "POST",
                data: {
                    user_id: $user_review.attr('user-id'),
                    novel_id: $user_review.attr('novel-id'),
                    user_review: $user_review.val(),
                    ratings: rating_data
                },
                success: function (response) {
                    window.location.href = `http://localhost/novel_arch/publish_view.php?id=${$user_review.attr('novel-id')}`;
                },
                error: function (xhr, status, error) { // Handle error status, xhr object
                    console.log(error);
                },
            });
        }
    });


});



$(document).ready(function () {
    $('#donation-link').click(function (event) {
        var linkUrl = $(this).attr('href');

        // Extract the domain from the URL
        var domain = linkUrl.match(/:\/\/(.[^/]+)/)[1];

        // Check if the domain is "localhost" or contains "localhost"
        if (domain.includes('localhost')) {
            // Remove the "localhost/folder/" part from the URL
            var newUrl = linkUrl.replace(/:\/\/localhost\/novel_arch\//, '://');

            // Redirect to the new URL
            window.location.href = newUrl;

            // Prevent the default link behavior
            event.preventDefault();
        }
    });
});




$(document).ready(function () {
    $('#login_form').on('submit', function (event) {
        event.preventDefault();
        const $username = $('#username').val();
        const $password = $('#password').val();
        const $link = $('#link').val();

        const $error_username = $('#error_username');
        const $error_password = $('#error_password');
        console.log('log')
        if ($username != '' || $password != '') {
            $.ajax({
                url: "http://localhost/novel_arch/ajax/login1.php",
                method: "POST",
                data: {
                    username: $username,
                    password: $password
                },
                success: function (response) {
                    console.log(response)
                    if (response.status == 'success') {
                        window.location.href = `http://localhost/novel_arch/${$link}`;
                    }
                    else if (response.status == 'error_username') {
                        $error_username.removeClass('d-none');
                        $error_username.text(response.message);
                    }
                    else if (response.status == 'error_password') {
                        $error_password.removeClass('d-none');
                        $error_password.text(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
            });
        }
    })
});


$(document).ready(function () {
    $('#anonymous').on('change', function () {
        if ($('#name').attr('user-name') == 0) {
            $('#myname').text("Name (Optional)");
            $('#name').removeAttr('readonly');
        } else {
            if ($(this).prop('checked')) {
                $('#myname').text("Name (Optional)");
                $('#name').val("");
                $('#anonymous').val(1);
                $('#name').removeAttr('readonly');
            } else {
                $('#name').val($('#name').attr('user-name'));
                $('#myname').text("Name");
                $('#anonymous').val(0);
                $('#name').attr('readonly', true);
            }
        }

    });
});
