$(".data-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/admin/dashboard/datatable",
    columns: [
        { data: "idProf", name: "idProf" },
        {
            data: "nom",
            render: function(data, type, row) {
                return "" + data + " " + row.prenom + "";
            }
        },
        { data: "specialite", name: "specialite" }
    ],
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    pageLength : 5,
    lengthChange: false,
    columnDefs: [
        {
            targets: "datatable-nosort",
            orderable: false
        }
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
        search: "",
        searchPlaceholder: "Rechercher",
        paginate: {
            next: '<i class="ion-chevron-right"></i>',
            previous: '<i class="ion-chevron-left"></i>'
        }
    },
    dom: '<"top"<"left-col"f>>rtp',
});

