@extends('admin.master', ['menu' => 'petugas'])
@section('title', isset($title) ? $title : '')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>{{__('Data Petugas')}}</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Data Petugas')}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="gallery__area bg-style">
                <div class="gallery__content">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-vertical__item bg-style">
                                        <form enctype="multipart/form-data" method="POST" action="/petugas/update">
                                            @csrf
                                            <div class="input__group mb-25">
                                                <label>{{ __('NIP')}}</label>
                                                <input type="hidden" id="id" name="id" value="{{ $data->id }}" placeholder="NIP">
                                                <input type="text" id="nip" name="nip" value="{{ $data->nip }}" placeholder="NIP">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Nama')}}</label>
                                                <input type="text" id="nama" name="nama" value="{{ $data->nama }}" placeholder="Nama">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Nama Pengguna')}}</label>
                                                <input type="text" id="username" name="username" value="{{ $data->username }}" placeholder="Nama Pengguna">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Nomor HP')}}</label>
                                                <input type="text" id="no_hp" name="no_hp" value="{{ $data->no_hp }}" placeholder="Nomor HP">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Kata Sandi')}}</label>
                                                <input type="password" id="password" name="password" value="" placeholder="Kosongkan Jika Tidak Mengubah Kata Sandi">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Tempat Lahir')}}</label>
                                                <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $data->tempat_lahir }}" placeholder="Tempat Lahir">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Tanggal Lahir')}}</label>
                                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Alamat')}}</label>
                                                <textarea name="alamat" id="alamat" cols="30" rows="10">{{ $data->alamat }}</textarea>
                                            </div>
                                            <div class="input__button">
                                                <button type="submit" class="btn btn-blue">{{ __('Ubah')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

