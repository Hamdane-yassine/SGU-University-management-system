$(".data-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/chef/absencesDataTable",
    columns: [
        { data: "idAbsence", name: "idAbsence" },
        { data: "nomMatiere", name: "nomMatiere" },
        { data: "nomFiliere", name: "nomFiliere" },
        { data: "nomProf", name: "nomProf" },
        { data: "date", name: "date" },
        { data: "etat", name: "etat" }
    ],
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,

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
