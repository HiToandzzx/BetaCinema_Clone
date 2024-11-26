<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/BetaCinema_Clone/admin/pages/index/css/style.css">
    <link rel="stylesheet" href="/BetaCinema_Clone/styles/admin.css">
    <title>PAYMENTS</title>
</head>
<body>
    <?php
        session_start();
        require 'config.php';

        // Pagination setup
        $rowsPerPage = 4;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($currentPage < 1) $currentPage = 1;
        $offset = ($currentPage - 1) * $rowsPerPage;

        // Filters
        $search = $_GET['search'] ?? '';
        $paymentMethod = $_GET['PaymentMethod'] ?? '';
        $movieTitle = $_GET['MovieTitle'] ?? '';
        $paymentDate = $_GET['payment_date'] ?? '';
        $groupBy = $_GET['group_by'] ?? 'none';
        $CinemaName = $_GET['CinemaName'] ?? '';
        $HallName = $_GET['HallName'] ?? '';

        // Sort order (asc hoặc desc)
        $sortOrder = isset($_GET['sort_order']) && in_array($_GET['sort_order'], ['asc', 'desc']) ? $_GET['sort_order'] : 'asc'; // Mặc định là 'asc'

        // Base query
        if ($groupBy === 'day') {
            $query = "SELECT PaymentDate, SUM(TotalPrice) as TotalAmount FROM payments WHERE 1=1";
        } elseif ($groupBy === 'month') {
            $query = "SELECT DATE_FORMAT(PaymentDate, '%Y-%m') as PaymentMonth, SUM(TotalPrice) as TotalAmount FROM payments WHERE 1=1";
        } elseif ($groupBy === 'year') {
            $query = "SELECT YEAR(PaymentDate) as PaymentYear, SUM(TotalPrice) as TotalAmount FROM payments WHERE 1=1";
        } else {
            $query = "SELECT * FROM payments WHERE 1=1";
        }

        // Kiểm tra và xử lý tìm kiếm theo ngày
        if (!empty($search)) {
            // Chuyển dấu "/" thành "-"
            $search = str_replace('/', '-', $search);

            // Tìm kiếm theo ngày, tháng, năm
            if (preg_match("/^\d{1,2}$/", $search)) {
                // Chỉ có ngày (ví dụ 14)
                $query .= " AND DAY(PaymentDate) = '$search'";
            } elseif (preg_match("/^\d{1,2}[-]\d{1,2}$/", $search)) {
                // Ngày và tháng (ví dụ 14-11)
                $searchArr = explode('-', $search);
                $day = $searchArr[0];
                $month = $searchArr[1];
                $query .= " AND DAY(PaymentDate) = '$day' AND MONTH(PaymentDate) = '$month'";
            } elseif (preg_match("/^\d{1,2}[-]\d{1,2}[-]\d{4}$/", $search)) {
                // Ngày, tháng, năm (ví dụ 14-11-2024)
                $searchArr = explode('-', $search);
                $day = $searchArr[0];
                $month = $searchArr[1];
                $year = $searchArr[2];
                $query .= " AND DAY(PaymentDate) = '$day' AND MONTH(PaymentDate) = '$month' AND YEAR(PaymentDate) = '$year'";
            } else {
                // Tìm kiếm theo các trường khác (HallName, MovieTitle, PaymentMethod, CinemaName)
                $searchEscaped = mysqli_real_escape_string($connect, $search);
                $query .= " AND (HallName LIKE '%$searchEscaped%' OR MovieTitle LIKE '%$searchEscaped%' OR PaymentMethod LIKE '%$searchEscaped%' OR CinemaName LIKE '%$searchEscaped%')";
            }
        }

        // Grouping if applicable
        if ($groupBy === 'day') {
            $query .= " GROUP BY PaymentDate";
        } elseif ($groupBy === 'month') {
            $query .= " GROUP BY PaymentMonth";
        } elseif ($groupBy === 'year') {
            $query .= " GROUP BY PaymentYear";
        }

        // Thêm phần sắp xếp theo ngày thanh toán
        $query .= " ORDER BY PaymentDate $sortOrder"; // Sắp xếp theo ngày thanh toán (tăng dần hoặc giảm dần)

        // Count total rows for pagination
        $countQuery = "SELECT COUNT(*) AS total FROM ($query) as subquery";
        $countResult = mysqli_query($connect, $countQuery);
        $totalRows = mysqli_fetch_assoc($countResult)['total'];
        $totalPages = ceil($totalRows / $rowsPerPage);

        // Add LIMIT for pagination
        $query .= " LIMIT $offset, $rowsPerPage";
        $result = mysqli_query($connect, $query);
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
                    <li>
                        <a href="/BetaCinema_Clone/admin/pages/showtimes/show_times.php"><span class="fa fa-video-camera mr-3"></span> SHOWTIMES</a>
                    </li>
                    <li class="active">
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

        <div id="content" class="bg-img p-5">
            <div class="rounded w-100">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
                    <!-- BỘ LỌC DOANH THU -->
                    <form class="d-flex justify-content-center align-items-center w-50" method="GET" action="">
                        <div class="row w-100">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="group_by" class="text-white">Thống kê theo</label>
                                    <select class="form-select" id="group_by" name="group_by">
                                        <option value="day" <?php if ($groupBy == 'day') echo 'selected'; ?>>Ngày</option>
                                        <option value="month" <?php if ($groupBy == 'month') echo 'selected'; ?>>Tháng</option>
                                        <option value="year" <?php if ($groupBy == 'year') echo 'selected'; ?>>Năm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="sort_order" class="text-white">Sắp xếp</label>
                                    <select class="form-select" id="sort_order" name="sort_order" >
                                        <option value="asc" <?= isset($sortOrder) && $sortOrder === 'asc' ? 'selected' : '' ?>>Tăng dần</option>
                                        <option value="desc" <?= isset($sortOrder) && $sortOrder === 'desc' ? 'selected' : '' ?>>Giảm dần</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 text-center" style="margin-top: 33px">
                                <button type="submit" class="btn btn-primary me-2"><i class="fa fa-filter"></i></button>
                                <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-secondary"><i class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </form>
                    <h1 class="text-center text-white">THÔNG TIN PAYMENTS</h1>
                    <a href="/BetaCinema_Clone/admin/pages/payments/add_payments.php" class="btn btn-success">THÊM MỚI PAYMENTS</a>
                </div>
            </div>
            <table class="table table-bordered table-striped table-primary mt-3">
                <thead>
                    <tr class="text-center font1">
                        <?php if ($groupBy === 'none') { ?>
                            <th scope="col">ID</th>
                            <th scope="col">NGÀY TT</th>
                            <th scope="col">PTTT</th>
                            <th scope="col">ID USERS</th>
                            <th scope="col">TÊN PHIM</th>
                            <th scope="col">RẠP CHIẾU</th>
                            <th scope="col">NGÀY CHIẾU</th>
                            <th scope="col">PHÒNG CHIẾU</th>
                            <th scope="col">GIỜ CHIẾU</th>
                            <th scope="col">GHẾ NGỒI</th>
                            <th scope="col">TỔNG GIÁ</th>
                            <th scope="col">Function</th>
                        <?php } else { ?>
                            <th scope="col">
                                <?php
                                if ($groupBy === 'day') echo "NGÀY";
                                elseif ($groupBy === 'month') echo "THÁNG";
                                elseif ($groupBy === 'year') echo "NĂM";
                                ?>
                            </th>
                            <th scope="col">TỔNG THANH TOÁN</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($groupBy !== 'none') {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr class='text-center'>";
                                if ($groupBy === 'day') {
                                    echo "<td>" . date("d/m/Y", strtotime($row['PaymentDate'])) . "</td>";
                                } elseif ($groupBy === 'month') {
                                    echo "<td>" . date("m/Y", strtotime($row['PaymentMonth'])) . "</td>";
                                } elseif ($groupBy === 'year') {
                                    echo "<td>" . date("Y", strtotime($row['PaymentYear'])) . "</td>";
                                }
                                echo "<td>" . number_format($row['TotalAmount'], 0, ',', '.') . " VNĐ</td>";
                                echo "</tr>";
                            }
                        } else {
                            $stt = $offset + 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr class='text-center'>";
                                echo "<td>".$stt++."</td>";
                                echo "<td>" . (!empty($row['PaymentDate']) ? date("d/m/Y", strtotime($row['PaymentDate'])) : "N/A") . "</td>";
                                echo "<td>" . htmlspecialchars($row['PaymentMethod']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['UserID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['MovieTitle']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['CinemaName']) . "</td>";
                                echo "<td>" . (!empty($row['ShowDate']) ? date("d/m/Y", strtotime($row['ShowDate'])) : "N/A") . "</td>";
                                echo "<td>" . htmlspecialchars($row['HallName']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['StartTime']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Seats']) . "</td>";
                                echo "<td>" . number_format($row['TotalPrice'], 0, ',', '.') . " VNĐ</td>";
                                echo "<td>
                                        <a href='/BetaCinema_Clone/admin/pages/payments/edit_payments.php?id=" . htmlspecialchars($row['PaymentID']) . "' class='btn btn-warning btn-sm'>SỬA</a> <br>
                                        <a href='/BetaCinema_Clone/admin/pages/payments/delete_payments.php?id=" . htmlspecialchars($row['PaymentID']) . "' class='btn btn-danger btn-sm mt-1' onclick=\"return confirm('Bạn có chắc chắn muốn xoá user này không?');\">XOÁ</a>
                                    </td>";
                                echo "</tr>";
                            }
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

        <script src="/BetaCinema_Clone/admin/pages/index/js/jquery.min.js"></script>
        <script src="/BetaCinema_Clone/admin/pages/index/js/popper.js"></script>
        <script src="/BetaCinema_Clone/admin/pages/index/js/bootstrap.min.js"></script>
        <script src="/BetaCinema_Clone/admin/pages/index/js/main.js"></script>
    </div>
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
