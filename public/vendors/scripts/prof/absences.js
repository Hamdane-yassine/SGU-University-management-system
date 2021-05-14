$(".data-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/AbsencesList",
    columns: [
        { data: "IdAbsence", name: "IdAbsence" },
        { data: "nomMatiere", name: "nomMatiere" },
        { data: "nomFiliere", name: "nomFiliere" },
        { data: "nomDepartement", name: "nomDepartement" },
        { data: "date", name: "date" },
        { data: "etat", name: "etat" }
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
jQuery(document).ready(function() {
    jQuery('select[name="filiere"]').on("change", function() {
        var idFiliere = jQuery(this).val();
        if (idFiliere) {
            jQuery.ajax({
                url: "absences/getMatiere/" + idFiliere,
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
                                value.nomMatiere +
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
