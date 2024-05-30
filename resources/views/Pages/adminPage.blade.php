
<?php
use Illuminate\Support\Facades\Session;
?>

<!-- Your blade template content -->
{{-- <!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <p>Logged in as: {{ session('user_email') }}</p>
    <!-- Add your dashboard content here -->

    <a href="{{ route('logout') }}">Logout</a>
</body>
</html> --}}

<!DOCTYPE html>
<!--[if lte IE 8]> <html class="oldie" lang="en"> <![endif]-->
<!--[if IE 9]> <html class="ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="format-detection" content="telephone=no">
	<title>Elegantic</title>
	<link rel="stylesheet" href="{{asset('css/fancySelect.css')}}" />
	<link rel="stylesheet" href="{{asset('css/uniform.css')}}" />
	<link rel="stylesheet" href="{{asset('css/all.css')}}" />
	<link media="screen" rel="stylesheet" type="text/css" href="{{asset('css/screen.css')}}" />
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>
<body>
	<div id="wrapper">
		<div class="wrapper-holder">
			<header id="header">

				<ul class="tools-nav tools-nav-mobile">
					<li class="items"><a href="/product"><span>2</span> Items, <strong>$599.00</strong></a></li>
					<li class="login"><a href="#">Login</a> / <a href="#">register</a></li>
				</ul>
				<div class="bar-holder">
				<a class="menu_trigger" href="#">menu</a>
					<nav id="nav">
						<ul>
                            <h2></h2>
							<h2>Admin Page</h2>
						</ul>
					</nav>
					<ul class="tools-nav">

						<li class="login"><a href="{{ route('logout') }}">Logout</a></li>
					</ul>
				</div>
			</header>

        </header>

        <div class="container mt-4">

            <section class="bar">
                <div class="bar-frame">
                    <ul class="breadcrumbs">
                        <li>
                            Pending Products
                        </li>
                    </ul>
                </div>
            </section>
            <section id="main">
                <ul class="list-table">

            @if(session('success'))
                <div style="color:green" class="alert alert-success" role="alert">
                    <br>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="color:red" class="alert alert-danger" role="alert">
                    <br>{{ session('error') }}
                </div>
            @endif

            @if (!$errors->isEmpty())
                <div style="color:red" class="alert alert-danger" style="border-radius: 0;" role="alert">
                    <br>{{ $errors->first() }}
                </div>
            @endif
            @foreach ($products as $product)
            <li>
                <div class="rows rows-item">
                    <img src="{{ asset($product->productImage) }}" alt="{{ $product->productName }}" height="99" width="99" alt="{{ $product->name }}">
                    <h3>{{ $product->productName }}</h3>
                </div>
                <div class="rows-holder">
                    <div class="rows rows-actions" style="padding-right: 40px">
                        <button type="button" onclick="window.location.href='{{ route('productDetails', $product->id) }}'" class="btn-view">View</button>
                    </div>
                    <div class="rows rows-actions">
                        <button style="background-color:green !important" type="button" onclick="window.location.href='{{ route('approveProduct', $product->id) }}'" class="btn-approve">Approve</button>
                    </div>
                    <div class="rows rows-actions">
                        <button type="button" onclick="window.location.href='{{ route('denyProduct', $product->id) }}'" class="btn-delete">delete</button>
                    </div>
                </div>
            </li>
            @endforeach
                </ul>

            </section>

        </div>
</div>
<x-dashboardFooter />
