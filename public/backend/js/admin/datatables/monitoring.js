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

       // Filter by date
       $('#filter_by_date, #filter').on('click change', function() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var filterOption = $('#filter').val();
    
        var url = $('#table-url').data("url");
        if (filterOption === 'pertanggal') {
            url += '?start_date=' + startDate + '&end_date=' + endDate;
        } else {
            url += '?filter=' + filterOption;
        }
    
        $('#CategoryTable').DataTable().ajax.url(url).load();
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
