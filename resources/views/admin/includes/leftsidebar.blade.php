<!-- Sidebar area start -->
<div class="sidebar__area">
    <div class="sidebar__close">
        <button class="close-btn">
            <i class="fa fa-close"></i>
        </button>
    </div>
    <div class="sidebar__brand">
        <a href="/dashboard">
            <img style="max-width: 68%" src="{{asset('admin/images/logo_lapas.png')}}" alt="icon">
        </a>
    </div>
    <ul id="sidebar-menu" class="sidebar__menu">
        <li class="{{ isset($menu) && $menu == 'dashboard' ? 'mm-active' : '' }}">
            <a href="/dashboard">
                <img src="{{ asset('admin/images/icons/sidebar/dashboard.svg') }}" alt="icon">
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
        
       
           
          
     @if (session('user.bagian') != 'Penanggung  Jawab')
         <li class="{{ isset($menu) && $menu == 'titik' ? 'mm-active' : '' }}">
            <a href="/titik">
                <img src="{{ asset('admin/images/icons/sidebar/dashboard.svg') }}" alt="icon">
                <span>{{ __('Titik Kontrol') }}</span>
            </a>
        </li>
        <li class="{{ isset($menu) && $menu == 'petugas' ? 'mm-active' : '' }}">
            <a href="/petugas">
                <img src="{{ asset('admin/images/icons/sidebar/dashboard.svg') }}" alt="icon">
                <span>{{ __('Petugas') }}</span>
            </a>
        </li>
        
        <li class="{{ isset($menu) && $menu == 'penanda' ? 'mm-active' : '' }}">
            <a href="/penanda">
                <img src="{{ asset('admin/images/icons/sidebar/dashboard.svg') }}" alt="icon">
                <span>{{ __('Penanda Tangan') }}</span>
            </a>
        </li>
     @endif
        
    
        <li class="{{ isset($menu) && $menu == 'logout' ? 'mm-active' : '' }}">
            <a href="/logout">
                <img src="{{ asset('admin/images/icons/action/log-out.svg') }}" alt="icon">
                <span>{{ __('Keluar') }}</span>
            </a>
        </li>
    </ul>
</div>
<!-- Sidebar area end -->
