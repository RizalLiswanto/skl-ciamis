@extends('admin.master', ['menu' => 'pengawas'])
@section('title', isset($title) ? $title : '')
@section('content')
    <div id="table-url" data-url="/pengawas"></div>
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
            <div class="customers__area bg-style mb-30">
                <div class="item-title">
                    <div class="col-xs-6">
                        <a href="/pengawas/create" class="btn btn-md btn-info">{{ __('Tambah Data Pengawas')}}</a>
                    </div>
                </div>
                <div class="customers__table">
                    <table id="CategoryTable" class="row-border data-table-filter table-style">
                        <thead>
                            <tr>
                                <th>{{ __('NO')}}</th>
                                <th>{{ __('Urutan')}}</th>
                                <th>{{ __('Nama Pengawas')}}</th>
                                <th>{{ __('NIP')}}</th>
                                <th>{{ __('Jabatan')}}</th>
                                <th>{{ __('Aksi')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('post_scripts')
        <script src="{{ asset('backend/js/admin/datatables/penanda.js') }}"></script>
    @endpush
@endsection
