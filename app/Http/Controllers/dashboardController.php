<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Titik;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class dashboardController extends Controller
{
    public function index(Request $request){
        if(session('user'))
        {
            $startDate = date('Y-m-d 00:00:00');
            $endDate = date('Y-m-d 23:59:59');

            $data['filterData'] = DB::table('monitoring')
                                    ->selectRaw("DATE_FORMAT(STR_TO_DATE(jam_pemeriksaan, '%d-%m-%Y %H:%i'), '%Y-%m') AS bulan_tahun")
                                    ->groupBy('bulan_tahun')
                                    ->get();

            
                                      

         
            if ($request->ajax()) {
                $query = Monitoring::latest()->get();
                if ($request->filter != null) {
                    $filterDate = Carbon::createFromFormat('Y-m', $request->filter);
                
                    $query = Monitoring::latest()
                            ->whereRaw("MONTH(STR_TO_DATE(jam_pemeriksaan, '%d-%m-%Y %H:%i')) = ?", $filterDate->month)
                            ->whereRaw("YEAR(STR_TO_DATE(jam_pemeriksaan, '%d-%m-%Y %H:%i')) = ?", $filterDate->year)
                            ->get();
                }
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->editColumn('petugas', function ($query) {
                        return $query->Petugas->nama;
                    })
                    ->editColumn('titik', function ($query) {
                        return isset($query->Titik) ? $query->Titik->nama_titik : 'Titik Tidak Ada';
                    })
                    ->editColumn('kode', function ($query) {
                        return $query->kode_barcode;
                    })
                    ->editColumn('jam_pemeriksaan', function ($query) {
                        return $query->jam_pemeriksaan;
                    })
                    ->editColumn('laporan', function ($query) {
                        return $query->laporan_keadaan;
                    })
                    ->rawColumns(['action', 'petugas', 'titik', 'kode','jam_pemeriksaan','laporan'])
                    ->make(true);
            }

            $countMonitoring        = count(Monitoring::get());
            $countMonitoringHarian  = count(Monitoring::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->get());
            $countTitik             = count(Titik::get());
            $countPetugas           = count(User::get());
            
            $data['monitoring']             = $countMonitoring;
            $data['monitoringHarian']       = $countMonitoringHarian;
            $data['titik']                  = $countTitik;
            $data['petugas']                = $countPetugas;
            $data['title']                  = __('Dashboard');
            
            return view('dashboard', $data);
        }

        return redirect('/');
    }

    public function getDataToday(Request $request){

        $startDate = date('Y-m-d 00:00:00');
        $endDate = date('Y-m-d 23:59:59');

        if ($request->ajax()) {
            $data = Monitoring::where('created_at', '>=', $startDate)
                    ->where('created_at', '<=', $endDate)
                    ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('petugas', function ($data) {
                    return $data->Petugas->nama;
                })
                ->editColumn('titik', function ($data) {
                    return isset($data->Titik) ? $data->Titik->nama_titik : 'Titik Tidak Ada';
                })
                ->editColumn('kode', function ($data) {
                    return $data->kode_barcode;
                })
                ->editColumn('jam_pemeriksaan', function ($data) {
                    return $data->jam_pemeriksaan;
                })
                ->editColumn('laporan', function ($data) {
                    return $data->laporan_keadaan;
                })
                ->rawColumns(['action', 'petugas', 'titik', 'kode','jam_pemeriksaan','laporan'])
                ->make(true);
        }

    }

    public function generateReport(Request $request)
    {
        if ($request->filter != null) {
            $filterDate = Carbon::createFromFormat('Y-m', $request->filter);

            $data = Monitoring::latest()
                ->whereRaw("MONTH(STR_TO_DATE(jam_pemeriksaan, '%d-%m-%Y %H:%i')) = ?", $filterDate->month)
                ->whereRaw("YEAR(STR_TO_DATE(jam_pemeriksaan, '%d-%m-%Y %H:%i')) = ?", $filterDate->year)
                ->get();
                $fileName = "monitoring_report_".$filterDate->month."_".$filterDate->year.".pdf";
        } else {
            $data = Monitoring::latest()->get();
            $fileName = "monitoring_report_semua_data.pdf";
        }

        // Generate PDF
        $pdf = PDF::loadView('reports.monitoring', ['data' => $data]);

        // Set nama file PDF

        // Menggunakan inline untuk menampilkan PDF di browser
        // $pdf->stream($fileName);

        // Atau menggunakan download untuk mengunduh file PDF
        return $pdf->download($fileName);
    }
}
