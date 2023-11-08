<?php

use App\Models\Monitoring;
use App\Models\User;
use App\Models\Titik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Monitor;

Route::post('/login', function(Request $request) {
    $username = $request->username;
    $password = md5(sha1(md5($request->password)));

    $checkUser = User::where(DB::raw('lower(username)'),strtolower($username))
                ->where('password',$password)
                ->where('status',1)
                ->first();

    if($checkUser) 
    {
        return response()->json([   
                                    'status' => 'Login Berhasil !!',
                                    'data'   =>     [       
                                                        'id'            => $checkUser->id,
                                                        'nama'          => $checkUser->nama,
                                                        'bagian'        => $checkUser->Bagian->nama,
                                                        'username'      => $checkUser->username,
                                                        'nip'           => $checkUser->nip
                                                    ]  
                                ], 200);
    }
    else {
        return response()->json(['status' => 'Login Failed'], 500);
    }
});


Route::get('/monitoring', function(Request $request)
{
    $test = today();
    $titik = DB::table('monitoring')
    ->whereRaw('DATE(created_at) = CURDATE()') 
    ->where('id_petugas',$request->id_pengguna)
    ->orderBy('created_at', 'desc')
    ->get();

    return response()->json($titik);
});

Route::post('/monitoring', function(Request $request) {
    try {
        $titik      = $request->titik;
        $kode       = $request->kode;
        $jam        = $request->jam;
        $laporan    = $request->laporan;
        $petugas    = $request->petugas;
 
        // Mengambil gambar yang diunggah
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->storeAs('public/foto', $imageName);

            // Menyimpan informasi gambar ke database
            $insertMonitoring = new Monitoring();
            $insertMonitoring->id_petugas       = $petugas;
            $insertMonitoring->titik            = $titik;
            $insertMonitoring->kode_barcode     = $kode;
            $insertMonitoring->jam_pemeriksaan  = $jam; // Pastikan formatnya sudah benar
            $insertMonitoring->laporan_keadaan  = $laporan;
            $insertMonitoring->foto             = $imageName; // Sesuaikan dengan nama kolom di tabel
            $insertMonitoring->save();


            


        } else {
            // Jika tidak ada gambar diunggah
            // Anda dapat menambahkan log atau pesan kesalahan
        }

        return response()
            ->json([
                'Pesan' => "Data Berhasil Disimpan"
            ], 200);
    } catch (Exception $e) {
        return response()
            ->json([
                'msg'       => $e->getMessage(),
                'status'    => "Gagal"
            ], 500);
    }
});

Route::get('/getTitik', function(Request $request)
{
    if($request->query('barcode') != null)
    {
        $getNama = Titik::where('kode_barcode',$request->query('barcode'))->first();

        

        if($getNama == null)
        {
            $response = [
                'success'   => true,
                'message'   => 'Data Ada',
                'nama'      => "Titik Tidak Ada",
                'id'        => 0,
            ];
        }else {
            $response = [
                'success'   => true,
                'message'   => 'Data Ada',
                'nama'      => $getNama->nama_titik,
                'id'        => $getNama->id,
            ];
        }

        
        
        return response()->json($response);
    }
    $titik = Titik::where('status',1)->get();

    return response()->json($titik);
});





Route::get('/ping', function () {
    return response()->json(['Koneksi' => 'Sukses', 'pesan' => 'sudah terkoneksi']);
});