(function($) {
    "use strict";
    $(document).ready(function () {
        $('#CategoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url').data("url"),
            columns: [
                {
                    data: 'nama_titik',
                    name: 'Nama_titik'
                },
                {
                    data: 'kode_barcode',
                    name: 'kode_barcode'
                },
                {
                    data: 'koordinat',
                    name: 'koordinat'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });
    });
})(jQuery)
