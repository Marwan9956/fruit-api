<?php
$arr = [
    ['Home' => 'Home.html'],
    ['about'  => 'about.html']
];


?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('layouts.head')
    <body >
        <div id="app">
            <!-- Message Include -->
            <div id="app" class="flex-center position-ref full-height">
                
                <div class="content">
                    @include('layouts.container')
                </div>
            </div>
            <!-- async defer -->
        </div> 
        <script src=" {{ asset('js/app.js') }}" ></script>
       
    </body>
</html>
