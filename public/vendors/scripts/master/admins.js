var table1 = $(".data-table-export").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/master/dashboard/adminsdatatable",
    columns: [
        {
            data: "id",
            name: "id"
        },
        {
            data: "name",
            name: "name"
        },
        {
            data: "prenom",
            name: "prenom"
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
            data: "id",
            render: function(data, type, full, meta) {
                return (
                    '<div class="table-actions pl-1"><a href="#" style="color: #265ed7" onclick="getAdminIn(' +
                    data +
                    ')" data-toggle="modal" data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a> <a href="#" style="color : #e95959" onclick="setIdAdmin(' +
                    data +
                    ')" data-toggle="modal" data-target="#confirmation-modal" type="button"><i class="icon-copy dw dw-delete-3"></i></a></div>'
                );
            }
        },
        {
            data: "id",
            render: function(data, type, full, meta) {
                return (
                    ' <a class="dropdown-item" href="" style="background-color:transparent;" onclick="getAdminInfo(' +
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
    dom: '<"top"<"left-col"B><"right-col"f>>rt<"row"<"col-sm-4"l><"col-sm-8"p>>',
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


function setIdAdmin(id) {
    document.getElementById("idAdmin").value = id;
}

function getAdminInfo(id) {
    $.ajax({
        type: "GET",
        url: "/master/admin/" + id,
        dataType: "JSON",
        data: {},
        success: function(response) {
            console.log(response);
            document.getElementById("nom").innerHTML = response.admin[0].nom;
            document.getElementById("prenom").innerHTML =
                response.admin[0].prenom;
            document.getElementById("genre").innerHTML = response.admin[0].genre;
            document.getElementById("datenais").innerHTML =
                response.admin[0].dateNaissance;
            document.getElementById("situation").innerHTML =
                response.admin[0].situationFamiliale;
            document.getElementById("nationalite").innerHTML =
                response.admin[0].nationalite;
            document.getElementById("LieuNaissance").innerHTML =
                response.admin[0].lieuNaissance;
            document.getElementById("cin").innerHTML = response.admin[0].cin;
            document.getElementById("adresse").innerHTML =
                response.admin[0].adressePersonnele;
            document.getElementById("tel").innerHTML = response.admin[0].tel;
            document.getElementById("email").innerHTML = response.admin[0].email;
            document.getElementById("emailins").innerHTML =
                response.admin[0].emailInstitutionne;
            document.getElementById("outrole").innerHTML = "admin";
        }
    });
}
$("#suppadmin").submit(function(e) {
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

function reins() {
    document.getElementById("ajoutAdmin").reset();
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
}

function getAdminIn(id) {
    reinsupd();
    $.ajax({
        type: "GET",
        url: "/master/admin/" + id,
        dataType: "JSON",
        data: {},
        success: function(response) {
            document.getElementById("innom").value = response.admin[0].nom;
            document.getElementById("inprenom").value = response.admin[0].prenom;
            document.getElementById("ingenre").value = response.admin[0].genre;
            document.getElementById("indatenais").value =
                response.admin[0].dateNaissance;
            document.getElementById("insituation").value =
                response.admin[0].situationFamiliale;
            document.getElementById("innationalite").value =
                response.admin[0].nationalite;
            document.getElementById("inLieuNaissance").value =
                response.admin[0].lieuNaissance;
            document.getElementById("incin").value = response.admin[0].cin;
            document.getElementById("inadresse").value =
                response.admin[0].adressePersonnele;
            document.getElementById("intel").value = response.admin[0].tel;
            document.getElementById("inemail").value = response.admin[0].email;
            document.getElementById("inemailins").value =
                response.admin[0].emailInstitutionne;
            document.getElementById("inidAdmin").value = response.admin[0].id;
        }
    });
}
$("#ajoutAdmin").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            reins();
            document.getElementById("msg").innerHTML = "Professeur est ajouté!";
            $("#success-modal").modal("show");
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
                });
            }
        }
    });
});

function reinsupd() {
    document.getElementById("msgerrinmainins").innerHTML = "";
    document.getElementById("inemailins").classList.remove("is-invalid");
    document.getElementById("msgerrinmail").innerHTML = "";
    document.getElementById("inemail").classList.remove("is-invalid");
    document.getElementById("msgerrincin").innerHTML = "";
    document.getElementById("incin").classList.remove("is-invalid");
}

function reinscheck() {
    document.getElementById("msgerrmailins").innerHTML = "";
    document.getElementById("ajemailins").classList.remove("is-invalid");
    document.getElementById("msgerrmail").innerHTML = "";
    document.getElementById("ajemail").classList.remove("is-invalid");
    document.getElementById("msgerrcin").innerHTML = "";
    document.getElementById("ajcin").classList.remove("is-invalid");
}
$("#updAdmin").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            $("#bd-edit-modal").modal("hide");
            reinsupd();
            table1.ajax.reload();
        },
        error: function(err) {
            if (err.status == 422) {
                // when status code is 422, it's a validation issue
                reinsupd();
                $.each(err.responseJSON.errors, function(key, value) {
                    if (key == "inemailins") {
                        document.getElementById(
                            "msgerrinmainins"
                        ).innerHTML = value;
                        document
                            .getElementById("inemailins")
                            .classList.add("is-invalid");
                    }
                    if (key == "inemail") {
                        document.getElementById(
                            "msgerrinmail"
                        ).innerHTML = value;
                        document
                            .getElementById("inemail")
                            .classList.add("is-invalid");
                    }
                    if (key == "incin") {
                        document.getElementById(
                            "msgerrincin"
                        ).innerHTML = value;
                        document
                            .getElementById("incin")
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
