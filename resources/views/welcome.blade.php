<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Sniglet&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&family=Sniglet&display=swap');
            @media screen and (max-width: 1000px) {
                #studyicon {
                    width: 100px;
                }
            }
            h5 {
                font-family: 'Sniglet', sans-serif;
                color:black;
            }
            #studyicon {
                width: 400px;
                margin-top: 50px;
            }
            #linesroom {
                width:200px;
                margin-top: 50px;
            }       
            button {
                width: 120px;
                height: 45px;
                font-size: 20px;
                font-family: 'Sniglet', sans-serif;
                box-shadow: 3px 3px 5px grey;
                font-size: 30px;
            }
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            #latar {
                background: linear-gradient(180deg, #D4DED7 0%, rgba(209, 218, 216, 0.9) 100%);
                box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.25);
                width: 100%;
                height: 30%;
            }
            #kotak {
                background: linear-gradient(180deg, #12C3CE 0%, #D7E8E9 100%);
                box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.4);
                border-radius: 22px;
                width: 80%;
                height: 75%;
                position:fixed;
                top: 10%;
                left:10%;
                right:10%;
            }
        </style>
    </head>
    <body>

    <div id="latar"> </div>
    <div id="kotak">
        <div class="container justify-content-center">
            <div class="row ">
                <div class="col-md-4 text-center">
                    <img src="/images/study.png" alt="" id="studyicon">
                </div>
                <div class="col-md-8 pr-4">
                    <img src="/images/logoa.png" alt="" id="linesroom">
                    <h5 style="text-indent:60px;"> LinesRoom merupakan aplikasi pembelajaran daring berbasis web dengan sejumlah inovasi fitur, yang dapat menjadikan penilaian kompetensi siswa diperoleh dari berbagai aspek secara lebih komprehensif, sehingga akan membantu mewujudkan implementasi pendidikan holistik di indonesia, terutama pada masa pandemi ini. </h5>
                    @if (Route::has('login'))
                        <div class="links mt-5">
                            @auth
                                <a href="{{ url('/home') }}" > <button class="btn btn-success mr-3"> Home </button></a>
                            @else
                                <a href="{{ route('login') }}" ><button class="btn btn-success mr-3">Login</button></a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" ><button class="btn btn-success">Register</button></a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
       
    </div>
        <!-- <div class="flex-center position-ref full-height">
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
        </div> -->
    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>

</html>
