<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BOOKLOAD') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-500 pt-5 m-6"> 

        <center><h2 class="m-6">{{$title ?? ''}}</h2> </center>
        
        <center><x-application-logo></x-application-logo>  </center>
               <div class="p-6 text-gray-500 dark:text-gray-50">
                    <p class="pt-5">Dear {{$user->name}},</p>

                             {!! $message_body ?? '' !!}

                    <p>Best regards,<br>
                    {{config('app.name')}} Team</p>
                    </div>
              
            <!-- Page Content -->
             <x-footer></x-footer>
        </div>
       
    </body>
</html>
