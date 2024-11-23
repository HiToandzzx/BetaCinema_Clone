<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/BetaCinema_Clone/admin/pages/index/css/style.css">
    <link rel="stylesheet" href="/BetaCinema_Clone/styles/admin.css">
    <title>CINEMAS</title>
</head>
<body>
    <?php
        session_start();
        require 'config.php';

        $rowsPerPage = 4;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $rowsPerPage;

        // Xử lý tìm kiếm
        $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';

        if (!empty($search)) {
            $countQuery = "SELECT COUNT(*) AS total FROM cinemas WHERE CinemaName LIKE '%$search%' OR `Address` LIKE '%$search%' OR `Location` LIKE '%$search%'";
            $query = "SELECT * FROM cinemas WHERE CinemaName LIKE '%$search%' OR `Address` LIKE '%$search%' OR `Location` LIKE '%$search%' LIMIT $offset, $rowsPerPage";
        } else {
            $countQuery = "SELECT COUNT(*) AS total FROM cinemas";
            $query = "SELECT * FROM cinemas LIMIT $offset, $rowsPerPage";
        }

        $countResult = mysqli_query($connect, $countQuery);
        $totalRows = mysqli_fetch_assoc($countResult)['total'];
        $result = mysqli_query($connect, $query);
        $totalPages = ceil($totalRows / $rowsPerPage);
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
		  		<h1><a href="/BetaCinema_Clone/admin/pages/index/index.php" class="logo">BETA CINEMA <span>Best Movies</span></a></h1>
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
					<li class="active">
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
                        <a class="btn text-white" href="/BetaCinema_Clone/auth/logout.php"><i class="fa fa-sign-out"></i></a>
                    <?php else: ?>
                    <?php endif; ?>
	        	</div>
	      </div>
    	</nav>

        <!-- Page Content  -->
      	<div id="content" class="bg-img p-5">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
                <!-- FORM TÌM KIẾM -->
                <form class="form-inline" method="GET" action="">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($search) ?>" size="30">
                    <button type="submit" class="btn btn-primary mr-2">Tìm kiếm</button>
                    <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-secondary"><i class="fa fa-refresh"></i></a>
                </form>
                <h1 class="text-center text-white">THÔNG TIN CINEMAS</h1>
                <a href="/BetaCinema_Clone/admin/pages/cinemas/add_cinemas.php" class="btn btn-success">THÊM MỚI CINEMAS</a>
            </div>
            <table class="table table-bordered table-striped table-primary mt-3">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Tên rạp</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Thành phố</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Map</th>
                        <th scope="col">Giá vé</th>
                        <th scope="col">Hotline</th>
                        <th scope="col">Function</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $stt = $offset + 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $stt++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['CinemaName']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Location']) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($row['Pic']) . "' alt='" . htmlspecialchars($row['CinemaName']) . "' style='width:50px;height:50px;'></td>";
                            echo "<td>" . htmlspecialchars($row['Map']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['GiaVe']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Hotline']) . "</td>";
                            echo "<td>
                                    <a href='/BetaCinema_Clone/admin/pages/cinemas/edit_cinemas.php?cinema_id=" . htmlspecialchars($row['CinemaID']) . "' class='btn btn-warning btn-sm'>SỬA</a>
                                    <a href='/BetaCinema_Clone/admin/pages/cinemas/delete_cinemas.php?cinema_id=" . htmlspecialchars($row['CinemaID']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc chắn muốn xoá cinema này không?');\">XOÁ</a>
                                </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>   
            <!-- PAGINATION -->
            <div class="d-flex justify-content-center">
                <ul class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?search=<?= htmlspecialchars($search) ?>&page=<?= $currentPage - 1 ?>"><</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="?search=<?= htmlspecialchars($search) ?>&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?search=<?= htmlspecialchars($search) ?>&page=<?= $currentPage + 1 ?>">></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>      
      	</div>
	</div>
		
    <script src="/BetaCinema_Clone/admin/pages/index/js/jquery.min.js"></script>
    <script src="/BetaCinema_Clone/admin/pages/index/js/popper.js"></script>
    <script src="/BetaCinema_Clone/admin/pages/index/js/bootstrap.min.js"></script>
    <script src="/BetaCinema_Clone/admin/pages/index/js/main.js"></script>
</body>
</html>