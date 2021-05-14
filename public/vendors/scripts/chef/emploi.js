var table1 = $(".emploi_des_filieres").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/chef/emploi/filieres",
    columns: [
        { data: "idEmploi", name: "idEmploi" },
        { data: "filename", name: "filename" },
        { data: "nom", name: "nom" },
        { data: "niveau", name: "niveau" },
        { data: "UpdateDate", name: "UpdateDate" },
        {
            data: "idEmploi",
            render: function(data, type, full, meta) {
                return (
                    '<a href="#" style="color : #e95959" onclick="setIdEmploi(' +
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
    }
});
function setIdEmploi(id) {
    document.getElementById("idEmploi").value = id;
}
$("#delemploi").submit(function(e) {
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
        }
    });
});
