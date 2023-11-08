<?php

namespace App\Http\Controllers;

use App\Models\Titik;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Dompdf\Dompdf;

class titikController extends Controller
{
    public function index(Request $request)
    {
        if (session('user')) {
            if ($request->ajax()) {
                $data = Titik::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $btn = '<div class="action__buttons">';
                        $btn = $btn . '<a href=/titik/detail/' . $data->id . ' class="btn-action" title="Edit"><i class="fas fa-pen-to-square"></i></a>';

                        if ($data->status == 1) {
                            $btn = $btn . '<a href="/titik/nonaktif/' . $data->id . '" class="btn-action" title="Non aktif"><i class="fas fa-toggle-on"></i></a>';
                        } else {
                            $btn = $btn . '<a href="/titik/aktif/' . $data->id . '" class="btn-action" title="Aktif"><i class="fas fa-toggle-off"></i></a>';
                        }
                        $btn = $btn . '<a href=/titik/cetakBarcode/' . $data->id . ' class="btn-action" title="Cetak Barcode"><i class="fas fa-barcode"></i></a>';

                        $btn = $btn . '</div>';
                        return $btn;
                    })
                    ->editColumn('nama_titik', function ($data) {
                        return $data->nama_titik;
                    })
                    ->editColumn('kode_barcode', function ($data) {
                        return $data->kode_barcode;
                    })
                    ->editColumn('koordinat', function ($data) {
                        return $data->koordinat;
                    })
                    ->editColumn('status', function ($data) {
                        if ($data->status == 1) {
                            $active = "Aktif";
                            return '<span class="status active">' . $active . '</span>';
                        } else {
                            $active = "Non Aktif";
                            return '<span class="status blocked">' . $active . '</span>';
                        }
                    })
                    ->rawColumns(['action', 'nama_titik', 'kode_barcode', 'koordinat', 'status'])
                    ->make(true);
            }
            $data['title'] = __('Titik Monitoring');
            return view('titik', $data);
        }

        return redirect('/');
    }

    public function create()
    {

        if (session('user')) {
            $data['title'] = __('Titik Monitoring');
            return view('titikCreate', $data);
        }

        return redirect('/');
    }

    public function store(Request $request)
    {
        if (session('user')) {
            try {

                $cekKode = Titik::where('kode_barcode', $request->barcode)->first();

                if ($cekKode == null) {

                    $createTitik                = new Titik();
                    $createTitik->nama_titik    = $request->nama_titik;
                    $createTitik->kode_barcode  = $request->barcode;
                    $createTitik->status        = 1;
                    $createTitik->save();

                    return redirect('/titik')->with('success', 'Titik ' . $createTitik->nama_titik . ' Berhasil Ditambahkan !');
                }

                return back()->with('error', 'Kode Barcode ' . $request->barcode . ' Sudah Terdaftar !');
            } catch (Exception $e) {
                return back()->with('error', 'Titik ' . $request->nama_titik . ' Gagal Ditambahkan !');
            }
        }

        return redirect('/');
    }

    public function detail($id)
    {

        if (session('user')) {
            $data['data']   = Titik::where('id', $id)->first();
            $data['title']  = __('Titik Monitoring');
            return view('titikEdit', $data);
        }

        return redirect('/');
    }

    public function aktif($id)
    {

        try {
            $cek = Titik::where('id', $id)->first();
            $cek->status = 1;
            $cek->save();
            return back()->with('success', 'Status Dirubah Menjadi Aktif');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal Mengubah Status Titik');
        }
    }

    public function nonaktif($id)
    {

        try {
            $cek = Titik::where('id', $id)->first();
            $cek->status = 2;
            $cek->save();
            return back()->with('success', 'Status Dirubah Menjadi Non Aktif');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal Mengubah Status Titik');
        }
    }

    public function update(Request $request)
    {
        if (session('user')) {
            try {

                $cekKode = Titik::where('id', $request->id)->first();

                if ($request->barcode == $cekKode->kode_barcode) {

                    $cekKode->nama_titik    = $request->nama_titik;
                    $cekKode->kode_barcode  = $request->barcode;
                    $cekKode->save();

                    return redirect('/titik')->with('success', 'Titik ' . $cekKode->nama_titik . ' Berhasil Diubah !');
                }

                $cekDuplikat = Titik::where('kode_barcode', $request->barcode)->first();

                if ($cekDuplikat == null) {
                    $cekKode->nama_titik    = $request->nama_titik;
                    $cekKode->kode_barcode  = $request->barcode;
                    $cekKode->save();

                    return redirect('/titik')->with('success', 'Titik ' . $cekKode->nama_titik . ' Berhasil Diubah !');
                }

                return back()->with('error', 'Kode Barcode ' . $request->barcode . ' Sudah Terdaftar !');
            } catch (Exception $e) {
                return back()->with('error', 'Titik ' . $request->nama_titik . ' Gagal Diubah !');
            }
        }

        return redirect('/');
    }

    public function generateBarcode()
    {
        // $barcode = new DNS1D();
        // $barcode->setStorPath(storage_path('app/public/barcodes/'));

        // $randomNumber = Str::random(8); 

        // $barcodeHtml = $barcode->getBarcodeHTML($randomNumber, 'C39');

        // return response()->json(['barcode' => $barcodeHtml,'kode' => $randomNumber]);
        $randomNumber = Str::random(8);

        $qrCode = QrCode::size(200)->generate($randomNumber);

        $barcodeSvg = $qrCode->toHtml();

        $responseData = [
            'barcode' => $barcodeSvg,
            'kode' => $randomNumber,
        ];


        return response()->json($responseData);
    }

    public function cetakBarcode($id)
    {

        if (session('user')) {
            // Create PDF


            // $dompdf = new Dompdf();
            // $title = 'QRcode: ' . $getkode->nama_titik;
            // $html = '<h1 style="text-align: center;">' . $title . '</h1>';
            // $html .= '<div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"><img src="data:image/svg+xml;base64,' . base64_encode($qrCode) . '"></div>';
            // $html = '<html><body>' . $html . '</body></html>';            
            // $dompdf->loadHtml($html);
            // $dompdf->setPaper('A4', 'landscape');
            // $dompdf->render();



            // // Generate file name for download
            // $fileName = 'QRcode_' . $getkode->nama_titik . '.pdf';

            // // Download PDF
            // return $dompdf->stream($fileName);
            $getkode = Titik::where('id', $id)->first();
            $qrCode = QrCode::size(200)->generate($getkode->kode_barcode);
            $dompdf = new Dompdf();
            $title = 'Barcode: ' . $getkode->nama_titik;
            $html = '<h1 style="text-align: center;">' . $title . '</h1>';
            $html .= '<div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"><img src="data:image/svg+xml;base64,' . base64_encode($qrCode) . '"></div>';
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            // Generate file name for download
            $fileName = 'Barcode_' . $getkode->nama_titik . '.pdf';

            // Download PDF
            return $dompdf->stream($fileName);
        }

        return redirect('/');
    }
}
