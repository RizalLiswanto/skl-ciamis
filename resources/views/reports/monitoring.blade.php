<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color:#526D82;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .content {
            margin: 20px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content table th, .content table td {
            border: 1px solid #333;
            padding: 8px;
        }

        .footer {
            background-color: #526D82;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .footer p {
            margin: 0;
        }

        .logo-left {
            float: left;
            margin-right: 20px;
           
        }

        .logo-right {
            float: right;
            margin-left: 20px;
        }

        .logo-left img{
            max-width: 50%;
            height: auto;
        }
        .logo-right img {
            max-width: 58%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-left">
            <img src="{{public_path('admin/images/logo_lapaskompres.png')}}" alt="Logo Kiri" width="100" height="100">
        </div>
        <div class="logo-right">
            <img src="{{public_path('admin/images/logo_ciamis.png')}}" alt="Logo Kanan" width="100" height="100">
        </div>
        <h1>Lapas Ciamis</h1>
       
    </div>
    <div class="content">
        <h2>Monitoring Report</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Petugas</th>
                    <th>Titik dan Waktu Pemeriksaan</th>
                    <th>Kode Barcode</th>
                    
                    <th>Laporan Keadaan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $item->Petugas->nama }}</td>
                        <td>{{ isset($item->Titik) ? $item->Titik->nama_titik : 'Titik Tidak Ada' }} {{ $item->jam_pemeriksaan }}</td>
                        <td>{{ $item->kode_barcode }}</td>
                        <td>{{ $item->laporan_keadaan }}</td>
                    </tr>
                    @php
                        $no ++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>Hak Cipta &copy; 2023 Lapas Ciamis Dashboard</p>
    </div>
</body>
</html>
