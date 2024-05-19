<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.head')
    </head>
    <body>

        @if(session()->get("user") != null)
            @include('layout.nav')
        @else
            @include('layout.navr')
        @endif
           
        <section class="content">
            @yield('content')
        </section>

        @include('layout.footer')

    </body>
</html>
