<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @yield('title')
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{asset('/')}}main.css" rel="stylesheet">
    <style media="screen">
    .breadcrumb{
        background-color: white;
    }
    @media screen and (max-width: 1000px) {
        .table-inside {
            overflow-y:auto;
            overflow-x:scroll;
        }
        .btn { margin-bottom: 5px; }
    }
    .card{
        box-shadow: 2px 2px 10px rgba(48, 10, 64, 0.5);
    } 
    .card-header { background: rgba(26, 166, 65, 0.47);}
    .metismenu-icon {color: black; font-weight:bold;}
    </style>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-heavy-rain header-text-dark" style="box-shadow: 2px 8px 8px rgba(0, 0, 0, 0.25);">
            <div class="app-header__logo">
              <!-- dibawah ini logonya nanti -->
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
            <!-- INI HEADER -->
            @include('layouts.siswa.header')
        </div>

        <div class="app-main">
            <!-- ini sidebar -->
            @include('layouts.siswa.sidebar')
				<div class="app-main__inner">
					@yield('content')
				</div>
                <div class="app-wrapper-footer">
                    <div class="app-footer ">
                        <div class="app-footer__inner bg-heavy-rain ">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <i> Live Learning Asessment Room </i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <div class="badge badge-success mr-1 ml-0">
                                                &copy 
                                            </div>
                                            Sistem Informasi UNJA
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			</div>      
        </div>
    </div>
    <script type="text/javascript" src="{{asset('/assets')}}/scripts/main.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
</body>
@yield('js')
@yield('chart')
</html>
