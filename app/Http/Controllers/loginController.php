<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class loginController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = md5(sha1(md5($request->password)));

        $checkUser = User::where(DB::raw('lower(username)'),strtolower($username))
                    ->where('password',$password)
                    ->where('status',1)
                    ->first();

        if($checkUser)
        {
            if($checkUser->bagian == 1 || 3)
            {
                session(['user' => [       
                    'id'            => $checkUser->id,
                    'nama'          => $checkUser->nama,
                    'bagian'        => $checkUser->Bagian->nama,
                    'bagian_id'     => $checkUser->bagian,
                    'username'      => $checkUser->username
                ]]);
                return redirect('/dashboard');
            }

            return back()->with("error","Hanya Admin Yang Dapat Meng-Akses Dashboard ini !");
        }
        else {
            return back()->with("error","Nama Pengguna Dan Kata Sandi Tidak Cocok");
        }
    }
}
