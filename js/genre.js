$(document).ready(function () {
    var index = 2;

    $("#add").on('click', function () {
        var row = $(".row-of-form").clone();
        $(row).removeClass('row-of-form');
        $(".genre", row).attr("name", "custom_genre[]").val('');
        $(".remove", row)
            .show()
            .on("click", function () {
                $(this).closest(".col-md-3").remove(); // Use .col-md-3 as the closest container
            });
        $("#row-cloned").append(row);
        index++;
    });
});
