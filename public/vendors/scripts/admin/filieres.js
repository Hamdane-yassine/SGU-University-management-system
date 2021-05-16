$(document).ready(function() {
    $("#addexcel").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var formData = new FormData();
        formData.append('uploadedFile', $('#uploadedFile')[0].files[0],$('#uploadedFile')[0].files[0].name);
        formData.append('filiere', $('#filiere').val());
        formData.append('_token', $('#csrftoken').val());
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: formData, // serializes the form's elements.
            processData : false,
            contentType : false,
            success: function(data) {
                $("#success-modal").modal("show");
            },
            error: function(err) {

            }
        });
    });
})