<!DOCTYPE html>
<html>
<head>
	<!-- REQUIRED META -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="<?= baseURL(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= baseURL(); ?>css/aos.css">
	<link rel="shortcut icon" href="<?php echo baseURL(); ?>/img/logo-cc-black.png" type="image/png">
	<title>Cast Chronicles</title>
	<script type="text/javascript" src="<?= baseURL(); ?>js/sweetalert2@8.js"></script>
	<style>
	body{
		background-image: url('<?php echo baseURL(); ?>/img/logo-cc.png'); background-repeat: no-repeat; background-size:40%; background-attachment: fixed; background-position: center; background-color: rgba(0,0,0,1);
	}
	.nav-link{
		font-weight: bold;
	}
	</style>
</head>
<body>
	<?php
	if (!isset($section))
	{
	?>
	<section style="background: yellow;">
		<div class="container">
			<div class="row justify-content-center py-4 align-items-center no-gutters">
				<div class="col-sm-5">
					<center><img src="<?php echo baseURL(); ?>/img/logo-ccnp.png" class="img-fluid" style="-webkit-filter:drop-shadow(3px 3px 2px rgba(0,0,0,1));"></center>
				</div>
			</div>
		</div>
	</section>
	<nav class="navbar navbar-dark bg-primary navbar-expand-lg sticky-top">
		<div class="container">
			<a href="" class="navbar-brand">
				<img src="<?php echo baseURL(); ?>/img/logo-cc.png" style="width: 40px;">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a href="<?php echo baseURL(); ?>" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="" class="nav-link">Latest News</a></li>
					<li class="nav-item"><a href="" class="nav-link">Sports</a></li>
					<li class="nav-item"><a href="" class="nav-link">Entertainment</a></li>
				</ul>
				<form action="" class="form-inline my-2 my-lg-0">
					<input type="search" class="form-control mr-sm-2" placeholder="Search Here...">
					<button class="btn btn-default my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</div>
	</nav>
	<?php
	}
	else {
		if ($section=="writers-panel") {
	?>
	<!-- WRITERS NAV -->
	<section style="background: yellow;">
		<div class="container">
			<div class="row justify-content-center py-4 align-items-center no-gutters">
				<div class="col-sm-5">
					<center><img src="<?php echo baseURL(); ?>/img/logo-ccnp.png" class="img-fluid" style="-webkit-filter:drop-shadow(3px 3px 2px rgba(0,0,0,1));"></center>
				</div>
			</div>
		</div>
	</section>
	<nav class="navbar navbar-dark bg-primary">
		<div class="container">
			<span class="navbar-brand"><strong>Writers Panel</strong></span>
		</div>
	</nav>
	<nav class="navbar navbar-dark bg-primary navbar-expand-lg sticky-top">
		<div class="container">
			<a href="" class="navbar-brand">
				<img src="<?php echo baseURL(); ?>/img/logo-cc.png" style="width: 40px;">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a href="<?php echo baseURL(); ?>" class="nav-link">Dashboard</a></li>
					<li class="nav-item"><a href="" class="nav-link">My Articles</a></li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a href="" class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown">
							Hi User!
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Settings</a>
							<a class="dropdown-item" href="logout.php">Log Out</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
		}
		else if ($section=="admin-panel") {
	?>
	<!-- ADMIN NAV -->
	<section style="background: yellow;">
		<div class="container">
			<div class="row justify-content-center py-4 align-items-center no-gutters">
				<div class="col-sm-5">
					<center><img src="<?php echo baseURL(); ?>/img/logo-ccnp.png" class="img-fluid" style="-webkit-filter:drop-shadow(3px 3px 2px rgba(0,0,0,1));"></center>
				</div>
			</div>
		</div>
	</section>
	<nav class="navbar navbar-dark bg-primary">
		<div class="container">
			<span class="navbar-brand"><strong>Admin Panel</strong></span>
		</div>
	</nav>
	<nav class="navbar navbar-dark bg-primary navbar-expand-lg sticky-top">
		<div class="container">
			<a href="" class="navbar-brand">
				<img src="<?php echo baseURL(); ?>/img/logo-cc.png" style="width: 40px;">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a href="<?php echo baseURL(); ?>" class="nav-link">Dashboard</a></li>
					<li class="nav-item"><a href="" class="nav-link">Articles</a></li>
					<li class="nav-item"><a href="" class="nav-link">Writers</a></li>
					<li class="nav-item"><a href="" class="nav-link">Events</a></li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a href="" class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown">
							Hi User!
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Settings</a>
							<a class="dropdown-item" href="logout.php">Log Out</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
		}
	}
	?>
	<section>
		<div class="container" style="background: rgba(0,0,0,0.5)">
		<br/>