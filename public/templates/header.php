<?php

require "../config.php";
require "../common.php";
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="pragma" content="no-cache" />

	<title>Pokestop Locator - Pokestop</title>

	<!-- Using normalize.css to make it easier to work with different browsers -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />

	<!-- Using font from google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900&amp;display=swap" rel="stylesheet" />

	<!-- Using bootstrap for more responsive site -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

	<!-- linking my own external stylesheet -->
	<link rel="stylesheet" href="./css/style.css" />

	<!-- adding font-awesome icons -->
	<script src="https://kit.fontawesome.com/90982212c1.js" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
	<!-- header that appears on every page -->
	<header class="header">
		<!-- main title which also serves as a link back to the home page -->
		<a href="index.php">
			<h1 class="header__title">PokeStop Locator</h1>
		</a>
		<!-- navigation menu -->
		<nav class="navbar navbar-expand-md navbar-light">
			<!-- button for when screen gets too small to display all nav items -->
			<button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- nav items -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Search & Pokestops</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="submission.php">Submission</a>
					</li>

					<?php
					// echo $_SESSION['email'];
					if (empty($_SESSION['email'])) { ?>
						<li class="nav-item">
							<a class="nav-link" href="user-registration.php">Registration</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">Log out</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</nav>
	</header>