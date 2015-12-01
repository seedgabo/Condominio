<?php 
$message = Session::get('message');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Adminitración de {{Config::get('var.nombre')}}</title>

    <link rel="stylesheet" href=" {{ asset('css/simple-sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"> 

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    {{-- Link a FAVICON --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" /> 
    @yield('header', '')
</head>

<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            @include('admin/menu')
        </div>

        <!-- Page Content -->

            <div class="btn-group-vertical" role="group" style="position: fixed; z-index: 1000; bottom: 0px; left: 0px;">
                <button class="btn btn-primary menu-toggle"><i class="fa fa-bars"></i> <span style="display: none;" class="menu-text">Menu</span></button>
                <a class="btn btn-success" href="{{url()}}"><i class="fa fa-home"></i><span style="display: none;" class="menu-text"> volver </span></a> 
            </div>
        <div id="page-content-wrapper">
            @yield('content','')
        </div>


        <!-- Menu Toggle Script -->
        <script>
            $(".menu-toggle").click(function(e)
            {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                $("span.menu-text").toggle('slow');
            });
        </script>
</body>

</html>
