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
    <title>USERS</title>
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
            $countQuery = "SELECT COUNT(*) AS total FROM users WHERE Fullname LIKE '%$search%' OR Email LIKE '%$search%'";
            $query = "SELECT * FROM users WHERE Fullname LIKE '%$search%' OR Email LIKE '%$search%' LIMIT $offset, $rowsPerPage";
        } else {
            $countQuery = "SELECT COUNT(*) AS total FROM users";
            $query = "SELECT * FROM users LIMIT $offset, $rowsPerPage";
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
					<li class="active">
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
                <h1 class="text-center text-white">THÔNG TIN USERS</h1>
                <a href="/BetaCinema_Clone/admin/pages/users/add_users.php" class="btn btn-success">THÊM MỚI USER</a>
            </div>
            <table class="table table-bordered table-striped table-primary mt-3">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mật khẩu</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Role</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $stt = $offset + 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $stt++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['Fullname']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Pass_word']) . "</td>";
                            echo "<td>" . (!empty($row['Dob']) ? date("d/m/Y", strtotime($row['Dob'])) : "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($row['Sex']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Phone']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Role']) . "</td>";
                            echo "<td>";
                            
                            if ($row['Role'] == 0) {
                                echo "<a href='/BetaCinema_Clone/admin/pages/users/edit_users.php?id=" . htmlspecialchars($row['UserID']) . "' class='btn btn-warning btn-sm'>SỬA</a> <br>";
                            } else {
                                echo "<a href='/BetaCinema_Clone/admin/pages/users/edit_users.php?id=" . htmlspecialchars($row['UserID']) . "' class='btn btn-warning btn-sm'>SỬA</a> <br>";
                                echo "<a href='/BetaCinema_Clone/admin/pages/users/delete_users.php?id=" . htmlspecialchars($row['UserID']) . "' class='btn btn-danger btn-sm mt-1' onclick=\"return confirm('Bạn có chắc chắn muốn xoá user này không?');\">XOÁ</a>";
                            }
                            
                            echo "</td>";
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