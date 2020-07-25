<?php  use App\Guru;
    $guru = Guru::where('user_id', Auth::user()->id )->first();
?>
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
            <center>
            @if( Guru::where('user_id', Auth::user()->id )->first() != null )
                <li class="app-sidebar__heading"> <img class="rounded-circle" style="width: 100px; height: 100px; display: block; margin: auto;" src="/images/{{$guru->foto}}" alt=""></li>
            @else
            <li class="app-sidebar__heading"> <img width="42" class="rounded-circle" src="{{asset('assets/images/1.jpg')}}" alt=""></li>
            @endif
            </center>

                <li>
                    <a href="/home" class="mb-2  {{(request()->is('/home*')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{route('guru.profil')}}" class="mb-2 {{(request()->is('guru/profil*')) ? 'mm-active' : ''}} ">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Profil
                    </a>
                </li>
                    
                <li>
                <a href="{{route('guru.kelas')}}" class="mb-2  {{(request()->is('guru/kelas*')) ? 'mm-active' : ''}}">
                     <i class="metismenu-icon pe-7s-monitor"></i>
                        Kelas
                     <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{route('guru.kelas.create')}}">
                           Buat Kelas Baru
                            <i class="metismenu-icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('guru.kelas')}}">
                            Daftar Kelas
                            <i class="metismenu-icon pe-7s-monitor"></i>
                        </a>
                    </li>
                                        
                </ul>
                </li>

                <li>
                    <a href="" class="mb-2">
                        <i class="metismenu-icon pe-7s-bookmarks"></i>
                        Paket Soal
                    </a>
                </li>
                <li>
                <a href="#" class="md-2">
                     <i class="metismenu-icon pe-7s-display2"></i>
                        Kelola Ujian
                     <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="#">
                           Ujian
                            <i class="metismenu-icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Monitoring Ujian
                            <i class="metismenu-icon pe-7s-monitor"></i>
                        </a>
                    </li>
                                        
                </ul>
                </li>
            </ul>
        </div>
    </div>
</div>    <div class="app-main__outer">
