<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.adminhead')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">

        @include('layout.adminnav')
        
        <section class="content">
            @yield('content')
        </section>

        @include('layout.adminfooter')

    </body>
</html>
