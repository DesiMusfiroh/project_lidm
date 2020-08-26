@extends('layouts.layout_ruang')

@section('content')
<style>
#chat{
    right:20px;
    bottom: 20px;
    position:fixed;
}
#end{
    left:20px;
    bottom: 20px;
    position:fixed;
}
#leave{
    right:20px;
    top: 20px;
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
#chatarea {
    overflow-y:scroll;
    overflow-x:auto;
}
/* Full-width textarea */
.form-container #chatarea {
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


<div id="fullscreenPertemuan">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-heavy-rain mt-3 mr-3 ml-3 pt-3 pb-2 pr-3 pl-3">
                        <div class="row">
                            <div class="col text-center">
                            <h4><strong>{{$pertemuan->kelas->nama_kelas}} - {{$pertemuan->nama_pertemuan}}</strong> </h4>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 pl-3">

                    <div id="carouselExampleIndicators" class="carousel slide ml-5" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active" width="500px">
                                <div class="container video"  style="background:black">
                                    <div class="row justify-content-center">
                                        <video autoplay="true" id="video-webcam" height="400px" > </video>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                            <!-- <img src="..." class="d-block w-100" alt="..."> -->
                            </div>
                            <div class="carousel-item">
                            <!-- <img src="..." class="d-block w-100" alt="..."> -->
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-heavy-rain mr-3 ml-3 pt-3 pb-2 pr-3 pl-3">
                        <div class="accordion" id="accordionExample">
                            <div class="card mb-1">
                                <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <strong>Daftar Siswa</strong>
                                    </button>
                                </h2>
                                </div>

                                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">

                                    Belum ada siswa yang memasuki ruang pertemuan

                                </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <strong>Daftar Kelompok</strong>
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div id="leave">
                <a href="{{route('pertemuanSiswa.show',['kelas_id'=>$pertemuan->kelas->id,'id_pertemuan'=>$pertemuan->id])}}"><button class="btn-danger btn"><i class="fa fa-times" style="margin-right:10px"></i> Keluar</button> </a>
            </div>

            <div id="end">
                <a href="{{route('pertemuan.end',$pertemuan->id)}}"><button class="btn-danger btn"> Akhiri Pertemuan</button> </a>
            </div>

            <div id="chat">
                <button class="btn-warning btn"  onclick="openChat()"><i class="fa fa-comments"></i> Chat</button>
            </div>

            <div class="chat-popup " id="myForm">

                <div class="form-container" id="app">
                    <h5><strong>Chat Pertemuan</strong> </h5>


                    <messages-component :kelas_id="{{$kelas->id}}" :id_pertemuan="{{$pertemuan->id}}" :user="{{auth()->user()}}"></messages-component>
                    <button type="button" class="tombol cancel" onclick="closeChat()">Close</button>
                </div>
            </div>
        </div>


<script>


    var video = document.querySelector("#video-webcam");
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
        if (navigator.getUserMedia) {
            navigator.getUserMedia({ video: true }, handleVideo, videoError);
        }
        function handleVideo(stream) { video.srcObject = stream; }
        function videoError(e) { alert("Izinkan menggunakan webcam untuk demo!") }
    // kirim pesan live chat
        function sendMessage() {
            var pesan = $("#isipesan").val();
            var pertemuan_id = $("#pertemuan_id").val();
            var user_id = $("#user_id").val();
            $.ajax({
                url: "{{ url('chat_pertemuan/send') }}",
                type: "GET",
                dataType: 'json',
                data: {
                    pertemuan_id: pertemuan_id,
                    user_id: user_id,
                    pesan: pesan
                },
                success: function(data) {
                    console.log(data);
                    $("#isipesan").val('');
                    location.reload(true); // refresh page otomatis
                }
            });
        }
    // chat pop up
    function openChat() {
        document.getElementById("myForm").style.display = "block";
        }
        function closeChat() {
        document.getElementById("myForm").style.display = "none";
        }

// akses kamera user

</script>


<!-- receive notifications -->
<script src="{{ asset('js/echo.js') }}"></script>

<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script>
    Pusher.logToConsole = true;

    Echo.private('anggota_kelas.{{ $kelas->id }}')
    .listen('StartDiskusi', (e) => {
        alert(e);
    });



</script>
<!-- receive notifications -->
@endsection
