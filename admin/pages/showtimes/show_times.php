<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/BetaCinema_Clone/admin/pages/index/css/style.css">
    <link rel="stylesheet" href="/BetaCinema_Clone/styles/admin.css">
    <title>SHOW TIMES</title>
</head>
<body>
    <?php
        session_start();
        require 'config.php';

        // Pagination
        $rowsPerPage = 4;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $rowsPerPage;

        // Filter inputs
        $showdate = isset($_GET['showdate']) ? mysqli_real_escape_string($connect, $_GET['showdate']) : '';
        $starttime = isset($_GET['starttime']) ? mysqli_real_escape_string($connect, $_GET['starttime']) : '';
        $endtime = isset($_GET['endtime']) ? mysqli_real_escape_string($connect, $_GET['endtime']) : '';

        // Build WHERE clause
        $whereClauses = [];
        if (!empty($showdate)) {
            $whereClauses[] = "ShowDate = '$showdate'";
        }
        if (!empty($starttime)) {
            $whereClauses[] = "StartTime = '$starttime'";
        }
        if (!empty($endtime)) {
            $whereClauses[] = "EndTime = '$endtime'";
        }
        $whereSQL = count($whereClauses) > 0 ? "WHERE " . implode(' AND ', $whereClauses) : '';

        $countQuery = "SELECT COUNT(*) AS total FROM show_times $whereSQL";
        $countResult = mysqli_query($connect, $countQuery);
        $totalRows = mysqli_fetch_assoc($countResult)['total'];

        $query = "SELECT * FROM show_times $whereSQL LIMIT $offset, $rowsPerPage";
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
					<li>
						<a href="/BetaCinema_Clone/admin/pages/cinemas/cinemas.php"><span class="fa fa-building mr-3"></span> CINEMAS</a>
					</li>
					<li>
						<a href="/BetaCinema_Clone/admin/pages/halls/halls.php"><span class="fa fa-television mr-3"></span> HALLS</a>
					</li>
					<li>
						<a href="/BetaCinema_Clone/admin/pages/seats/seats.php"><span class="fa fa-users mr-3"></span> SEATS</a>
					</li>
					<li class="active">
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
                <!-- BỘ LỌC -->
                <form class="d-flex justify-content-center align-items-center w-50" method="GET" action="">
                    <div class="form-group mr-2">
                        <label for="starttime" class="mr-2 text-white">Giờ bắt đầu</label>
                        <input type="time" name="starttime" class="form-control" value="<?= htmlspecialchars($_GET['starttime'] ?? '') ?>">
                    </div>
                    <div class="form-group mr-2">
                        <label for="endtime" class="mr-2 text-white">Giờ kết thúc</label>
                        <input type="time" name="endtime" class="form-control" value="<?= htmlspecialchars($_GET['endtime'] ?? '') ?>">
                    </div>
                    <div class="form-group mr-2">
                        <label for="showdate" class="mr-2 text-white">Ngày chiếu</label>
                        <input type="date" name="showdate" class="form-control" value="<?= htmlspecialchars($_GET['showdate'] ?? '') ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 ml-3"><i class="fa fa-filter"></i></button>
                    <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-secondary ml-3 mt-3"><i class="fa fa-refresh"></i></a>
                </form>
                <h1 class="text-center text-white">THÔNG TIN <br> SHOW TIMES</h1>
                <a href="/BetaCinema_Clone/admin/pages/showtimes/add_showtimes.php" class="btn btn-success">THÊM MỚI SHOW TIMES</a>
            </div>
            <table class="table table-bordered table-striped table-primary mt-3">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Showtime ID</th>
                        <th scope="col">Ngày chiếu</th>
                        <th scope="col">Giờ chiếu</th>
                        <th scope="col">Giờ kết thúc</th>
                        <th scope="col">Movie ID</th>
                        <th scope="col">Hall ID</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $stt = $offset + 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $stt++ . "</td>";
                            echo "<td>" . (!empty($row['ShowDate']) ? date("d/m/Y", strtotime($row['ShowDate'])) : "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($row['StartTime']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['EndTime']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MovieID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['HallID']) . "</td>";
                            echo "<td>
                                    <a href='/BetaCinema_Clone/admin/pages/showtimes/edit_showtimes.php?id=" . htmlspecialchars($row['ShowtimeID']) . "' class='btn btn-warning btn-sm'>SỬA</a>
                                    <a href='/BetaCinema_Clone/admin/pages/showtimes/delete_showtimes.php?id=" . htmlspecialchars($row['ShowtimeID']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc chắn muốn xoá ghế này không?');\">XOÁ</a>
                                </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>   
            <!-- PAGINATION -->
            <div class="d-flex justify-content-center mb-5">
                <ul class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage - 1 ?>&showdate=<?= urlencode($showdate) ?>&starttime=<?= urlencode($starttime) ?>&endtime=<?= urlencode($endtime) ?>">&#60;</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&showdate=<?= urlencode($showdate) ?>&starttime=<?= urlencode($starttime) ?>&endtime=<?= urlencode($endtime) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage + 1 ?>&showdate=<?= urlencode($showdate) ?>&starttime=<?= urlencode($starttime) ?>&endtime=<?= urlencode($endtime) ?>">&#62;</a>
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
<style>
    form{
        display: flex;
        justify-content: center;
        background: rgba(255, 255, 255, 0.5); 
        backdrop-filter: blur(20px); 
        border-radius: 10px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 10px;
    }

    label{
        font-weight: bold;
    }
</style>
</html>
