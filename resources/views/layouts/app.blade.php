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
        <script async id="slcLiveChat" src="https://widget.sonetel.com/SonetelWidget.min.js" data-account-id="207805846"></script>
    </body>
</html>
