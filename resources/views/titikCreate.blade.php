@extends('admin.master', ['menu' => 'titik'])
@section('title', isset($title) ? $title : '')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb__content">
                <div class="breadcrumb__content__left">
                    <div class="breadcrumb__title">
                        <h2>{{__('Titik Monitoring')}}</h2>
                    </div>
                </div>
                <div class="breadcrumb__content__right">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Titik Monitoring')}}</li>
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
                                        <form enctype="multipart/form-data" method="POST" action="/titik/store">
                                            @csrf
                                            <div class="input__group mb-25">
                                                <label>{{ __('Nama Titik')}}</label>
                                                <input type="text" id="nama_titik" name="nama_titik" value="{{ old('nama_titik') }}" placeholder="Nama Titik">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Koordinat')}}</label>
                                                <input type="text" id="koordinat" name="koordinat" value="{{ old('koordinat') }}" placeholder="koordinat">
                                            </div>
                                            <div class="input__group mb-25">
                                                <label>{{ __('Kode Barcode')}}</label>
                                                <div class="input__button">
                                                    <div style="margin-left: 20px" id="generateButton" class="btn btn-blue">{{ __('Generate Kode Barcode')}}</div>
                                                </div>
                                                <div id="barcodeContainer"></div>
                                                <input type="hidden" id="barcode" name="barcode" value="{{ old('barcode') }}" placeholder="Kode Barcode">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    
    $("#generateButton").click(function() {
        $.ajax({
            url: "/generate-barcode",
            type: "GET",
            success: function(response) {
            $("#barcode").val(response.kode);
            $("#barcodeContainer").html(response.barcode);
            $("#generateButton").css('display','none');

            },
            error: function(xhr, status, error) {
            console.log(error);
            }
        });
    });

  });

  
</script>

