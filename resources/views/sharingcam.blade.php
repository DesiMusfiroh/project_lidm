<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
   
  

    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <!-- <div id="predefiend-roomid"> </div> -->

                    <input id="txt-roomid" placeholder="unik rooomid">
                    <button id='btn-open-or-join-room'>
                    Join
                    </button>
                
                    <div id="local-videos-container">
                    
                    </div>
                    <hr>
                    <div id="remote-videos-container">
                    
                    </div>
                </div>

                
            </div>
        </div>
    </body>
</html>

<script src="https://unpkg.com/rtcmulticonnection@latest/dist/RTCMultiConnection.min.js"></script>
<script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
<script type= 'text/javascript'>

var connection = new RTCMultiConnection();

// v3.4.7 or newer

connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';
connection.session = {
    audio: true,
    video: true
};

connection.sdpConstraints.mandatory = {
OfferToReceiveAudio: true,
OfferToReceiveVideo: true
};
var localVideosContainer = document.getElementById('local-videos-container');
var remoteVideosContainer = document.getElementById('remote-videos-container');

connection.onstream = function(event) {
    var video = event.mediaElement;
    // videosContainer.appendChild( video );
    if(event.type === 'local') {
        localVideosContainer.appendChild( video );
    }
    if(event.type === 'remote') {
        remoteVideosContainer.appendChild( video );
    }
}

var roomid = document.getElementById('txt-roomid');
// roomid.value = (Math.random()*1000).toString().replace('.','');
roomid.value = connection.token();
document.getElementById('btn-open-or-join-room').onclick = function() {
    this.disable = true;
    connection.openOrJoin(roomid.value || 'predefiend-roomid');
};
</script>
