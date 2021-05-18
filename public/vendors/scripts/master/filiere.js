$(".data-table").DataTable({
    processing: true,
    serverSide: true,
    ajax:
        "/master/filiere/" +
        document.getElementById("idDepartement").value +
        "/datatable",
    columns: [
        { data: "idFiliere", name: "idFiliere" },
        { data: "nomFiliere", name: "nomFiliere" },
        { data: "shortcut", name: "shortcut" },
        { data: "niveau", name: "niveau" },
        { data: "diplome", name: "diplome" },
        { 
            data: "CountEtudiant",
            render: function(data, type, full, meta) {
                    return '<span  style="padding-left: 55px;">' + data + '</span>';
            }
        },
        { data: "action", name: "action" }
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
    }
});

function initModal(idFiliere) {
    document.getElementById("hiddenIdFiliere").value = idFiliere;
}
jQuery(document).ready(function() {
    jQuery('select[name="filieres1"]').on("change", function() {
        var idFiliere = jQuery(this).val();
        if (idFiliere) {
            jQuery.ajax({
                url: "/master/getSemestresOfFiliere/" + idFiliere,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="semestre1"]').empty();
                    jQuery.each(data, function(key, value) {
                        $('select[name="semestre1"]').append(
                            '<option value="' +
                                value.id +
                                '">'+'S'+
                                value.num+
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="semestre1"]').empty();
        }
    });
});

jQuery(document).ready(function() {
    jQuery('select[name="filiere2"]').on("change", function() {
        jQuery('select[name="module2"]').empty();
        var idFiliere = jQuery(this).val();
        if (idFiliere) {
            jQuery.ajax({
                url: "/master/getSemestresOfFiliere/" + idFiliere,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="semestre2"]').empty();
                    $('select[name="semestre2"]').append(
                        '<option value="" selected>--select Semestre--</option>'
                    );
                    jQuery.each(data, function(key, value) {
                        $('select[name="semestre2"]').append(
                            '<option value="' +
                                value.id +
                                '">'+'S'+
                                value.num+
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="semestre2"]').empty();
        }
    });
});

jQuery(document).ready(function() {
    jQuery('select[name="semestre2"]').on("change", function() {
        var idSemester = jQuery(this).val();
        if (idSemester) {
            jQuery.ajax({
                url: "/master/getModuleOfSemester/" + idSemester,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="module2"]').empty();
                    jQuery.each(data, function(key, value) {
                        $('select[name="module2"]').append(
                            '<option value="' +
                                value.idModule +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="module2"]').empty();
        }
    });
});

jQuery(document).ready(function() {
    jQuery('select[name="filiere3"]').on("change", function() {
        jQuery('select[name="module3"]').empty();
        var idFiliere = jQuery(this).val();
        if (idFiliere) {
            jQuery.ajax({
                url: "/master/getSemestresOfFiliere/" + idFiliere,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="semestre3"]').empty();
                    $('select[name="semestre3"]').append(
                        '<option value="" selected>--select Semestre--</option>'
                    );
                    jQuery.each(data, function(key, value) {
                        $('select[name="semestre3"]').append(
                            '<option value="' +
                                value.id +
                                '">'+'S'+
                                value.num+
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="semestre3"]').empty();
        }
    });
});
jQuery(document).ready(function() {
    jQuery('select[name="semestre3"]').on("change", function() {
        var idSemester = jQuery(this).val();
        if (idSemester) {
            jQuery.ajax({
                url: "/master/getModuleOfSemester/" + idSemester,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="module3"]').empty();
                    jQuery.each(data, function(key, value) {
                        $('select[name="module3"]').append(
                            '<option value="' +
                                value.idModule +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="module3"]').empty();
        }
    });
});
jQuery(document).ready(function() {
    jQuery('select[name="semestre3"]').on("change", function() {
        var idSemester = jQuery(this).val();
        if (idSemester) {
            jQuery.ajax({
                url: "/master/getModuleOfSemester/" + idSemester,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="module3"]').empty();
                    $('select[name="module3"]').append(
                        '<option value="" selected>--select module--</option>'
                    );
                    jQuery.each(data, function(key, value) {
                        $('select[name="module3"]').append(
                            '<option value="' +
                                value.idModule +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="module3"]').empty();
        }
    });
});
jQuery(document).ready(function() {
    jQuery('select[name="module3"]').on("change", function() {
        var idModule = jQuery(this).val();
        if (idModule) {
            jQuery.ajax({
                url: "/master/getMatieresOfModule/" + idModule,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    jQuery('select[name="matiere3"]').empty();

                    jQuery.each(data, function(key, value) {
                        $('select[name="matiere3"]').append(
                            '<option value="' +
                                value.idMatiere +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                }
            });
        } else {
            $('select[name="matiere3"]').empty();
        }
    });
});
$("#submit1").click(function() {
    $("#deleteFiliere").submit();
});

$("#submit2").click(function() {
    $("#deleteModule").submit();
});

$("#submit3").click(function() {
    $("#deleteMatiere").submit();
});
