<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>News -singel page app-</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- csrf-token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel={csrfToken:'{{ csrf_token() }}'}</script>
        {{-- bootstrap cdn --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
       
    </head>
    <body>
      <div id="app">
        <navbar></navbar>  
        <div class="container">
            <articles></articles>
        </div>
      </div>


    <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
