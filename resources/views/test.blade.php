<!doctype html>
<html>
    <head>
        <title>Laravel Notify</title>
        @notifyCss
    </head>
    <body>
        @include('notify::messages')
        @notifyJs
    </body>
    <script>
        function display() {
            @php
             notify()->success('Welcome to Laravel Notify ⚡', 'My custom title');
            @endphp
        }
    </script>
</html>
