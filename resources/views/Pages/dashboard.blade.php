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
						<li class="items"><a href="/product"><span>2</span> Items, <strong>$599.00</strong></a></li>
						<li class="login"><a href="{{ route('profile') }}">Profile</a></li>
					</ul>
				</div>
			</header>



			<section class="promo">
				<ul class="slider">
					<li style="background: url(images/slide-01.jpg) no-repeat 50% 50%;">
						<div class="slide-holder">
							<div class="slide-info">
								<h1>collection for real gentlemen</h1>
								<p>Introducing the curated selection of premium products designed for the discerning modern man. This collection embodies the timeless elegance and refined sophistication that defines the true gentleman.</p>
								<a class="btn white big" href="/product">See the collection</a>
							</div>
						</div>
					</li>
					<li style="background: url(images/slide-02.jpg) no-repeat 50% 50%;">
						<div class="slide-holder">
							<div class="slide-info">
								<h1>collection for real gentlemen</h1>
								<p>Introducing the curated selection of premium products designed for the discerning modern man. This collection embodies the timeless elegance and refined sophistication that defines the true gentleman.</p>
								<a class="btn white big" href="#">See the collection</a>
							</div>
						</div>
					</li>
					<li style="background: url(images/slide-03.jpg) no-repeat 50% 50%;">
						<div class="slide-holder">
							<div class="slide-info">
								<h1>collection for real gentlemen</h1>
								<p>Introducing the curated selection of premium products designed for the discerning modern man. This collection embodies the timeless elegance and refined sophistication that defines the true gentleman.</p>
								<a class="btn white big" href="#">See the collection</a>
							</div>
						</div>
					</li>
					<li style="background: url(images/slide-04.jpg) no-repeat 50% 50%;">
						<div class="slide-holder">
							<div class="slide-info">
								<h1>collection for real gentlemen</h1>
								<p>Introducing the curated selection of premium products designed for the discerning modern man. This collection embodies the timeless elegance and refined sophistication that defines the true gentleman.</p>
								<a class="btn white big" href="#">See the collection</a>
							</div>
						</div>
					</li>
				</ul>
			</section>
			<section id="main">
				<div class="boxes">
					<div class="box">
						<a href="/product">
							<span class="bg"></span>
							<img src="images/img-01.jpg" alt="" />
							<div class="box-info">
								<div class="box-info-holder">
									<span class="title"><span>New stuff</span></span>
									<h2>Suits for gentlemen</h2>
									<span class="btn white normal">More new suits</span>
								</div>
							</div>
						</a>
					</div>
					<div class="box">
						<a href="/product">
							<span class="bg"></span>
							<img src="images/img-02.jpg" alt="" />
							<div class="box-info">
								<div class="box-info-holder">
									<span class="title"><span>Sale</span></span>
									<h2>all Jackets 50% off</h2>
									<span class="btn white normal">See products</span>
								</div>
							</div>
						</a>
					</div>
					<div class="box">
						<a href="/product">
							<span class="bg"></span>
							<img src="images/img-03.jpg" alt="" />
							<div class="box-info">
								<div class="box-info-holder">
									<span class="title"><span>Hot</span></span>
									<h2>Offer for real men</h2>
									<span class="btn white normal">Be a real man</span>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="block-advice">
					<div class="advice-holder">
						<h2>Newsletter</h2>
						<p>Join to receive promotions and other good news.</p>
					</div>
					<form action="#" class="form-newsletter">
						<fieldset>
							<input type="text" placeholder="Your email..." />
							<input class="btn black normal" type="submit" value="Subscribe" />
						</fieldset>
					</form>
				</div>
			</section>
		</div>

<x-dashboardFooter />
