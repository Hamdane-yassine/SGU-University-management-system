var table1 = $(".data-table-export").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/NotesList/" + document.getElementById("idMatiere").value,
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
        },
        {
            data: "noteRatt",
            render: function(data, type, full, meta) {
                if (data == null) {
                    return "<span>&nbsp;---</span>";
                } else {
                    return '<span  style="padding-left: 15px;">' + data + '</span>';
                }
            }
        },
        {
            data: "idNote",
            render: function(data, type, row) {
                if(row.etat=="fermé")
                {
                    return (
                        '<i class="icon-copy dw dw-edit2"></i>'
                    );

                }else if(row.etat=="ouvert")
                {
                    return (
                        '<a href="" style="color: #265ed7" onclick="getnote(' +
                        data +
                        "," +
                        row.idEtudiant +
                        ')" data-toggle="modal" data-target="#Medium-modal"><i class="icon-copy dw dw-edit2"></i></a>'
                    );
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

function getnote(idNote, idEtudiant) {
    if (idNote == null) {
        $.ajax({
            type: "GET",
            url: "/Nonote/" + idEtudiant,
            dataType: "JSON",
            data: {},
            success: function(response) {
                document.getElementById("control").value = "";
                document.getElementById("exam").value = "";
                document.getElementById("ratt").value = "";
                document.getElementById("idNote").value = null;
                document.getElementById("coefcontrol").value = 25;
                document.getElementById("coefexam").value = 75;
                document.getElementById("idEtudiant").value = response;
            }
        });
    } else {
        $.ajax({
            type: "GET",
            url: "/note/" + idNote,
            dataType: "JSON",
            data: {},
            success: function(response) {
                document.getElementById("control").value = response[0].controle;
                document.getElementById("exam").value = response[0].exam;
                document.getElementById('ratt').value= response[0].noteRatt;
                document.getElementById("idNote").value = response[0].idNote;
                document.getElementById("coefcontrol").value =
                    response[0].Coefcontrole;
                document.getElementById("coefexam").value =
                    response[0].Coefexam;
            }
        });
    }
}

$("#myform").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            $("#Medium-modal").modal("hide");
            table1.ajax.reload();
        }
    });
});
