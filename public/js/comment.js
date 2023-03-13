// Delete Comment
function destroy(event) {
    event.preventDefault();

    $('#delete-modal').modal('show');

    $("#confirm-delete").on("click", function() {
        const confirmButton = $(this);
        confirmButton
            .html('<div class="spinner-border spinner-border-sm" role="status"></div> Loading...')
            .prop("disabled", true);

        $.ajax({
            url: event.target.action,
            type: event.target.method,
            data: $(event.target).serialize()
        }).done(function (res) {
            $('#delete-modal').modal('hide');
            confirmButton.html("Delete", false).prop("disabled", false);
            toastr.success(res.success);
            location.reload();
        }).fail(function (err) {
            confirmButton.html("Delete", false).prop("disabled", false);
            toastr.error(res.responseJSON.message);
        });
    })
}

$(document).ready(function() {
    $(".close-modal").click(function() {
        $('#delete-modal').modal('hide');
    })
})




// Submit Comment
$(document).ready(function () {
    $("form").submit(function () {
        $('#comment-button')
            .html('<div class="spinner-border spinner-border-sm" role="status"></div> Loading...')
            .attr("disabled", true);
    });
});

// Submit Like
$(document).ready(function () {
    $("form").submit(function () {
        $('#like-button')
            .attr("disabled", true);
    });
});


$('#add-comment').submit(function(event) {
    // Menghentikan submit form standar
    event.preventDefault();
  
    // Mengirim permintaan AJAX
    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
            location.reload();
        }
    });
});