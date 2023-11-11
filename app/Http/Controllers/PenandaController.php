<?php

namespace App\Http\Controllers;

use App\Models\Penanda;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;



class PenandaController extends Controller
{
    public function index(Request $request){
        if (session('user'))
        {
            if ($request->ajax()) {
                $data = Penanda::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $btn = '<div class="action__buttons">';
                        $btn .= '<a href="/pengawas/detail/' . $data->id. '" class="btn-action" title="Edit"><i class="fas fa-pen-to-square"></i></a>';
                        $btn .= '</div>';
                        return $btn;
                    })
                    ->editColumn('urutan', function ($data) {
                        return $data->urutan;
                    })
                    ->editColumn('nama_pejabat', function ($data) {
                        return $data->nama_pejabat;
                    })
                    ->editColumn('nip', function ($data) {
                        return $data->nip;
                    })
                    ->editColumn('jabatan', function ($data) {
                        return $data->jabatan;
                    })
                    ->rawColumns(['action', 'urutan', 'nama_pejabat', 'nip', 'jabatan'])
                    ->make(true);
            }
            $data['title'] = __('Data Pengawas');
            return view('penanda', $data);
        }

        return redirect('/');
    }

    public function create()
    {
        
        if (session('user'))
        {
            $data['title'] = __('Data Pengawas');
            return view('penandaCreate',$data);
        }
        
        return redirect('/');
    }

    public function store(Request $request)
    {
        if (session('user'))
        {
            try{
                
                $cekNip = Penanda::where('nip',$request->nip)->first();

                if($cekNip == null){
                    $cekKode                  = new Penanda();
                    $cekKode->urutan          = $request->urutan; 
                    $cekKode->nama_pejabat    = $request->nama_pejabat; 
                    $cekKode->nip             = $request->nip; 
                    $cekKode->jabatan         = $request->jabatan;
                    $cekKode->save();
    
                    return redirect('/pengawas')->with('success','Pengawas '.$cekKode->nama_pejabat.' Berhasil Ditambahkan !');
                }

                return back()->with('error','Pengawas Dengan NIP : '.$request->nip.' Sudah Ada !');

            }catch(Exception $e) {
                return back()->with('error','Pengawas '.$request->nama_pejabat.' Gagal Ditambahkan !');
            }
        }
        
        return redirect('/');
    }

    public function detail($id)
    {
        
        if (session('user'))
        {
            $data['data']   = Penanda::where('id',$id)->first();
            $data['title']  = __('Data Pengawas');
            return view('penandaEdit',$data);
        }
        
        return redirect('/');
    }

    public function update(Request $request)
    {
        if (session('user'))
        {
            try{

                $cekKode = Penanda::where('id',$request->id)->first();

                if($request->nip == $cekKode->nip)
                {
                    $cekKode->urutan          = $request->urutan; 
                    $cekKode->nama_pejabat    = $request->nama_pejabat; 
                    $cekKode->nip             = $request->nip; 
                    $cekKode->jabatan         = $request->jabatan;
                    $cekKode->save();

                    return redirect('/pengawas')->with('success','Pengawas '.$cekKode->nama_pejabat.' Berhasil Diubah !');
                }

                $cekDuplikat = Penanda::where('nip',$request->nip)->first();

                if($cekDuplikat == null)
                {
                    $cekKode->urutan          = $request->urutan; 
                    $cekKode->nama_pejabat    = $request->nama_pejabat; 
                    $cekKode->nip             = $request->nip; 
                    $cekKode->jabatan         = $request->jabatan;
                    $cekKode->save();

                    return redirect('/pengawas')->with('success','Pengawas '.$cekKode->nama_pejabat.' Berhasil Diubah !');
                }

                return back()->with('error','Pengawas Dengan NIP :  '.$request->nip.' Sudah Terdaftar !');

            }catch(Exception $e) {
                return back()->with('error','Pengawas'.$request->nama_pejabat.' Gagal Diubah !');
            }
        }
        
        return redirect('/');
    }
}
