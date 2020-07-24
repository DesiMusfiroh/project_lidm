<nav class="sidebar-nav">
    <ul class="nav">
            <li class="nav-title">
            <img src="{{asset('assets/img/user.png')}}"  style="width: 150px; height: 150px; border-radius: 50%; display: block; margin: auto; ">
                <center> <strong>{{auth()->user()->name}}</strong> </center>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="nav-icon fa fa-home"></i> Beranda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profil/guru"> 
                    <i class="nav-icon fa fa-user" aria-hidden="true"></i> Profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="nav-icon fa fa-university "></i> Kelas
                </a>
            </li>
            <li class="nav-item">
                 <a class="nav-link" href="/home">
                    <i class="nav-icon fa fa-file-text "></i> Paket Soal
                 </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="nav-icon fa fa-graduation-cap"></i> Ujian
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="nav-icon fa fa-desktop"></i> Monitoring Ujian
                </a>
            </li>
            
       <!-- <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-settings"></i> Pengaturan
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon icon-puzzle"></i> Toko
                    </a>
                </li>
            </ul>
        </li> -->
    </ul>
</nav>