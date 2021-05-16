<!doctype html>
<html>
    <head>
        <title>Laravel Notify</title>
        @notifyCss
    </head>
    <body>
        @php
            notify()->success('Welcome to Laravel Notify ⚡', 'My custom title');
        @endphp
        @include('notify::messages')
        @notifyJs
    </body>
</html>
