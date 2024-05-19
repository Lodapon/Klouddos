<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.adminhead')
    </head>
    <body>
        
        <section class="content">
            @yield('content')
        </section>

        @include('layout.adminfooter')

    </body>
</html>
