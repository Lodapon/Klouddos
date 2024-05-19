@extends('layout.mainlayout')

@section('content')
<main role="main" class="container">

    <h2>Hello</h2>

    <div>
        {{$Fname}} {{$Lname}}
    </div>

    <div>
        ID is : {{$id}}
    </div>
  
</main>
@endsection


{{-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Kloud DOS - Hotel & Agent Platform">
        <meta name="author" content="Kloud DOS">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="assets-custom/img/favicon.png">

        <title>Kloud DOS</title>

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets-custom/css/index.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert css -->
        <link href="assets/plugins/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

    </head>

    <body>

        <div class="login-bg"></div>
        <div class="clearfix"></div>
        
        <h1>HTML Here</h1>

        <!-- end wrapper page -->


        <script type="text/javascript" src="js/app.js"></script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Sweet Alert Js  -->
        <script src="assets/plugins/sweet-alert/sweetalert2.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script src="assets-custom/js/index.js"></script>

    </body>
</html> --}}

