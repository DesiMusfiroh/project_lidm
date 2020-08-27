<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="{{ asset('css/app.css')}}"  >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <div id="testapp">

    </div>
    <script src="{{ asset('js/app.js')}}"></script>
    <script>
    Echo.private('testChannel')
    .listen('TaskEvent', (e) => {
        console.log(e);
    });
    </script>
</body>
</html>