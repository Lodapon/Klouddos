<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../asset-front/css/main.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>

    <body>
        <header id='header'>
            <div class="row">
                <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a href="/landing"><img src="{{ asset('images/Kloud Dos - LOGO-01.jpg') }}" alt="" height="65" /></a></div>
                    <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 ">
                </div>

                <div class="clearfix"></div>
              </div>
            </div>
        </header>

        <section class="content">
            @yield('content')
        </section>

        <!-- Footer -->
        <footer id="footer">
            <div class="inner">
                <h2>KLOUDDOS.COM</h2>
                <ul class="actions">
                    <li><span class="icon fa-phone"></span> <a href="#">(000) 000-0000</a></li>
                    <li><span class="icon fa-envelope"></span> <a href="#">information@untitled.tld</a></li>
                    <li><span class="icon fa-map-marker"></span> 123 Somewhere Road, Nashville, TN 00000</li>
                </ul>
            </div>
            <div class="copyright">
                &copy; Copyright 2020, Klouddos.com. 
            </div>
        </footer>

        <!-- Scripts -->
        <script src="../asset-front/js/jquery.min.js"></script>
        <script src="../asset-front/js/jquery.scrolly.min.js"></script>
        <script src="../asset-front/js/skel.min.js"></script>
        <script src="../asset-front/js/util.js"></script>
        <script src="../asset-front/js/main.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
