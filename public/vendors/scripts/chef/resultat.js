$("#envres").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            document.getElementById('msg').innerHTML="Le résultat est envoyé!";
            $("#success-modal").modal("show");
        },
        error: function(err) {
            
        }
    });
});