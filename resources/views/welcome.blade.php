<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simacan Dashboard</title>

    <!-- Favicon included -->
    <link rel="shortcut icon" href="" type="image/x-icon">

    <!-- Apple touch icon included -->
    <link rel="apple-touch-icon" href="">

    <!-- All CSS files included here -->
    <link rel="stylesheet" href="{{asset('admin/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/styles/main.css')}}">

    <link rel="manifest" href="{{'manifest.json' }}">
    <meta name="theme-color" content="#27374D"/>

</head>

<body>
<!-- Login Content -->
<div class="main-content__area bg-img">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="authentication__item">
                    <div class="authentication__item__logo">
                        <a href="/">
                            <img src="{{asset('admin/images/logo_lapas.png')}}" alt="icon">
                        </a>
                    </div>
                    <div class="authentication__item__title mb-30">
                        <h2>{{__('Silakan Masuk !')}}</h2>
                    </div>
                    <div class="authentication__item__content">
                        <form action="/login" method="post">
                            @csrf
                            <div class="input__group mb-25">
                                <label>{{__('Nama Pengguna')}}</label>
                                @if (session('error'))
                                    <a href="#">{{session('error')}}</a>
                                @endif
                                <div class="input-overlay">
                                    <input type="text" name="username" id="username" value="" placeholder="{{__('Masukan Nama Pengguna')}}">
                                    <div class="overlay">
                                        <img src="{{asset('admin/images/icons/user.svg')}}" alt="icon">
                                    </div>
                                </div>
                            </div>
                            <div class="input__group mb-20">
                                <label>{{__('Kata Sandi')}}</label>
                                <div class="input-overlay">
                                    <input type="password" name="password" id="pass" value="" placeholder="{{__('Masukan Kata Sandi')}}">
                                    <div class="overlay">
                                        <img src="{{asset('admin/images/icons/lock.svg')}}" alt="icon">
                                    </div>
                                    <div class="password-visibility">
                                        <img src="{{asset('admin/images/icons/eye.svg')}}" alt="icon">
                                    </div>
                                </div>
                            </div>
                            <div class="input__group mb-27">
                                <button type="submit" class="btn btn-blue">{{__('Masuk')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
     if ('serviceWorker' in navigator) {
     window.addEventListener('load', () => {
         navigator.serviceWorker.register('/service-worker.js')
         .then((registration) => {
             console.log('Service worker berhasil didaftarkan:', registration.scope);
         })
         .catch((error) => {
             console.error('Gagal mendaftarkan service worker:', error);
         });
     });
     }

   </script>
<script src="{{asset('admin/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/custom/password-show.js')}}"></script>
</body>
</html>
