(function($) {
    "use strict";
    $(document).ready(function () {
        $('#CategoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url').data("url"),
            columns: [
                {
                    data: 'petugas',
                    name: 'petugas'
                },
                {
                    data: 'titik',
                    name: 'titik'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'jam_pemeriksaan',
                    name: 'jam_pemeriksaan'
                },
                {
                    data: 'laporan',
                    name: 'laporan'
                },
            ]
        });

        $('#filter').on('change', function() {
            var newValue = $(this).val();
            $('#CategoryTable').DataTable().ajax.url($('#table-url').data("url") + '?filter=' + newValue).load();
        });

        $('#CategoryTableToday').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url-today').data("url"),
            columns: [
                {
                    data: 'petugas',
                    name: 'petugas'
                },
                {
                    data: 'titik',
                    name: 'titik'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'jam_pemeriksaan',
                    name: 'jam_pemeriksaan'
                },
                {
                    data: 'laporan',
                    name: 'laporan'
                },
            ]
        });
    });
})(jQuery)
