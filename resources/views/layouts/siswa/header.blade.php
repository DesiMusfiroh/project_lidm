<?php  use App\Siswa;
    $siswa = Siswa::where('user_id', Auth::user()->id )->first();
?>
@if ( Siswa::where('user_id', Auth::user()->id )->first() != null )
<div class="app-header__content">
  
    <div class="app-header-right">
        <div class="header-btn-lg pr-0">
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                <div class="widget-content-left  ml-3 header-user-info">
                        <div class="widget-heading">
                            {{auth()->user()->name}}
                        </div>
                        <!-- <div class="widget-subheading">
                            VP People Manager
                        </div> -->
                    </div>
                    
                    <div class="widget-content-left">
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                <!-- <img width="42" class="rounded-circle" src="/images/{{$siswa->foto}}" alt=""> -->
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> <button type="button" tabindex="0" class="dropdown-item">Logout</button></a>

                            </div>
                        </div>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
      </div>
</div>
@else
<div class="app-header__content">
    
    <div class="app-header-right">
        <div class="header-btn-lg pr-0">
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <!-- <div class="widget-content-left  ml-3 header-user-info">
                         <div class="widget-heading">
                            {{auth()->user()->name}}
                        </div>
                        <div class="widget-subheading">
                            VP People Manager
                        </div>
                    </div> -->
                    <div class="widget-content-left">
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                <!-- <img width="42" class="rounded-circle" ssrc="{{asset('assets/images/avatars/1.jpg')}}" alt=""> -->
                               {{auth()->user()->name}} 
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                              <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> <button type="button" tabindex="0" class="dropdown-item">Logout</button></a>

                            </div>
                        </div>
                    </div>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
      </div>
</div>
@endif
