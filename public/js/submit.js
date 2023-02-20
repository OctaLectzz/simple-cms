function submit(event) {
    event.preventDefault();

    $('#submit');

    $("#confirm").on("click", function() {
        const confirmButton = $(this);
        confirmButton.prop("disabled", true);

        $.ajax({
            url: event.target.action,
            type: event.target.method,
            data: $(event.target).serialize()
        }).done(function (res) {
            confirmButton.prop("disabled", false);
        }).fail(function (err) {
            confirmButton.prop("disabled", false);
        });
    })

}