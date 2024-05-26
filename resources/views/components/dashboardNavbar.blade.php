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
				<span class="logo"><a href="index.html">Elegantic</a></span>
				<ul class="tools-nav tools-nav-mobile">
					<li class="items"><a href="/product"><span>2</span> Items, <strong>$599.00</strong></a></li>
					<li class="login"><a href="#">Login</a> / <a href="#">register</a></li>
				</ul>
				<div class="bar-holder">
				<a class="menu_trigger" href="#">menu</a>
					<nav id="nav">
						<ul>
							<li><a href="/category/1">Suits</a></li>
							<li><a href="/category/2">Coats</a></li>
							<li><a href="/category/3">Jackets</a></li>
							<li><a href="/category/4">Shirts</a></li>
							<li><a href="/category/5">Shoes</a></li>
						</ul>
					</nav>
					<ul class="tools-nav">
						<li class="items">
                            <a href="{{ route('cart') }}">
                                <span>{{ session('cart_total_count', 0) }}</span> Items, <strong>${{ number_format(session('cart_total_price', 0), 2) }}</strong>
                            </a>
                        </li>
						<li class="login"><a href="{{ route('profile') }}">Profile</a></li>
					</ul>
				</div>
			</header>
