var table1 = $(".data-table-export").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/EtudiantsList/" + document.getElementById("idFiliere").value,
    columns: [
        { data: "apogee", name: "apogee" },
        { data: "nom", name: "nom" },
        { data: "prenom", name: "prenom" },
        { data: "cne", name: "cne" },
        { data: "email", name: "email" },
        { data: "tel", name: "tel" },
        {
            data: "idEtudiant",
            render: function(data, type, full, meta) {
                return (
                    ' <a class="dropdown-item" href="" style="background-color:transparent;" onclick="getEtudiantInfo(' +
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
    dom:
        '<"top"<"left-col"B><"right-col"f>>rt<"row"<"col-sm-4"l><"col-sm-8"p>>',
    buttons: [
        {
            extend: "print",
            text: '<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimer',
            exportOptions: {
                columns: "th:not(:last-child)"
            }
        }
    ]
});

function getEtudiantInfo(id) {
    $.ajax({
        type: "GET",
        url: "/Etudiant/" + id,
        dataType: "JSON",
        data: {},
        success: function(response) {
            document.getElementById("nom").innerHTML = response[0].nom;
            document.getElementById("prenom").innerHTML = response[0].prenom;
            document.getElementById("apogee").innerHTML = response[0].apogee;
            document.getElementById("cne").innerHTML = response[0].cne;
            document.getElementById("genre").innerHTML = response[0].genre;
            document.getElementById("datenais").innerHTML =
                response[0].dateNaissance;
            document.getElementById("situation").innerHTML =
                response[0].situationFamiliale;
            document.getElementById("nationalite").innerHTML =
                response[0].nationalite;
            document.getElementById("LieuNaissance").innerHTML =
                response[0].lieuNaissance;
            document.getElementById("cin").innerHTML = response[0].cin;
            document.getElementById("cinpere").innerHTML = response[0].cinPere;
            document.getElementById("cinmere").innerHTML = response[0].cinMere;
            document.getElementById("adresse").innerHTML =
                response[0].adressePersonnele;
            document.getElementById("tel").innerHTML = response[0].tel;
            document.getElementById("email").innerHTML = response[0].email;
            document.getElementById("emailins").innerHTML =
                response[0].emailInstitutionne;
            document.getElementById("annebac").innerHTML =
                response[0].anneeDuBaccalaureat;
            document.getElementById("couv").innerHTML =
                response[0].regimeDeCovertureMedicale;
        }
    });
}
