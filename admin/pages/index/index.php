<!doctype html>
<html lang="en">
<head>
  	<title>ADMIN BETACINEMA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
		session_start();

		$servername = "localhost";
		$username = "root";
		$password = "";
		$db_name = "betacinema_clone";
		$connect = mysqli_connect($servername, $username, $password, $db_name);

		if (!$connect) {
			die("Connect failed: " . mysqli_connect_error());
		}

		function checkAdminLogin($connect) {
			if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
				header("Location: /BetaCinema_Clone/auth/login.php");
				exit;
			} else {
				$userId = $_SESSION['UserID'];
				$sql = "SELECT `Role` FROM users WHERE UserID = ?";
				$stmt = mysqli_prepare($connect, $sql);
				mysqli_stmt_bind_param($stmt, "i", $userId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $role);
				mysqli_stmt_fetch($stmt);
				mysqli_stmt_close($stmt);

				if ($role == 1) {
					header("Location: /BetaCinema_Clone/auth/login.php");
					exit;
				}
			}
		}

		checkAdminLogin($connect);
	?>

	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
					<span class="sr-only">Toggle Menu</span>
				</button>
			</div>
			<div class="p-4">
		  		<h1><a href="index.php" class="logo">BETA CINEMA <span>Best Movies</span></a></h1>
				<div class="text-center bg-white" style="border-radius: 10px">
					<img src="/BetaCinema_Clone/assets/logo.png" alt="Logo" class="mt-4 mb-4">
				</div>
	        	<ul class="list-unstyled components mb-5 mt-4">
					<li>
						<a href="/BetaCinema_Clone/admin/pages/users/users.php"><span class="fa fa-user mr-3"></span> USERS</a>
					</li>
					<li>
						<a href="/BetaCinema_Clone/admin/pages/movies/movies.php"><span class="fa fa-film mr-3"></span> MOVIES</a>
					</li>
					<li>
						<a href="/BetaCinema_Clone/admin/pages/cinemas/cinemas.php"><span class="fa fa-building mr-3"></span> CINEMAS</a>
					</li>
					<li>
						<a href="/BetaCinema_Clone/admin/pages/halls/halls.php"><span class="fa fa-television mr-3"></span> HALLS</a>
					</li>
					<li>
						<a href="/BetaCinema_Clone/admin/pages/seats/seats.php"><span class="fa fa-users mr-3"></span> SEATS</a>
					</li>
					<li>
						<a href="/BetaCinema_Clone/admin/pages/showtimes/show_times.php"><span class="fa fa-video-camera mr-3"></span> SHOWTIMES</a>
					</li>
					<li>
						<a href="/BetaCinema_Clone/admin/pages/payments/payments.php"><span class="fa fa-money mr-3"></span> PAYMENT</a>
					</li>
				</ul>

	        	<div class="footer text-center" style="font-size: 18px">
	        		<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <span class="text-white admin-name">Hi, <?php echo $_SESSION['Fullname']; ?></span>
                        <a class="btn text-white" href="/BetaCinema_Clone/auth/logout.php"><i class="fa fa-sign-out"></i>						</a>
                    <?php else: ?>
                    <?php endif; ?>
	        	</div>
	      </div>
    	</nav>

        <!-- Page Content  -->
      	<div id="content" class="bg-img">
			<img src="/BetaCinema_Clone/assets/bg-admin.png" alt="bg-admin" class="bg-admin w-100 vh-100">
      	</div>
	</div>
		
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
<style>
    .content {
        display: none;
    }

    #content-default {
        display: block;
        text-align: center;
    }

    #content-default img {
        max-width: 50%;
        height: auto;
    }

	.fa-sign-out{
		font-size: 25px;
	}

	.bg-img{
		z-index: -999;
	}
</style>
</html>