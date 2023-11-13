@extends('admin.master', ['menu' => 'dashboard'])
@section('title', isset($title) ? $title : '')
@section('content')
<style>
    #download-report:hover {
        cursor: pointer;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>{{__('Dashboard')}}</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Dashboard')}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Statistics -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="status__box-3 bg-style">
                <div class="item__left">
                    <h2>{{__('Total Monitoring')}}</h2>
                    <div class="status__box__data">
                        <h2>{{$monitoring}}</h2>
                    </div>
                </div>
                <div class="item__right">
                    <div class="status__box__img">
                        <i class="fas fa-chart-bar fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="status__box-3 bg-style">
                <div class="item__left">
                    <h2>{{__('Monitoring Harian')}}</h2>
                    <div class="status__box__data">
                        <h2>{{$monitoringHarian}}</h2>
                    </div>
                </div>
                <div class="item__right">
                    <div class="status__box__img">
                        <i class="fas fa-chart-bar fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="status__box-3 bg-style">
                <div class="item__left">
                    <h2>Jumlah Titik</h2>
                    <div class="status__box__data">
                        <h2>{{$titik}}</h2>
                    </div>
                </div>
                <div class="item__right">
                    <div class="status__box__img">
                        <i class="fas fa-chart-bar fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="status__box-3 bg-style">
                <div class="item__left">
                    <h2>Jumlah Petugas</h2>
                    <div class="status__box__data">
                        <h2>{{$petugas}}</h2>
                    </div>
                </div>
                <div class="item__right">
                    <div class="status__box__img">
                        <i class="fas fa-chart-bar fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Statistics -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="status__box-3 bg-style">
                <div class="item__left">
                    <h2>{{__('Unduh Laporan')}}</h2>
                    <div class="status__box__data">
                        <div class="input__group mb-25">
                            <select name="filter" id="filter" required>
                                <option value="">Semua Data</option>
                                <option value="pertanggal">Pertanggal</option>
                                @foreach ($filterData as $dt)
                                @php
                                    $valueBulan         = strftime("%B", strtotime($dt->bulan_tahun));
                                    $valueTahun         = strftime("%Y", strtotime($dt->bulan_tahun));

                                    switch ($valueBulan) {
                                        case "January":
                                            $fixValue = "Januari " . $valueTahun;
                                            break;
                                        case "February":
                                            $fixValue = "Februari " . $valueTahun;
                                            break;
                                        case "March":
                                            $fixValue = "Maret " . $valueTahun;
                                            break;
                                        case "April":
                                            $fixValue = "April " . $valueTahun;
                                            break;
                                        case "May":
                                            $fixValue = "Mei " . $valueTahun;
                                            break;
                                        case "June":
                                            $fixValue = "Juni " . $valueTahun;
                                            break;
                                        case "July":
                                            $fixValue = "Juli " . $valueTahun;
                                            break;
                                        case "August":
                                            $fixValue = "Agustus " . $valueTahun;
                                            break;
                                        case "September":
                                            $fixValue = "September " . $valueTahun;
                                            break;
                                        case "October":
                                            $fixValue = "Oktober " . $valueTahun;
                                            break;
                                        case "November":
                                            $fixValue = "November " . $valueTahun;
                                            break;
                                        case "December":
                                            $fixValue = "Desember " . $valueTahun;
                                            break;
                                        default:
                                            $fixValue = "Bulan tidak valid";
                                    }
                                        
                                @endphp
                                    <option value="{{$dt->bulan_tahun}}">{{$fixValue}}</option>
                                @endforeach
                               
                                
                                
                            </select>
                        </div>
                        <div id="dateRangeFilter" style="display: none;">
                            <div class="status__box__data">
                                <div class="input__group mb-25">
                                    <h3>Dari tanggal</h3>
                                    <input type="date" id="start_date" name="start_date">
                                    <h3>Sampai tanggal</h3>
                                    <input type="date" id="end_date" name="end_date">
                                    <P> </P>
                                    <button class="btn btn-sm btn-info" id="filter_by_date"style="font-size: 12px; padding: 6px 12px;">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item__right">
                    <div class="status__box__img">
                        <i id="download-report" class="fas fa-download fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div id="table-url" data-url="/getMonitoring"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30">
                <div class="item-title">
                    <b>Data Monitoring</b>
                </div>
                <div class="customers__table">
                    <table id="CategoryTable" class="row-border data-table-filter table-style">
                        <thead>
                        <tr>
                            <th>{{ __('Petugas')}}</th>
                            <th>{{ __('Titik')}}</th>
                            <th>{{ __('Kode')}}</th>
                            <th>{{ __('Waktu Pemeriksaan')}}</th>
                            <th>{{ __('Laporan')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="table-url-today" data-url="/getMonitoringToday"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="customers__area bg-style mb-30">
                <div class="item-title">
                    <b>Data Monitoring Hari Ini</b>
                </div>
                <div class="customers__table">
                    <table id="CategoryTableToday" class="row-border data-table-filter table-style">
                        <thead>
                        <tr>
                            <th>{{ __('Petugas')}}</th>
                            <th>{{ __('Titik')}}</th>
                            <th>{{ __('Kode')}}</th>
                            <th>{{ __('Waktu Pemeriksaan')}}</th>
                            <th>{{ __('Laporan')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('post_scripts')
        <script src="{{asset('backend/js/admin/datatables/monitoring.js')}}"></script>
        <script>
            $('#download-report').on('click', function() {
    var filterValue = $('#filter').val();
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();

    var url = '/generateReport?filter=' + filterValue;

    if (filterValue === 'pertanggal') {
        if (startDate && endDate) {
            url += '&start_date=' + startDate + '&end_date=' + endDate;
        } else {
            // Tambahkan logika jika start_date atau end_date tidak diisi
        }
    }

    window.location.href = url;
});

        </script>
       <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan elemen yang dibutuhkan
            const dateRangeFilter = document.getElementById('dateRangeFilter');
            const filterOption = document.getElementById('filter');
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            const filterButton = document.getElementById('filter_by_date');
        
            // Sembunyikan div tanggal saat halaman dimuat
            dateRangeFilter.style.display = 'none';
        
            // Tambahkan event listener untuk perubahan pada dropdown
            filterOption.addEventListener('change', function() {
                if (filterOption.value === 'pertanggal') {
                    dateRangeFilter.style.display = 'block'; // Tampilkan div tanggal
                } else {
                    dateRangeFilter.style.display = 'none'; // Sembunyikan jika opsi selain "Pertanggal" dipilih
                }
            });

        });
        </script>
        

    
       
    @endpush
@endsection
