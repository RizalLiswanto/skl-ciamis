<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PetugasController extends Controller
{
    public function index(Request $request){
        if (session('user'))
        {
            if ($request->ajax()) {
                $data = User::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $btn = '<div class="action__buttons">';
                        $btn = $btn . '<a href=/petugas/detail/' . $data->id. ' class="btn-action" title="Edit"><i class="fas fa-pen-to-square"></i></a>';
    
                        if ($data->status == 1) {
                            $btn = $btn . '<a href="/petugas/nonaktif/' . $data->id . '" class="btn-action" title="Non Aktif"><i class="fas fa-toggle-on"></i></a>';
                        } else {
                            $btn = $btn . '<a href="/petugas/aktif/' . $data->id . '" class="btn-action" title="Aktif"><i class="fas fa-toggle-off"></i></a>';
                        }
    
                        $btn = $btn . '</div>';
                        return $btn;
                    })
                    ->editColumn('username', function ($data) {
                        return $data->username;
                    })
                    ->editColumn('nip', function ($data) {
                        return $data->nip;
                    })
                    ->editColumn('nama', function ($data) {
                        return ucwords($data->nama);
                    })
                    ->editColumn('bagian', function ($data) {
                        return $data->Bagian->nama;
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
                    ->rawColumns(['action', 'username','nip', 'nama','bagian', 'status'])
                    ->make(true);
            }
            $data['title'] = __('Data Petugas');
            return view('petugas', $data);
        }

        return redirect('/');
    }

    public function create()
    {
        
        if (session('user'))
        {
            $data['title'] = __('Data Petugas');
            return view('petugasCreate',$data);
        }
        
        return redirect('/');
    }

    public function store(Request $request)
    {
        if (session('user'))
        {
            try{
                
                $cekNip = User::where('nip',$request->nip)->first();

                if($cekNip == null){
                    $createPetugas                  = new User();
                    $createPetugas->username        = $request->username; 
                    $createPetugas->password        = md5(sha1(md5($request->password))); 
                    $createPetugas->nama            = $request->nama; 
                    $createPetugas->tempat_lahir    = $request->tempat_lahir; 
                    $createPetugas->tanggal_lahir   = $request->tanggal_lahir; 
                    $createPetugas->alamat          = $request->alamat; 
                    $createPetugas->no_hp           = $request->no_hp; 
                    $createPetugas->bagian          = 2; 
                    $createPetugas->nip             = $request->nip; 
                    $createPetugas->status          = 1;
                    $createPetugas->save();
    
                    return redirect('/petugas')->with('success','Petugas '.$createPetugas->nama.' Berhasil Ditambahkan !');
                }

                return back()->with('error','Petugas Dengan NIP : '.$request->nip.' Sudah Ada !');

            }catch(Exception $e) {
                return back()->with('error','Petugas '.$request->nama.' Gagal Ditambahkan !');
            }
        }
        
        return redirect('/');
    }

    public function detail($id)
    {
        
        if (session('user'))
        {
            $data['data']   = User::where('id',$id)->first();
            $data['title']  = __('Data Petugas');
            return view('petugasEdit',$data);
        }
        
        return redirect('/');
    }

    public function aktif($id)
    {
        
        try{
            $cek = User::where('id',$id)->first();
            $cek->status = 1;
            $cek->save();
            return back()->with('success','Status Dirubah Menjadi Aktif');
        } catch(Exception $e)
        {
            return back()->with('error','Gagal Mengubah Status Titik');
        }
    }

    public function nonaktif($id)
    {
        
        try{
            $cek = User::where('id',$id)->first();
            $cek->status = 2;
            $cek->save();
            return back()->with('success','Status Dirubah Menjadi Non Aktif');
        } catch(Exception $e)
        {
            return back()->with('error','Gagal Mengubah Status Titik');
        }
    }

    public function update(Request $request)
    {
        if (session('user'))
        {
            try{

                $cekKode = User::where('id',$request->id)->first();

                if($request->nip == $cekKode->nip)
                {
                    $cekKode->username        = $request->username; 
                    $cekKode->password        = $request->password != null ? md5(sha1(md5($request->password))) : $cekKode->password; 
                    $cekKode->nama            = $request->nama; 
                    $cekKode->tempat_lahir    = $request->tempat_lahir; 
                    $cekKode->tanggal_lahir   = $request->tanggal_lahir; 
                    $cekKode->alamat          = $request->alamat;  
                    $cekKode->no_hp           = $request->no_hp;  
                    $cekKode->nip             = $request->nip; 
                    $cekKode->save();

                    return redirect('/petugas')->with('success','Petugas '.$cekKode->nama.' Berhasil Diubah !');
                }

                $cekDuplikat = User::where('nip',$request->nip)->first();

                if($cekDuplikat == null)
                {
                    $cekKode->username        = $request->username; 
                    $cekKode->password        = $request->password != null ? md5(sha1(md5($request->password))) : $cekKode->password;
                    $cekKode->nama            = $request->nama; 
                    $cekKode->tempat_lahir    = $request->tempat_lahir; 
                    $cekKode->tanggal_lahir   = $request->tanggal_lahir; 
                    $cekKode->alamat          = $request->alamat;  
                    $cekKode->no_hp           = $request->no_hp; 
                    $cekKode->nip             = $request->nip; 
                    $cekKode->save();

                    return redirect('/petugas')->with('success','Petugas '.$cekKode->nama.' Berhasil Diubah !');
                }

                return back()->with('error','Petugas Dengan NIP :  '.$request->nip.' Sudah Terdaftar !');

            }catch(Exception $e) {
                return back()->with('error','Petugas '.$request->nama.' Gagal Diubah !');
            }
        }
        
        return redirect('/');
    }
}
