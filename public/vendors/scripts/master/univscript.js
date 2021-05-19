var table1 = $(".data-table-export").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/master/departements",
    columns: [
        {
            data: "idDepartement",
            name: "idDepartement"
        },
        {
            data: "nom",
            render: function(data, type, row) {
                return (
                    '<a class="card-link text-primary" href="/master/filiere/' +
                    row.idDepartement +
                    '" target="_blank" >' +
                    data +
                    "</a>"
                );
            }
        },
        {
            data: "insertion_notes",
            render: function(data, type, full, meta) {
                return '<span class="pl-5">' + data + "</span>";
            }
        },
        {
            data: "NBfiliere",
            render: function(data, type, full, meta) {
                return '<span class="pl-5">' + data + "</span>";
            }
        },
        {
            data: "NBprofesseurs",
            render: function(data, type, full, meta) {
                return '<span class="pl-5">' + data + "</span>";
            }
        },
        {
            data: "idDepartement",
            render: function(data, type, full, meta) {
                return (
                    '<div class="table-actions pl-1"><a href="#" style="color: #265ed7" onclick="getDepInfo(' +
                    data +
                    ')" data-toggle="modal" data-target="#bd-edit-modal"><i class="icon-copy dw dw-edit2"></i></a> <a href="#" style="color : #e95959" onclick="setDepId(' +
                    data +
                    ')" data-toggle="modal" data-target="#confirmation-modal" type="button"><i class="icon-copy dw dw-delete-3"></i></a></div>'
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
function setDepId(id) {
    document.getElementById("idDep").value = id;
}
function ReloadSelects(id) {
    jQuery.ajax({
        url: "/master/getNewDepartements",
        type: "GET",
        dataType: "json",
        success: function(response) {
            console.log(response);
            jQuery('select[name="' + id + '"]').empty();
            if (id != "ajfildep") {
                $('select[name="' + id + '"]').append(
                    "<option disabled selected>---Sélectionner un département---</option>"
                );
            }
            jQuery.each(response, function(key, value) {
                $('select[name="' + id + '"]').append(
                    '<option value="' +
                        value.idDepartement +
                        '">' +
                        value.nom +
                        "</option>"
                );
            });
        }
    });
}

function ReloadAllSelects(type) {
    if(type!="f")
    {
    ReloadSelects("ajfildep");
    }
    if(type!="s")
    {
    ReloadSelects("semdep");
    jQuery('select[name="semfil"]').empty();
    }
    LoadFixSemester();    
    if(type!="m")
    {
    ReloadSelects("moddep");
    jQuery('select[name="modsem"]').empty();
    jQuery('select[name="modfil"]').empty();
    $('select[name="modfil"]').append(
        "<option disabled selected>---Sélectionner une filiére---</option>"
    );
    }
    if(type!="ma")
    {
    ReloadSelects("matdep");
    jQuery('select[name="matfil"]').empty();
    $('select[name="matfil"]').append(
        "<option disabled selected>---Sélectionner une filiére---</option>"
    );
    jQuery('select[name="matmod"]').empty();
    jQuery('select[name="matsem"]').empty();
    $('select[name="matsem"]').append(
        "<option disabled selected>---Sélectionner un semestre---</option>"
    );
    }
}
function LoadFilieres(depsel, filsel) {
    jQuery('select[name="' + depsel + '"]').on("change", function() {
        var idDep = jQuery(this).val();
        if (idDep) {
            jQuery.ajax({
                url: "/master/getFilieresDep/" + idDep,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="' + filsel + '"]').empty();
                    if (filsel == "modfil" || filsel == "matfil") {
                        $('select[name="' + filsel + '"]').append(
                            "<option disabled selected>---Sélectionner une filiére---</option>"
                        );
                    }
                    jQuery.each(data, function(key, value) {
                        $('select[name="' + filsel + '"]').append(
                            '<option value="' +
                                value.idFiliere +
                                '">' +
                                value.nom +
                                " " +
                                value.niveau +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="' + filsel + '"]').empty();
        }
    });
}
function LoadSemesters(filsel, semsel) {
    jQuery('select[name="' + filsel + '"]').on("change", function() {
        var idFil = jQuery(this).val();
        if (idFil) {
            jQuery.ajax({
                url: "/master/getSemestersFil/" + idFil,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="' + semsel + '"]').empty();
                    if (semsel == "matsem") {
                        $('select[name="' + semsel + '"]').append(
                            "<option disabled selected>---Sélectionner un semestre---</option>"
                        );
                    }
                    jQuery.each(data, function(key, value) {
                        $('select[name="' + semsel + '"]').append(
                            '<option value="' +
                                value.idSemestre +
                                '">'+'S'+
                                value.num +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="' + semsel + '"]').empty();
        }
    });
}
function LoadModules(semsel, modsel) {
    jQuery('select[name="' + semsel + '"]').on("change", function() {
        var idSem = jQuery(this).val();
        if (idSem) {
            jQuery.ajax({
                url: "/master/getModulesSem/" + idSem,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="' + modsel + '"]').empty();
                    jQuery.each(data, function(key, value) {
                        $('select[name="' + modsel + '"]').append(
                            '<option value="' +
                                value.idModule +
                                '">' +
                                value.nom +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="' + modsel + '"]').empty();
        }
    });
}
function LoadFixSemester()
{
    jQuery('select[name="semester[]"]').empty();
    jQuery('select[name="semester[]"]').append('<option value="1">S1</option>');
    jQuery('select[name="semester[]"]').append('<option value="2">S2</option>');
    jQuery('select[name="semester[]"]').append('<option value="3">S3</option>');
    jQuery('select[name="semester[]"]').append('<option value="4">S4</option>');
    jQuery('select[name="semester[]"]').append('<option value="5">S5</option>');
    jQuery('select[name="semester[]"]').append('<option value="6">S6</option>');
    jQuery('select[name="semester[]"]').append('<option value="7">S7</option>');
    jQuery('select[name="semester[]"]').append('<option value="8">S8</option>');
    jQuery('select[name="semester[]"]').append('<option value="9">S9</option>');
    jQuery('select[name="semester[]"]').append('<option value="10">S10</option>');
}
function getDepInfo(id) {
    $.ajax({
        type: "GET",
        url: "/master/departement/" + id,
        dataType: "JSON",
        data: {},
        success: function(response) {
            console.log(response);
            document.getElementById("upnom").value = response[0].nom;
            document.getElementById("upIdDep").value =
                response[0].idDepartement;
            document.getElementById("etatnote").value =
                response[0].insertion_notes;
        }
    });
}
jQuery(document).ready(LoadFilieres("semdep", "semfil"));
jQuery(document).ready(LoadFilieres("moddep", "modfil"));
jQuery(document).ready(LoadSemesters("modfil", "modsem"));
jQuery(document).ready(LoadFilieres("matdep", "matfil"));
jQuery(document).ready(LoadSemesters("matfil", "matsem"));
jQuery(document).ready(LoadModules("matsem", "matmod"));
$("#suppdep").submit(function(e) {
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
            ReloadAllSelects("none");
        }
    });
});
$("#updDep").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            $("#bd-edit-modal").modal("hide");
            table1.ajax.reload();
            ReloadAllSelects("none");
        }
    });
});
$("#ajdep").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            document.getElementById("msgsuccess").innerHTML =
                "Département Ajoutée!";
            document.getElementById("ajdep").reset();
            $("#success-modal").modal("show");
            table1.ajax.reload();
            ReloadAllSelects("none");
        }
    });
});
$("#ajfiliere").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            document.getElementById("msgsuccess").innerHTML =
                "Filière Ajoutée!";
            document.getElementById("ajfiliere").reset();
            $("#success-modal").modal("show");
            ReloadAllSelects("f");
        }
    });
});
$("#affsem").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            document.getElementById("msgsuccess").innerHTML ="Les semestres sont Affectés!";
            ReloadAllSelects("s");
            $("#success-modal").modal("show");
        }
    });
});
$("#ajmodule").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            document.getElementById("msgsuccess").innerHTML = "Module ajouté!";
            document.getElementById("ajmodule").reset();
            $("#success-modal").modal("show");
            ReloadAllSelects("m");
        }
    });
});
$("#ajmatiere").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            document.getElementById("msgsuccess").innerHTML =
                "Matière ajoutée!";
            document.getElementById("ajmatiere").reset();
            $("#success-modal").modal("show");
            ReloadAllSelects("ma");
        }
    });
});
