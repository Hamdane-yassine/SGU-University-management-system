var table1 = $(".data-table-export").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/chef/NotesList/" + document.getElementById("IdMatiere").value,
    columns: [
        { data: "apogee", name: "apogee" },
        { data: "nom", name: "nom" },
        { data: "prenom", name: "prenom" },
        { data: "cne", name: "cne" },
        {
            data: "controle",
            render: function(data, type, full, meta) {
                if (data == null) {
                    return '<span style="padding-left: 17px;">&nbsp;---</span>';
                } else {
                    return (
                        '<span style="padding-left: 15px;">' + data + "</span>"
                    );
                }
            }
        },
        {
            data: "exam",
            render: function(data, type, full, meta) {
                if (data == null) {
                    return '<span style="padding-left: 17px;">&nbsp;---</span>';
                } else {
                    return (
                        '<span style="padding-left: 15px;">' + data + "</span>"
                    );
                }
            }
        },
        {
            data: "noteGeneral",
            render: function(data, type, full, meta) {
                if (data == null) {
                    return "<span>&nbsp;---</span>";
                } else {
                    return "<span>" + data + "</span>";
                }
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
            text: '<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimer'
        },
        {
            extend: "excel",
            text: '<i class="icon-copy fa fa-file-excel-o" aria-hidden="true">&nbsp;&nbspExcel</i>',
        }
    ]
});
