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
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/jcookie.js') }}"></script>
    {{-- Link a FAVICON --}}
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    @yield('header', '')
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            @include('admin/menu')
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @if(Session::get('success') != null)
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{Session::get('success')}}
                </div>
            @endif
            @yield('content','')
        </div>
    </div>
</body>
</html>
