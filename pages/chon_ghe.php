<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Chọn ghế</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="/BetaCinema_Clone/js/chon_ghe.js"></script>
    <link rel='stylesheet' href='/BetaCinema_Clone/styles/chon_ghe.css'>
</head>
<body>
    <?php
        require 'config.php';

        // Nhận dữ liệu từ form
        $cinema_id = $_POST['cinema_id'];
        $movie_id = $_POST['movie_id'];
        $show_date = $_POST['showdate'];
        $start_time = $_POST['starttime'];

        // Lấy thông tin phim
        $query_movie = "SELECT * FROM `movies` WHERE MoviesID = '$movie_id'";
        $result_movie = mysqli_query($connect, $query_movie);
        if (!$result_movie) {
            die("Query failed: " . mysqli_error($connect));
        }
        $movie = mysqli_fetch_assoc($result_movie);
        $movie_title = $movie['Title'];
        $movie_pic = $movie['Pic'];
        $movie_type = $movie['Type'];
        $movie_genra = $movie['Genre'];
        $movie_duration = $movie['Duration'];

        // Lấy tên rạp chiếu từ bảng cinemas
        $query_cinema = "SELECT CinemaName FROM `cinemas` WHERE CinemaID = '$cinema_id'";
        $result_cinema = mysqli_query($connect, $query_cinema);
        if (!$result_cinema) {
            die("Query failed: " . mysqli_error($connect));
        }
        $cinema = mysqli_fetch_assoc($result_cinema);
        $cinema_name = $cinema['CinemaName'];

        // Lấy HallID và HallName từ bảng show_times và halls
        $query_hall = "
            SELECT halls.HallID, halls.HallName 
            FROM `show_times`
            JOIN `halls` ON show_times.HallID = halls.HallID
            WHERE show_times.MovieID = '$movie_id' AND show_times.ShowDate = '$show_date' AND show_times.StartTime = '$start_time'
        ";
        $result_hall = mysqli_query($connect, $query_hall);
        if (!$result_hall) {
            die("Query failed: " . mysqli_error($connect));
        }
        $hall = mysqli_fetch_assoc($result_hall);
        $hall_id = $hall['HallID'];
        $hall_name = $hall['HallName'];

        // Truy vấn bảng seats để lấy các SeatNumber theo HallID
        $query_seats = "SELECT * FROM `seats` WHERE HallID = '$hall_id'";
        $result_seats = mysqli_query($connect, $query_seats);
        if (!$result_seats) {
            die("Query failed: " . mysqli_error($connect));
        }
    ?>

    <div class="container">
        <form action="/BetaCinema_Clone/pages/thanh_toan.php" method="post">
            <div class="row">
                <!-- CHỌN GHẾ -->
                <div class="col-12 col-md-6 mb-4 mb-md-0 mt-5">
                    <div class="row p-3">
                        <img src="/BetaCinema_Clone/assets/ic-screen.png" alt="Logo" class="img-fluid">
                        <p class="text-start mb-4" style="font-size: 20px">Lối Vào</p>
                        <?php
                            $query_payment = "SELECT Seats FROM `payments` WHERE 
                                            MovieTitle = '$movie_title' AND 
                                            CinemaName = '$cinema_name' AND 
                                            ShowDate = '$show_date' AND 
                                            HallName = '$hall_name' AND 
                                            StartTime = '$start_time'";
                            $result_payment = mysqli_query($connect, $query_payment);

                            // Tạo mảng lưu tất cả các ghế đã đặt
                            $booked_seats = [];
                            if ($result_payment) {
                                while ($row_payment = mysqli_fetch_assoc($result_payment)) {
                                    $seats_string = $row_payment['Seats']; 
                                    $seats_array = explode(", ", $seats_string); 
                                    $booked_seats = array_merge($booked_seats, $seats_array); 
                                }
                            } else {
                                die("Query failed: " . mysqli_error($connect));
                            }

                            // Truy vấn lấy tất cả ghế từ bảng seats theo HallID
                            $query_seats = "SELECT * FROM `seats` WHERE HallID = '$hall_id'";
                            $result_seats = mysqli_query($connect, $query_seats);

                            if (!$result_seats) {
                                die("Query failed: " . mysqli_error($connect));
                            }

                            // Hiển thị ghế
                            $counter = 0;
                            echo '<div class="d-flex flex-wrap justify-content-center gap-2">';
                            while ($row_seat = mysqli_fetch_assoc($result_seats)) {
                                $seat_number = htmlspecialchars($row_seat['SeatNumber']);
                                $is_vip = $row_seat['VIP'];
                                $is_couple = $row_seat['Couple'];

                                // Kiểm tra loại ghế
                                if ($is_vip == 1) {
                                    $btn_class = 'btn-info'; // Ghế VIP
                                    $seat_type = 'vip';
                                } elseif ($is_couple == 1) {
                                    $btn_class = 'btn-warning'; // Ghế Couple
                                    $seat_type = 'couple';
                                } else {
                                    $btn_class = 'btn-secondary'; // Ghế Thường
                                    $seat_type = 'regular';
                                }

                                // Kiểm tra nếu ghế đã được đặt
                                if (in_array($seat_number, $booked_seats)) {
                                    $btn_class = 'btn-danger'; // Ghế Đã Đặt
                                    $disabled = 'disabled';   // Không thể chọn
                                } else {
                                    $disabled = ''; // Ghế có thể chọn
                                }

                                // Tạo nút hiển thị ghế
                                if ($counter % 5 == 0 && $counter > 0) {
                                    echo '</div><div class="d-flex flex-wrap justify-content-center gap-2">';
                                }

                                echo '<div class="col-sm-3 col-md-2 mb-3 w-10">';
                                echo '<button type="button" class="btn ' . $btn_class . ' w-100" onclick="toggleSeat(this, \'' . $seat_type . '\', \'' . $seat_number . '\')" ' . $disabled . '>' . $seat_number . '</button>';
                                echo '</div>';

                                $counter++;
                            }
                            echo '</div>';
                        ?>

                        <div class="row" style="margin-left: 1px">
                            <div class="col-6 col-md-3">
                                <p class="badge bg-secondary py-3 w-100">
                                    Ghế Thường <br>(45.000 VNĐ)
                                </p>
                            </div>
                            <div class="col-6 col-md-3">
                                <p class="badge bg-info text-dark py-3 w-100">
                                    Ghế VIP <br>(70.000 VNĐ)
                                </p>
                            </div>
                            <div class="col-6 col-md-3 mt-3 mt-md-0">
                                <p class="badge bg-warning text-dark py-3 w-100">
                                    Ghế Couple <br>(120.000 VNĐ)
                                </p>
                            </div>
                            <div class="col-6 col-md-3 mt-3 mt-md-0">
                                <p class="badge bg-danger py-3 w-100">
                                    Ghế <br> Đã Đặt
                                </p>
                            </div>
                        </div>
                        <div class="text-center text-white mt-3">
                            <p><strong>Thời gian còn lại: <span id="countdown-timer" style="font-size: 30px"> 10:00</span></strong></p>
                        </div>
                    </div>
                </div>

                <!-- THÔNG TIN PHIM -->
                <div class="col-12 col-md-6 mt-3">
                    <div class="row">
                        <div class="col-12 col-sm-5 mb-4 mb-sm-0">
                            <img src="<?php echo htmlspecialchars($movie_pic); ?>" class="w-100 img-movie img-fluid" alt="<?php echo htmlspecialchars($movie_title); ?>">
                        </div>
                        <div class="col-12 col-sm-7">
                            <div class="row">
                                <h1 class="text-center mb-4"><?php echo htmlspecialchars($movie_title); ?></h1>
                                <input type="hidden" name="movie_title" value="<?php echo htmlspecialchars($movie_title); ?>">
                                <table class="table table-borderless">
                                    <tr>
                                        <th><i class="bi bi-blockquote-left"></i>Chế độ</th>
                                        <td><?php echo htmlspecialchars($movie_type); ?></td>
                                        <input type="hidden" name="movie_type" value="<?php echo htmlspecialchars($movie_type); ?>">
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-file-earmark-text"></i>Thể loại</th>
                                        <td><?php echo htmlspecialchars($movie_genra); ?></td>
                                        <input type="hidden" name="movie_genra" value="<?php echo htmlspecialchars($movie_genra); ?>">
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-alarm"></i>Thời lượng</th>
                                        <td><?php echo htmlspecialchars($movie_duration); ?> phút</td>
                                        <input type="hidden" name="movie_duration" value="<?php echo htmlspecialchars($movie_duration); ?>">
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-bank"></i>Rạp chiếu</th>
                                        <td><?php echo htmlspecialchars($cinema_name); ?></td>
                                        <input type="hidden" name="cinema_name" value="<?php echo htmlspecialchars($cinema_name); ?>">
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-calendar-check"></i>Ngày chiếu</th>
                                        <td><?php echo htmlspecialchars(date("d/m/Y", strtotime($show_date))); ?></td>
                                        <input type="hidden" name="show_date" value="<?php echo htmlspecialchars($show_date); ?>">
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-alarm"></i>Giờ chiếu</th>
                                        <td><?php echo htmlspecialchars(date("H:i", strtotime($start_time))); ?></td>
                                        <input type="hidden" name="start_time" value="<?php echo htmlspecialchars($start_time); ?>">
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-tv"></i>Phòng chiếu</th>
                                        <td><?php echo htmlspecialchars($hall_name); ?></td>
                                        <input type="hidden" name="hall_name" value="<?php echo htmlspecialchars($hall_name); ?>">
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-boxes"></i></i>Ghế ngồi</th>
                                        <td id="selected-seats"></td>
                                        <input type="hidden" id="selected-seats-input" name="selected_seats" value="">
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-coin"></i>Tổng giá</th>
                                        <td id="total-price">0 VNĐ</td>
                                        <input type="hidden" id="total-price-input" name="total_price" value="">
                                    </tr>
                                </table>
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn btn-back col-12 w-100 mt-3" onclick="history.go(-1)">QUAY LẠI</a>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-next w-100 mt-3">
                                            TIẾP TỤC
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </form>
    </div>
</body>
<style>
    .img-movie{
        height: 100%;
        border-radius: 20px;
    }

    .table th, .table td {
        font-size: 15px;
    }

    .btn-next, .btn-back{
        font-size: 15px;
    }

    p{
        margin-top: 10px;
    }
</style>
</html>
