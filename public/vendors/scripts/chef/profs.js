var table1 = $(".data-table-export").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/chef/professeurslist/" + document.getElementById("depA").value,
    columns: [
        {
            data: "idProf",
            name: "idProf"
        },
        {
            data: "nom",
            name: "nom"
        },
        {
            data: "prenom",
            name: "prenom"
        },
        {
            data: "specialite",
            name: "specialite"
        },
        {
            data: "email",
            name: "email"
        },
        {
            data: "tel",
            name: "tel"
        },
        {
            data: "idProf",
            render: function(data, type, full, meta) {
                return (
                    ' <a class="dropdown-item" href="" style="background-color:transparent;" onclick="getProfInfo(' +
                    data +
                    ')" data-toggle="modal" data-target="#bd-example-modal-lg"><i class="dw dw-eye"></i></a>'
                );
            }
        }
    ],
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    columnDefs: [
        {
            targets: "datatable-nosort",
            orderable: false
        }
    ],
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Tout"]
    ],
    language: {
        info: "_START_ à _END_ sur _TOTAL_ éléments",
        emptyTable: "Aucune donnée disponible dans le tableau",
        lengthMenu: "Afficher _MENU_ éléments",
        zeroRecords: "Aucun élément correspondant trouvé",
        processing: "Traitement...",
        infoEmpty: "Affichage de 0 à 0 sur 0 éléments",
        loadingRecords: "Chargement...",
        infoFiltered: "(filtrés depuis un total de _MAX_ éléments)",
        search: "Rechercher:",
        searchPlaceholder: "Rechercher",
        paginate: {
            next: '<i class="ion-chevron-right"></i>',
            previous: '<i class="ion-chevron-left"></i>'
        }
    },
    dom:
        '<"top"<"left-col"B><"right-col"f>>rt<"row"<"col-sm-4"l><"col-sm-8"p>>',
    buttons: [
        {
            extend: "print",
            text: '<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimer',
            exportOptions: {
                columns: "th:not(:last-child)"
            }
        },
        {
            extend: "excel",
            text: '<i class="icon-copy fa fa-file-excel-o"></i>&nbsp;&nbspExcel',
            exportOptions: {
                columns: "th:not(:last-child)"
            }
        }
    ]
});

function getProfInfo(id) {
    document.getElementById("matieres").innerHTML = "";
    $.ajax({
        type: "GET",
        url: "/chef/professeur/" + id,
        dataType: "JSON",
        data: {},
        success: function(response) {
            console.log(response);
            document.getElementById("nom").innerHTML = response.prof[0].nom;
            document.getElementById("prenom").innerHTML =
                response.prof[0].prenom;
            document.getElementById("genre").innerHTML = response.prof[0].genre;
            document.getElementById("datenais").innerHTML =
                response.prof[0].dateNaissance;
            document.getElementById("situation").innerHTML =
                response.prof[0].situationFamiliale;
            document.getElementById("nationalite").innerHTML =
                response.prof[0].nationalite;
            document.getElementById("LieuNaissance").innerHTML =
                response.prof[0].lieuNaissance;
            document.getElementById("cin").innerHTML = response.prof[0].cin;
            document.getElementById("adresse").innerHTML =
                response.prof[0].adressePersonnele;
            document.getElementById("tel").innerHTML = response.prof[0].tel;
            document.getElementById("email").innerHTML = response.prof[0].email;
            document.getElementById("emailins").innerHTML =
                response.prof[0].emailInstitutionne;
            document.getElementById("specialite").innerHTML =
                response.prof[0].specialite;
            if (response.matieres.length > 0) {
                response.matieres.forEach(myFunction);
            } else {
                document.getElementById("matieres").innerHTML =
                    "Aucune Matiere";
            }
            function myFunction(item, index) {
                document.getElementById("matieres").innerHTML +=
                    item.nom + "<br>";
            }
        }
    });
}
jQuery(document).ready(function() {
    jQuery('select[name="profdet"]').on("change", function() {
        var idProf = jQuery(this).val();
        var idDep = document.getElementById("depA").value;
        if (idProf) {
            jQuery.ajax({
                url: "/chef/professeur/getMatiere/" + idProf + "/" + idDep,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="matiere"]').empty();
                    jQuery.each(data, function(key, value) {
                        $('select[name="matiere"]').append(
                            '<option value="' +
                                value.idMatiere +
                                '">' +
                                value.nom +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="matiere"]').empty();
        }
    });
});
$("#affecter").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            $("#success-modal-aff").modal("show");
            if (document.getElementById("profdet").value == data[0].idProf) {
                jQuery('select[name="matiere"]').empty();
                jQuery.each(data, function(key, value) {
                    $('select[name="matiere"]').append(
                        '<option value="' +
                            value.idMatiere +
                            '">' +
                            value.nom +
                            "</option>"
                    );
                });
            } else {
                jQuery.ajax({
                    url:
                        "/chef/professeur/getMatiere/" +
                        document.getElementById("profdet").value +
                        "/" +
                        document.getElementById("depA").value,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        jQuery('select[name="matiere"]').empty();
                        jQuery.each(response, function(key, value) {
                            $('select[name="matiere"]').append(
                                '<option value="' +
                                    value.idMatiere +
                                    '">' +
                                    value.nom +
                                    "</option>"
                            );
                        });
                    }
                });
            }
        },
        error: function(jqXHR, exception) {
            var msg = "";
            if (jqXHR.status === 0) {
                msg = "Not connect.\n Verify Network.";
            } else if (jqXHR.status == 404) {
                msg = "Requested page not found. [404]";
            } else if (jqXHR.status == 500) {
                msg = "Internal Server Error [500].";
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error.";
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Uncaught Error.\n" + jqXHR.responseText;
            }
            alert(msg);
        }
    });
});
$("#detacher").submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: form.serialize(),
        success: function(data) {
            $("#success-modal-det").modal("show");
            jQuery('select[name="matiere"]').empty();
            jQuery.each(data, function(key, value) {
                $('select[name="matiere"]').append(
                    '<option value="' +
                        value.idMatiere +
                        '">' +
                        value.nom +
                        "</option>"
                );
            });
        }
    });
});
