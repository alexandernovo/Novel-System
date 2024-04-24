
$(document).ready(function () {
    // Keep track of the currently open comments
    var openComments = null;

    // Event handler for .comment_view clicks
    $('.comment_view').on('click', function (e) {
        e.stopPropagation(); // Stop the click event from reaching the document

        var audit_id = $(this).attr('audit-id');
        var comment_id = $(this).attr('comment-id');

        // Close the currently open comments if any
        if (openComments !== null && openComments.attr('audit-id') !== audit_id) {
            openComments.removeClass('bg-primary text-white');
            openComments.siblings('.comments').addClass('d-none');
            openComments = null;
        }

        // Toggle the visibility of the clicked comments
        $(`#audit_trail_${comment_id}`).addClass('bg-primary text-white');
        $(`#comments_${audit_id}`).toggleClass('d-none');
        openComments = $(`#audit_trail_${comment_id}`);
    });

    // Event handler for clicks outside the .comment_view or .comments
    $(document).on('click', function (e) {
        if (openComments !== null && !openComments.is(e.target) && openComments.has(e.target).length === 0) {
            openComments.removeClass('bg-primary text-white');
            openComments.siblings('.comments').addClass('d-none');
            openComments = null;
        }
    });
    $('.modal-close').on('click', function (e) {
        e.stopPropagation();
    });

    $('.modal-body').on('click', function (e) {
        e.stopPropagation();
    });
    $('body').on('click', function () {
        $('.modal-close').addClass('d-none');
    });

})
