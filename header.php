<?php
	require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
		<link rel="stylesheet" type="text/css" href="css/css/fontawesome-all.min.css" />
		<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.css" />
		<link rel="stylesheet" type="text/css" href="jquery-ui-1.12.1/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="jquery-ui-1.12.1/jquery-ui.structure.min.css" />
		<link rel="stylesheet" type="text/css" href="jquery-ui-1.12.1/jquery-ui.theme.min.css" />
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
		<style>
			.nav-link{
				color:#FFFFFF;
			}
		</style>
	</head>
	<body>
		<header class="container-fluid header" style="background-color:#FFOOOO">
			<?php 
					$q = "SELECT * FROM organizations WHERE username='northways'";
					$rQ = mysqli_query($con, $q);
					$result = mysqli_fetch_array($rQ);
				?>
			<input type="hidden" value="<?php echo $result['org_id']?>" id="orgInfo" />
			<article class="row">
				<div class="col-lg-8 hidden-sm-down">
					<i class="fa fa-phone"></i>+25479999999999999 &emsp;
					<i class="fa fa-phone"></i>+25478888888888888  &emsp;
					<i class="far fa-envelope"></i>Email: callcentre@northways.com
				</div>
				<div class="col-lg-4 social-icons">
						<a href="#"><i class="fab fa-facebook-f"></i></a>
						<a href="#"><i class="fab fa-twitter"></i></a>
						<a href="#"><i class="fab fa-google-plus-g"></i></a>
						<a href="#"><i class="fab fa-instagram"></i></a>
						<a href="#"><i class="fab fa-snapchat-ghost"></i></a>
						<a href="login.php" target="_blank"><button type="button" class="btn btn-outline-light btn-sm" style="font-weight:bolder;">Login</button></a>
				</div>
			</article>
		</header>
		<section class="container-fluid">
			<img src="images/logo.jpg" class="img-responsice" />
		</section>
		<section class="container-fluid header_navigation">
			<nav class="navbar navbar-expand-md">
				<button class="navbar-toggler navbar-right" type="button" data-toggle="collapse" data-target="#dropNav" style="float:right;">
					<span class="fas fa-bars" style="color:#FFFFFF; font-weight:bolder;"></span>
				</button>
				<div class="collapse navbar-collapse" id="dropNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="index.php" style="color:#FFFFFF; font-weight:bolder;">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="bus_routes.php" style="color:#FFFFFF; font-weight:bolder;">Bus routes/Fares</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="travelling_bus.php" style="color:#FFFFFF; font-weight:bolder;">Travelling busses</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php" style="color:#FFFFFF; font-weight:bolder;">Gallery</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact_us.php" style="color:#FFFFFF; font-weight:bolder;">Contact us</a>
						</li>
					</ul>
				</div>
			</nav>
		</section>