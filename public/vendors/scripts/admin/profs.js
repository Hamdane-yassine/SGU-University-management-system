var table1 = $(".data-table-export").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/admin/professeurslist/" + document.getElementById("idDepart").value,
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
                    '<div class="table-actions pl-1"><a href="#" style="color: #265ed7" onclick="getProfesseurIn(' +
                    data +
                    ')" data-toggle="modal" data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a> <a href="#" style="color : #e95959" onclick="setIdProfesseur(' +
                    data +
                    ')" data-toggle="modal" data-target="#confirmation-modal" type="button"><i class="icon-copy dw dw-delete-3"></i></a></div>'
                );
            }
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
            text: '<i class="icon-copy fa fa-file-excel-o"></i>&nbsp;&nbspExcel',
            exportOptions: {
                columns: ":not(.datatable-nosort)"
            }
        }
    ]
});

function LoadProfs(idDep) {
    jQuery.ajax({
        url: "/admin/getAllProfs/" + idDep,
        type: "GET",
        dataType: "json",
        success: function(data) {
            jQuery('select[name="prof"]').empty();
            jQuery.each(data, function(key, value) {
                $('select[name="prof"]').append(
                    '<option value="' +
                        value.idProf +
                        '">' +
                        value.nom +
                        " " +
                        value.prenom +
                        "</option>"
                );
            });
        }
    });
    jQuery.ajax({
        url: "/admin/getProfDep/" + idDep,
        type: "GET",
        dataType: "json",
        success: function(data) {
            jQuery('select[name="profdet"]').empty();
            jQuery.each(data, function(key, value) {
                $('select[name="profdet"]').append(
                    '<option value="' +
                        value.idProf +
                        '">' +
                        value.nom +
                        " " +
                        value.prenom +
                        "</option>"
                );
            });
        }
    });
}

function setIdProfesseur(id) {
    document.getElementById("idProf").value = id;
}

function getProfInfo(id) {
    document.getElementById("matieres").innerHTML = "";
    $.ajax({
        type: "GET",
        url: "/admin/professeur/" + id,
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
            if (response.prof[0].role == "chefdep") {
                document.getElementById("outrole").innerHTML =
                    "Chef de departement";
            } else {
                document.getElementById("outrole").innerHTML = "Professeur";
            }
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
$("#suppprof").submit(function(e) {
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
            var iddep = document.getElementById("depA").value;
            LoadProfs(iddep);
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
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            document.getElementById("msg").innerHTML = "Professeur affecté!";
            $("#success-modal").modal("show");
            $("html, body").animate(
                {
                    scrollTop: 0
                },
                "fast"
            );
            table1.ajax.reload();
            var iddep = document.getElementById("depA").value;
            LoadProfs(iddep);
        }
    });
});
$("#retirer").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            document.getElementById("msg").innerHTML = "Professeur retirer";
            $("#success-modal").modal("show");
            $("html, body").animate(
                {
                    scrollTop: 0
                },
                "fast"
            );
            table1.ajax.reload();
            var iddep = document.getElementById("depA").value;
            LoadProfs(iddep);
        }
    });
});

function reins() {
    document.getElementById("ajoutprof").reset();
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

function getProfesseurIn(id) {
    reinsupd();
    $.ajax({
        type: "GET",
        url: "/admin/professeur/" + id,
        dataType: "JSON",
        data: {},
        success: function(response) {
            document.getElementById("innom").value = response.prof[0].nom;
            document.getElementById("inprenom").value = response.prof[0].prenom;
            document.getElementById("ingenre").value = response.prof[0].genre;
            document.getElementById("indatenais").value =
                response.prof[0].dateNaissance;
            document.getElementById("insituation").value =
                response.prof[0].situationFamiliale;
            document.getElementById("innationalite").value =
                response.prof[0].nationalite;
            document.getElementById("inLieuNaissance").value =
                response.prof[0].lieuNaissance;
            document.getElementById("incin").value = response.prof[0].cin;
            document.getElementById("inadresse").value =
                response.prof[0].adressePersonnele;
            document.getElementById("intel").value = response.prof[0].tel;
            document.getElementById("inemail").value = response.prof[0].email;
            document.getElementById("inemailins").value =
                response.prof[0].emailInstitutionne;
            document.getElementById("inspecialite").value =
                response.prof[0].specialite;
            document.getElementById("inidProf").value = response.prof[0].idProf;
            if (response.prof[0].role == "chefdep") {
                document.getElementById("role").value = 2;
            } else {
                document.getElementById("role").value = 1;
            }
        }
    });
}
$("#ajoutprof").submit(function(e) {
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
$("#updProf").submit(function(e) {
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
