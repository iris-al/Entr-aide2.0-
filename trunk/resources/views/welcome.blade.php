<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>entraide</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <style>
            body{

         
                font-family : 'Montserrat' , sans-serif;
                margin : 0 ;
                
            }
        </style>
    </head>
    <body>
        <div id="app">
            <app/>   
            <!--Main component-->
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>