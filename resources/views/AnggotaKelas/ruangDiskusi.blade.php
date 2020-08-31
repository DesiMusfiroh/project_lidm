@extends('layouts.layout_ruang')

@section('content')
<style>
#chat{
    right:20px;
    bottom: 20px;
    position:fixed;
}
    /* The popup chat - hidden by default */
.chat-popup {
display: none;
position: fixed;
bottom: 0;
right: 15px;
border: 3px solid #f1f1f1;
z-index: 9;
}
/* Add styles to the form container */
.form-container {
max-width: 300px;
padding: 10px;
background-color: white;
}
#chat-area {
    overflow-y:scroll;
    overflow-x:auto;
}
/* Full-width textarea */
.form-container #chat-area {
width: 100%;
padding: 15px;
margin: 5px 0 22px 0;
border: none;
background: #f1f1f1;
resize: none;
height: 360px;
}
/* When the textarea gets focus, do something */
.form-container textarea:focus {
background-color: #ddd;
outline: none;
}
/* Set a style for the submit/send button */
.form-container .tombol {
background-color: #4CAF50;
color: white;
padding: 10px 10px;
border: none;
cursor: pointer;
width: 100%;
margin-bottom:10px;
opacity: 0.8;
}
/* Add a red background color to the cancel button */
.form-container .cancel {
background-color: red;
}
/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
opacity: 1;
}
.display-right {
    display: flex;
    flex-direction: row-reverse;
}
.my-chat {
    background-color: #80F7FF;
    min-width:20px;
    border-radius: 15px 0px 15px 15px;
    padding: 0px 7px 3px 7px;
    margin: 0px 0px 7px 0px;
    box-shadow: 2px 2px 7px grey;
}
.display-left {
    display: flex;
    flex-direction: row;
}
.other-chat {
    background-color: #9FF1B6;
    min-width:20px;
    border-radius: 0px 15px 15px 15px;
    padding: 0px 7px 3px 7px;
    margin: 0px 0px 7px 0px;
    box-shadow: 2px 2px 7px grey;
}
</style>

<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-heavy-rain ml-3 mr-3 mt-3 pt-3 pb-2 pr-3 pl-3">
                <div class="row">
                    <div class="col text-center">
                    <h4><strong>Ruang Diskusi {{$kelompok->kelompok_master->deskripsi}} - {{$kelompok->nama_kelompok}}</strong>  </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="local-videos-container"></div>
                <div id="remote-videos-container"></div>
            </div>     
        </div>
    </div>
    <div id="chat">
        <button class="btn-warning btn"  onclick="openChat()"><i class="fa fa-comments"></i> Chat</button>
    </div>

    <div class="chat-popup " id="myForm">
        <div class="form-container" id="app">
            <h5><strong>ChatKelompok</strong> </h5>
            <messages-kelompok :kelas_id="{{$kelompok->kelompok_master->kelas->id}}" :id_kelompok="{{$kelompok->id}}" :user="{{auth()->user()}}"></messages-kelompok>
            <button type="button" class="tombol cancel" onclick="closeChat()">Close</button>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // chat pop up
    function openChat() {
        document.getElementById("myForm").style.display = "block";
    }
    function closeChat() {
        document.getElementById("myForm").style.display = "none";
    }

    // diskusi otomatis berakhir jika guru mengakhiri
    Echo.private('endDiskusiChannel.{{ $kelompok->kelompok_master->kelas->id}}')
    .listen('EndDiskusi', (e) => {
        console.log(e);
        swal({
            title: "Diskusi kelompok telah berakhir",
            text: "Silahkan kembali ke ruang pertemuan",
            icon: "info",
            buttons: true,
            dangerMode: false,
        })
            .then((endDiskusi) => {
            if (endDiskusi) {
            window.location = "/siswa/kelas/pertemuan/ruang/"+<?php echo $kelompok->kelompok_master->kelas->id ?>+"/"+<?php echo $pertemuan->id ?>;
            }
        });
    });
</script>

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
    if(event.type === 'local') {
        localVideosContainer.appendChild( video ).style.width = "300px";
    }
    if(event.type === 'remote') {
        remoteVideosContainer.appendChild( video ).style.width = "300px";
    }
}

$( document ).ready(function() {
    this.disable = true;
    connection.openOrJoin('predefiend-roomid');
});
</script>
@endsection