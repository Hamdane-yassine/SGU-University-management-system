var table1 = $(".data-table-export").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/admin/EtudiantsList/" + document.getElementById("idFiliere").value,
    columns: [
        {
            data: "apogee",
            name: "apogee"
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
            data: "cne",
            name: "cne"
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
            data: "idEtudiant",
            render: function(data, type, full, meta) {
                return (
                    '<div class="table-actions pl-1"><a href="#" style="color: #265ed7" onclick="getEtudiantIn(' +
                    data +
                    ')" data-toggle="modal" data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a> <a href="#" style="color : #e95959" onclick="setIdEtudiant(' +
                    data +
                    ')" data-toggle="modal" data-target="#confirmation-modal" type="button"><i class="icon-copy dw dw-delete-3"></i></a></div>'
                );
            }
        },
        {
            data: "idEtudiant",
            render: function(data, type, full, meta) {
                return (
                    ' <a class="dropdown-item" href="" style="background-color:transparent;" onclick="getEtudiantInfo(' +
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
                columns: ":not(.datatable-nosort)"
            }
        },
        {
            extend: "excel",
            text: '<i class="icon-copy fa fa-file-excel-o" aria-hidden="true">&nbsp;&nbspExcel</i>',
            exportOptions: {
                columns: ":not(.datatable-nosort)"
            }
        }
    ]
});

function getEtudiantInfo(id) {
    $.ajax({
        type: "GET",
        url: "/admin/Etudiant/" + id,
        dataType: "JSON",
        data: {},
        success: function(response) {
            document.getElementById("nom").innerHTML = response[0].nom;
            document.getElementById("prenom").innerHTML = response[0].prenom;
            document.getElementById("apogee").innerHTML = response[0].apogee;
            document.getElementById("cne").innerHTML = response[0].cne;
            document.getElementById("genre").innerHTML = response[0].genre;
            document.getElementById("datenais").innerHTML =
                response[0].dateNaissance;
            document.getElementById("situation").innerHTML =
                response[0].situationFamiliale;
            document.getElementById("nationalite").innerHTML =
                response[0].nationalite;
            document.getElementById("LieuNaissance").innerHTML =
                response[0].lieuNaissance;
            document.getElementById("cin").innerHTML = response[0].cin;
            document.getElementById("cinpere").innerHTML = response[0].cinPere;
            document.getElementById("cinmere").innerHTML = response[0].cinMere;
            document.getElementById("adresse").innerHTML =
                response[0].adressePersonnele;
            document.getElementById("tel").innerHTML = response[0].tel;
            document.getElementById("email").innerHTML = response[0].email;
            document.getElementById("emailins").innerHTML =
                response[0].emailInstitutionne;
            document.getElementById("annebac").innerHTML =
                response[0].anneeDuBaccalaureat;
            document.getElementById("couv").innerHTML =
                response[0].regimeDeCovertureMedicale;
        }
    });
}

function getEtudiantIn(id) {
    reinsup();
    $.ajax({
        type: "GET",
        url: "/admin/Etudiant/" + id,
        dataType: "JSON",
        data: {},
        success: function(response) {
            document.getElementById("innom").value = response[0].nom;
            document.getElementById("inprenom").value = response[0].prenom;
            document.getElementById("inapogee").value = response[0].apogee;
            document.getElementById("incne").value = response[0].cne;
            document.getElementById("ingenre").value = response[0].genre;
            document.getElementById("indatenais").value =
                response[0].dateNaissance;
            document.getElementById("insituation").value =
                response[0].situationFamiliale;
            document.getElementById("innationalite").value =
                response[0].nationalite;
            document.getElementById("inLieuNaissance").value =
                response[0].lieuNaissance;
            document.getElementById("incin").value = response[0].cin;
            document.getElementById("incinpere").value = response[0].cinPere;
            document.getElementById("incinmere").value = response[0].cinMere;
            document.getElementById("inadresse").value =
                response[0].adressePersonnele;
            document.getElementById("intel").value = response[0].tel;
            document.getElementById("inemail").value = response[0].email;
            document.getElementById("inemailins").value =
                response[0].emailInstitutionne;
            document.getElementById("inannebac").value =
                response[0].anneeDuBaccalaureat;
            document.getElementById("incouv").value =
                response[0].regimeDeCovertureMedicale;
            document.getElementById("inIdEtudiant").value =
                response[0].idEtudiant;
        }
    });
}

function setIdEtudiant(id) {
    document.getElementById("idEtudiant").value = id;
}
$("#suppetud").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            $("#confirmation-modal").modal("hide");
            table1.ajax.reload();
        }
    });
});
$("#updEtud").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            $("#bd-edit-modal").modal("hide");
            reinsup();
            table1.ajax.reload();
        },
        error: function(err) {
            if (err.status == 422) {
                // when status code is 422, it's a validation issue
                reinsup();
                $.each(err.responseJSON.errors, function(key, value) {
                    if (key == "inemailins") {
                        document.getElementById(
                            "inmsgerrmailins"
                        ).innerHTML = value;
                        document
                            .getElementById("inemailins")
                            .classList.add("is-invalid");
                    }
                    if (key == "inemail") {
                        document.getElementById(
                            "inmsgerrmail"
                        ).innerHTML = value;
                        document
                            .getElementById("inemail")
                            .classList.add("is-invalid");
                    }
                    if (key == "incin") {
                        document.getElementById(
                            "inmsgerrcin"
                        ).innerHTML = value;
                        document
                            .getElementById("incin")
                            .classList.add("is-invalid");
                    }
                    if (key == "incne") {
                        document.getElementById(
                            "inmsgerrcne"
                        ).innerHTML = value;
                        document
                            .getElementById("incne")
                            .classList.add("is-invalid");
                    }
                    if (key == "inapogee") {
                        document.getElementById(
                            "inmsgerrapog"
                        ).innerHTML = value;
                        document
                            .getElementById("inapogee")
                            .classList.add("is-invalid");
                    }
                });
            }
        }
    });
});

function reins() {
    document.getElementById("ajoutetud").reset();
    $("html, body").animate(
        {
            scrollTop: 0
        },
        "fast"
    );
    document.getElementById("msgerrmailins").innerHTML = "";
    document.getElementById("ajemailins").classList.remove("is-invalid");
    document.getElementById("msgerrmail").innerHTML = "";
    document.getElementById("ajemail").classList.remove("is-invalid");
    document.getElementById("msgerrcin").innerHTML = "";
    document.getElementById("ajcin").classList.remove("is-invalid");
    document.getElementById("msgerrcne").innerHTML = "";
    document.getElementById("ajcne").classList.remove("is-invalid");
    document.getElementById("msgerrapog").innerHTML = "";
    document.getElementById("ajapogee").classList.remove("is-invalid");
}
function reinscheck() {
    document.getElementById("msgerrmailins").innerHTML = "";
    document.getElementById("ajemailins").classList.remove("is-invalid");
    document.getElementById("msgerrmail").innerHTML = "";
    document.getElementById("ajemail").classList.remove("is-invalid");
    document.getElementById("msgerrcin").innerHTML = "";
    document.getElementById("ajcin").classList.remove("is-invalid");
    document.getElementById("msgerrcne").innerHTML = "";
    document.getElementById("ajcne").classList.remove("is-invalid");
    document.getElementById("msgerrapog").innerHTML = "";
    document.getElementById("ajapogee").classList.remove("is-invalid");
}
function reinsup() {
    document.getElementById("inmsgerrmailins").innerHTML = "";
    document.getElementById("inemailins").classList.remove("is-invalid");
    document.getElementById("inmsgerrmail").innerHTML = "";
    document.getElementById("inemail").classList.remove("is-invalid");
    document.getElementById("inmsgerrcin").innerHTML = "";
    document.getElementById("incin").classList.remove("is-invalid");
    document.getElementById("inmsgerrcne").innerHTML = "";
    document.getElementById("incne").classList.remove("is-invalid");
    document.getElementById("inmsgerrapog").innerHTML = "";
    document.getElementById("inapogee").classList.remove("is-invalid");
}
$("#ajoutetud").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            $("#success-modal").modal("show");
            reins();
        },
        error: function(err) {
            if (err.status == 422) {
                // when status code is 422, it's a validation issue
                reinscheck();
                $.each(err.responseJSON.errors, function(key, value) {
                    if (key == "ajemailins") {
                        document.getElementById(
                            "msgerrmailins"
                        ).innerHTML = value;
                        document
                            .getElementById("ajemailins")
                            .classList.add("is-invalid");
                    }
                    if (key == "ajemail") {
                        document.getElementById("msgerrmail").innerHTML = value;
                        document
                            .getElementById("ajemail")
                            .classList.add("is-invalid");
                    }
                    if (key == "ajcin") {
                        document.getElementById("msgerrcin").innerHTML = value;
                        document
                            .getElementById("ajcin")
                            .classList.add("is-invalid");
                    }
                    if (key == "ajcne") {
                        document.getElementById("msgerrcne").innerHTML = value;
                        document
                            .getElementById("ajcne")
                            .classList.add("is-invalid");
                    }
                    if (key == "ajapogee") {
                        document.getElementById("msgerrapog").innerHTML = value;
                        document
                            .getElementById("ajapogee")
                            .classList.add("is-invalid");
                    }
                });
            }
        }
    });
});

function ren() {
    table1.ajax.reload();
    $("html, body").animate(
        {
            scrollTop: 0
        },
        "fast"
    );
}
