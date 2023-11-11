@extends('admin.master', ['menu' => 'pengawas'])
@section('title', isset($title) ? $title : '')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>{{__('Data Pengawas')}}</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Data Pengawas')}}</li>
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
                                        <form enctype="multipart/form-data" method="POST" action="{{ route('penanda.update') }}">
                                            @csrf
                                            <div class="input__group mb-25">
                                                <label>{{ __('Urutan')}}</label>
                                                <input type="text" id="urutan" name="urutan" value="{{$data->urutan }}" placeholder="Urutan">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Nama Pengawas')}}</label>
                                                <input type="text" id="nama_pejabat" name="nama_pejabat" value="{{ $data->nama_pejabat}}" placeholder="Nama Pengawas">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('NIP')}}</label>
                                                <input type="hidden" id="id" name="id" value="{{ $data->id }}" placeholder="NIP">
                                                <input type="text" id="nip" name="nip" value="{{ $data->nip }}" placeholder="NIP">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Jabatan')}}</label>
                                                <input type="text" id="jabatan" name="jabatan" value="{{ $data->jabatan }}" placeholder="Jabatan">
                                            </div>
                                            <div class="input__button">
                                                <button type="submit" class="btn btn-blue">{{ __('Simpan')}}</button>
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

