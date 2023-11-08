(function($) {
    "use strict";
    $(document).ready(function () {
        $('#CategoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url').data("url"),
            columns: [
                {
                    data: null,
                    name: 'index',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'urutan',
                    name: 'urutan'
                },
                {
                    data: 'nama_pejabat',
                    name: 'nama_pejabat'
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });
    });
})(jQuery);
