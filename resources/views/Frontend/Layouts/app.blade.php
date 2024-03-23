<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Home | E-Shopper</title>
    <link href="{{asset('Frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('Frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('Frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('Frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('Frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('Frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('Frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('Frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('Frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <!-- phần js và css đánh giá -->
    <script>
        if(screen.width <= 736){
            document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
        }
    </script>
    <link type="text/css" rel="stylesheet" href="{{asset('Frontend/danhGia/css/rate.css')}}">
    <script src="{{asset('Frontend/danhgia/js/jquery-1.9.1.min.js')}}"></script>
</head><!--/head-->

<body>
	@include('Frontend.Layouts.headerLogout')
	<!--/header-->
	
	@include('Frontend.Layouts.slide')
	<!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<!-- side bar left -->
					@include('Frontend.Layouts.leftmenu')
				</div>
				
				<div class="col-sm-9 padding-right">
					@yield('content')
				
				</div>
			</div>
		</div>
	</section>
	
	@include('Frontend.Layouts.footer')
	<!--/Footer-->
	

  
    <script src="{{asset('Frontend/js/jquery.js')}}"></script>
	<script src="{{asset('Frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('Frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('Frontend/js/price-range.js')}}"></script>
    <script src="{{asset('Frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('Frontend/js/main.js')}}"></script>
</body>
</html>