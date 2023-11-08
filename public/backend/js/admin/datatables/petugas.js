(function($) {
    "use strict";
    $(document).ready(function () {
        $('#CategoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('#table-url').data("url"),
            columns: [
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'bagian',
                    name: 'bagian'
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
