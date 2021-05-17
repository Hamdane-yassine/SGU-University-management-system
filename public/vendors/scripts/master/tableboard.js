$(".cheftable").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/master/dashboard/chefdepsdatatable",
    columns: [
        { data: "id", name: "id" },
        { data: "name", name: "name" },
        { data: "DepName", name: "DepName" }
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
    lengthMenu: [
        [5, 10, 25, -1],
        [5, 10, 25, "Tout"]
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
$(".admintable").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/master/dashboard/adminsdatatable",
    columns: [
        { data: "id", name: "id" },
        { data: "name", name: "name" },
        { data: "email", name: "email" }
    ],
    scrollCollapse: true,
    autoWidth: false,
    pageLength : 5,
    lengthChange: false,
    responsive: true,
    columnDefs: [
        {
            targets: "datatable-nosort",
            orderable: false
        }
    ],
    lengthMenu: [
        [5, 10, 25, -1],
        [5, 10, 25, "Tout"]
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
        search: "Rechercher: ",
        searchPlaceholder: "Rechercher",
        paginate: {
            next: '<i class="ion-chevron-right"></i>',
            previous: '<i class="ion-chevron-left"></i>'
        }
    }
});
$(document).ready(function() {
    $('.dataTables_filter input[type="search"]').css('width',"45%");
});
