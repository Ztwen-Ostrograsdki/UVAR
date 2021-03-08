<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Université Virtuelle UVAR</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- Site Icons -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/v4-shims.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bg.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('master/css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body class="w-100 p-0 m-0">
	<div class="mx-auto row w-75">
		<div class="col-12 mx-auto m-0 p-0 row border">
			<h4 class="alert alert-primary col-8 mx-auto">
				UVAR, vous souhaite la bienvenue
			</h4> 

			<h5 class="alert alert-warning col-12">Votre mot de passe de confirmation est : 2548587AB</h5>
		</div>
	</div>
	<div>
		<a class="navbar-brand d-inline text-official cursive cursor" href="/">
            <img src="{{asset('logos/uvar.png')}}" class="d-inline m-0 p-0" width="" height="70">
        </a>   
	</div>
</body>

</html>