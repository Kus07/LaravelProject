@include('templates.header')

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
	<link rel="stylesheet" href="css/fancySelect.css" />
	<link rel="stylesheet" href="css/uniform.css" />
	<link rel="stylesheet" href="css/all.css" />
	<link media="screen" rel="stylesheet" type="text/css" href="css/screen.css" />
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
					<li class="items"><a href="cart.html"><span>2</span> Items, <strong>$599.00</strong></a></li>
					<li class="login"><a href="#">Login</a> / <a href="#">register</a></li>
				</ul>
				<div class="bar-holder">
				<a class="menu_trigger" href="#">menu</a>
					<nav id="nav">
							<a class = 'btn btn-info' href="/dashboard">Home</a>
					</nav>
					<ul class="tools-nav">
                        <li class="login"><a href="{{ route('logout') }}">Logout</a></li>
					</ul>
				</div>
			</header>


<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (!$errors->isEmpty())
        <div class="alert alert-danger" style="border-radius: 0;" role="alert">
            {{ $errors->first() }}
        </div>
    @endif


    <h2 class="text-center">Edit Profile</h2>
    <br>
    <form action="{{ route('editProfile') }}" method="post" class="form-group" style="width:70%; margin-left:15%;">
        @csrf
        <label>Email:</label>
        <input type="text" class="form-control" placeholder="" name="email" value="{{ $user->email }}"><br>

        <label>First Name:</label>
        <input type="text" class="form-control" placeholder="" name="firstName" value="{{ old('firstName', $user->firstName) }}"><br>

        <label>Last Name:</label>
        <input type="text" class="form-control" placeholder="" name="lastName" value="{{ old('lastName', $user->lastName) }}"><br>

        <label>Shop Name (Optional):</label>
        <input type="text" class="form-control" placeholder="" name="shopName" value="{{ old('shopName', $user->shopName) }}"><br>

        <button type="submit" class="btn btn-primary">Submit</button><br>
    </form>
    <br>

</div>
</div>

<x-dashboardFooter />
