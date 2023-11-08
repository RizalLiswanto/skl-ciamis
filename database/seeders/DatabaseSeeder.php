<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bagian;
use App\Models\Titik;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $createBagian = new Bagian();
        $createBagian->nama     = 'Admin';
        $createBagian->status   = 1;
        $createBagian->save();

        $createBagian = new Bagian();
        $createBagian->nama     = 'Petugas';
        $createBagian->status   = 1;
        $createBagian->save();

        
        $createBagian = new Bagian();
        $createBagian->nama     = 'Penanggung  Jawab';
        $createBagian->status   = 1;
        $createBagian->save();

        $createUser = new User();
        $createUser->username         = 'Admin';
        $createUser->password         = md5(sha1(md5('admin')));
        $createUser->nama             = 'Admin';
        $createUser->tempat_lahir     = 'Cimahi';
        $createUser->tanggal_lahir    = date('Y-m-d',strtotime('2022-09-09'));
        $createUser->alamat           = 'DI Jalan';
        $createUser->no_hp            = '0897346973265';
        $createUser->bagian           = 1;
        $createUser->status           = 1;
        $createUser->save();

        $createUser = new User();
        $createUser->username         = 'Petugas';
        $createUser->password         = md5(sha1(md5('petugas')));
        $createUser->nama             = 'Petugas';
        $createUser->tempat_lahir     = 'Cimahi';
        $createUser->tanggal_lahir    = date('Y-m-d',strtotime('2022-09-09'));
        $createUser->alamat           = 'DI Jalan';
        $createUser->no_hp            = '0897346973265';
        $createUser->bagian           = 2;
        $createUser->status           = 1;
        $createUser->save();

        $createTitik = new Titik();
        $createTitik->nama_titik       = 'minimum 1';
        $createTitik->koordinat        = '4J88+92';
        $createTitik->status           = 1;
        $createTitik->save();
    }
}
