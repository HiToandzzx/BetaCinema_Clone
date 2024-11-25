<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS -->
    <link rel='stylesheet' href='/BetaCinema_Clone/styles/home.css'>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="/BetaCinema_Clone/js/home.js"></script>

    <title>Beta Cinemas Clone (home page)</title>
</head>

<body>
<?php
require 'config.php';

session_start();
?>

<!-- HEADER -->
<header style="background-color: black;">
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <span class="text-white">Xin chào, <?php echo $_SESSION['Fullname']; ?></span>
        <a class="btn" href="/BetaCinema_Clone/auth/logout.php"><i class="bi bi-box-arrow-left"></i></a>
    <?php else: ?>
        <a class="btn" href="/BetaCinema_Clone/auth/login.php">Đăng nhập</a>
        <span> | </span>
        <a class="btn" href="/BetaCinema_Clone/auth/register.php">Đăng ký</a>
    <?php endif; ?>
</header>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="/BetaCinema_Clone/assets/logo.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <form action="" method="post" id="cinemaForm" style="margin-right: 50px">
                    <select name="cinemas" id="cinemas" class="nav-link" onchange="submitForm()">
                        <option value="" selected>CHỌN RẠP PHIM</option>
                        <?php
                        $query = "SELECT * FROM `cinemas` ORDER BY `Location`";
                        $result = mysqli_query($connect, $query);

                        if (!$result) {
                            die("Query failed!" . mysqli_connect_error());
                        }

                        $cinemas_by_location = [];

                        while ($row = mysqli_fetch_array($result)) {
                            $location = $row['Location'];
                            $cinemas_by_location[$location][] = $row;
                        }

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $selectedCinemaID = isset($_POST['cinemas']) ? $_POST['cinemas'] : null;
                            $_SESSION['selectedCinemaID'] = $selectedCinemaID; // Lưu vào session
                        } else {
                            $selectedCinemaID = isset($_SESSION['selectedCinemaID']) ? $_SESSION['selectedCinemaID'] : null; // Lấy từ session nếu tồn tại
                        }

                        foreach ($cinemas_by_location as $location => $cinemas) {
                            echo "<optgroup label='" . htmlspecialchars($location) . "'>";
                            foreach ($cinemas as $cinema) {
                                $selected = ($cinema['CinemaID'] == $selectedCinemaID) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($cinema['CinemaID']) . "' $selected>" . htmlspecialchars($cinema['CinemaName']) . "</option>";
                            }
                            echo "</optgroup>";
                        }
                        ?>
                    </select>
                </form>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['selectedCinemaID']) && $_SESSION['selectedCinemaID'])
                        echo '<a class="nav-link main" href="/BetaCinema_Clone/pages/rap.php?cinema_id=' . $selectedCinemaID . '" style="margin-left: 15px">RẠP</a>';
                    else
                        echo '<a class="nav-link main" href="" style="margin-left: 15px" onclick="alert(\'Vui lòng chọn rạp phim.\')">RẠP</a>';
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['selectedCinemaID']) && $_SESSION['selectedCinemaID'])
                        echo '<a class="nav-link main" href="/BetaCinema_Clone/pages/gia_ve.php?cinema_id=' . $selectedCinemaID . '" style="margin-left: 15px">GIÁ VÉ</a>';
                    else
                        echo '<a class="nav-link main" href="" style="margin-left: 15px" onclick="alert(\'Vui lòng chọn rạp phim.\')">GIÁ VÉ</a>';
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link main" href="/BetaCinema_Clone/pages/news.php" style="margin-left: 15px">TIN MỚI VÀ ƯU ĐÃI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main" href="/BetaCinema_Clone/pages/nhuong_quyen.php" style="margin-left: 15px">NHƯỢNG QUYỀN</a>
                </li>
                <li class="nav-item dropdown">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <a class="nav-link main dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 15px">
                            THÀNH VIÊN
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/BetaCinema_Clone/pages/thong_tin_tk.php">Thông Tin Tài Khoản</a></li>
                            <li><a class="dropdown-item" href="/BetaCinema_Clone/pages/hanh_trinh_dien_anh.php">Hành trình điện ảnh</a></li>
                        </ul>
                    <?php else: ?>
                        <a class="nav-link main" href="/BetaCinema_Clone/auth/login.php" style="margin-left: 15px">THÀNH VIÊN</a>
                    <?php endif; ?>
                </li>
            </ul>
            <form class="d-flex" role="search" method="post">
                <input type="text" class="form-control search-movie" name="search" placeholder="Tìm kiếm phim..." aria-label="Search for movie" size="30">
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search" style="font-size:20px;"></i></button>
            </form>
        </div>
    </div>
</nav>

<!-- BUTTON BACK TO TOP -->
<button onclick="scrollToTop()" id="backToTopBtn" title="Go to top"><i class="bi bi-arrow-up-short"></i></button>

<!-- CAROUSEL -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button id="test" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button id="test" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button id="test" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button id="test" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button id="test" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/BetaCinema_Clone/assets/car_1.png" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
            <img src="/BetaCinema_Clone/assets/car_2.png" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
            <img src="/BetaCinema_Clone/assets/car_3.png" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
            <img src="/BetaCinema_Clone/assets/car_4.png" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
            <img src="/BetaCinema_Clone/assets/car_5.png" class="d-block w-100" alt="">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- TABS MOVIES -->
<div class="d-flex justify-content-center pt-5">
    <div class="container">
        <ul class="nav nav-tabs justify-content-center" id="movieTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming" aria-selected="false">PHIM SẮP CHIẾU</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="now-showing-tab" data-bs-toggle="tab" data-bs-target="#now-showing" type="button" role="tab" aria-controls="now-showing" aria-selected="true">PHIM ĐANG CHIẾU</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="special-tab" data-bs-toggle="tab" data-bs-target="#special" type="button" role="tab" aria-controls="special" aria-selected="false">SUẤT CHIẾU ĐẶC BIỆT</button>
            </li>
        </ul>

        <div class="tab-content" id="movieTabContent">
            <!-- TAB PHIM SẮP CHIẾU -->
            <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    $query = "SELECT * FROM `movies` WHERE status = 'Phim sắp chiếu'";
                    $result = mysqli_query($connect, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($connect));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        $releaseDate = DateTime::createFromFormat('Y-m-d', $row['ReleaseDate']);
                        $formattedDate = $releaseDate ? $releaseDate->format('d/m/Y') : '';

                        echo '<div class="card-group">';
                        echo '  <div class="card">';
                        echo '      <div class="image-container position-relative">';
                        echo '          <img src="' . htmlspecialchars($row['Pic']) . '" class="card-img-top" alt="' . htmlspecialchars($row['Title']) . '">';
                        echo '          <div class="overlay"></div>';
                        echo '          <a href="/BetaCinema_Clone/pages/play_trailer.php?movie_id=' . $row['MoviesID'] . '" class="play-button position-absolute"><i class="bi bi-play-circle-fill"></i></a>';
                        echo '      </div>';
                        echo '      <div class="card-body">';
                        echo '          <h5 class="card-title">' . htmlspecialchars($row['Title']) . '</h5>';
                        echo '          <p class="card-text">' . '<span>Thể loại: </span>' . $row['Genre'] . '</p>';
                        echo '          <p class="card-text">' . '<span>Thời lượng: </span>' . $row['Duration'] . ' phút' . '</p>';
                        echo '          <p class="card-text">' . '<span>Ngày khởi chiếu: </span>' . $formattedDate . '</p>';
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- TAB PHIM ĐANG CHIẾU -->
            <div class="tab-pane fade show active" id="now-showing" role="tabpanel" aria-labelledby="now-showing-tab">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    $search_term = "";

                    if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
                        $search_term = mysqli_real_escape_string($connect, trim($_POST['search']));
                        $query = "SELECT * FROM `movies` WHERE status = 'Phim đang chiếu' AND `Title` LIKE '%$search_term%'";
                    } else {
                        $query = "SELECT * FROM `movies` WHERE status = 'Phim đang chiếu'";
                    }

                    $result = mysqli_query($connect, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($connect));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card-group">';
                        echo '  <div class="card">';
                        echo '      <div class="image-container position-relative">';
                        echo '          <img src="' . htmlspecialchars($row['Pic']) . '" class="card-img-top" alt="' . htmlspecialchars($row['Title']) . '">';
                        echo '          <div class="overlay"></div>';
                        echo '          <a href="/BetaCinema_Clone/pages/play_trailer.php?movie_id=' . $row['MoviesID'] . '" class="play-button position-absolute" name="' . $row['MoviesID'] . '"><i class="bi bi-play-circle-fill"></i></a>';
                        echo '      </div>';
                        echo '      <div class="card-body">';
                        echo '          <h5 class="card-title">' . $row['Title'] . '</h5>';
                        echo '          <p class="card-text"><span>Thể loại: </span>' . $row['Genre'] . '</p>';
                        echo '          <p class="card-text"><span>Thời lượng: </span>' . $row['Duration'] . ' phút' . '</p>';
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                            if ($selectedCinemaID) {
                                echo '      <a href="/BetaCinema_Clone/pages/lich_chieu.php?cinema_id=' . $selectedCinemaID . '&movie_id=' . $row['MoviesID'] . '" class="btn btn-primary buy-ticket"><i class="bi bi-ticket-perforated-fill"></i>MUA VÉ</a>';
                            } else {
                                echo '      <button class="btn btn-primary buy-ticket" onclick="alert(\'Vui lòng chọn rạp phim trước khi mua vé.\')"><i class="bi bi-ticket-perforated-fill"></i>MUA VÉ</button>';
                            }
                        } else {
                            echo '      <a href="/BetaCinema_Clone/auth/login.php" class="btn btn-primary buy-ticket"><i class="bi bi-ticket-perforated-fill"></i>MUA VÉ</a>';
                        }
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- TAB SUẤT CHIẾU ĐẶC BIỆT -->
            <div class="tab-pane fade" id="special" role="tabpanel" aria-labelledby="special-tab">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    $query = "SELECT * FROM `movies` WHERE SpecialShow = '0'";
                    $result = mysqli_query($connect, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($connect));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card-group">';
                        echo '  <div class="card">';
                        echo '      <div class="image-container position-relative">';
                        echo '          <img src="' . htmlspecialchars($row['Pic']) . '" class="card-img-top" alt="' . htmlspecialchars($row['Title']) . '">';
                        echo '          <div class="overlay"></div>';
                        echo '          <a href="/BetaCinema_Clone/pages/play_trailer.php?movie_id=' . $row['MoviesID'] . '" class="play-button position-absolute" name="PlayTrailer"><i class="bi bi-play-circle-fill"></i></a>';
                        echo '      </div>';
                        echo '      <div class="card-body">';
                        echo '          <h5 class="card-title">' . $row['Title'] . '</h5>';
                        echo '          <p class="card-text">' . '<span>Thể loại: </span>' . $row['Genre'] . '</p>';
                        echo '          <p class="card-text">' . '<span>Thời lượng: </span>' . $row['Duration'] . ' phút' . '</p>';
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                            if ($selectedCinemaID) {
                                echo '      <a href="/BetaCinema_Clone/pages/lich_chieu.php?cinema_id=' . $selectedCinemaID . '&movie_id=' . $row['MoviesID'] . '" class="btn btn-primary buy-ticket"><i class="bi bi-ticket-perforated-fill"></i>MUA VÉ</a>';
                            } else {
                                echo '      <button class="btn btn-primary buy-ticket" onclick="alert(\'Vui lòng chọn rạp phim trước khi mua vé.\')"><i class="bi bi-ticket-perforated-fill"></i>MUA VÉ</button>';
                            }
                        } else {
                            echo '      <a href="/BetaCinema_Clone/auth/login.php" class="btn btn-primary buy-ticket"><i class="bi bi-ticket-perforated-fill"></i>MUA VÉ</a>';
                        }
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-white text-dark py-4 mt-5">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-2 col-sm-16">
                <img src="/BetaCinema_Clone/assets/logo.png" alt="Logo" style="width:180px; height:80px">
            </div>
            <div class="col-md-4 col-sm-16">
                <h3>CỤM RẠP BETA</h3>
                <ul>
                    <li>
                        <i class="bi bi-chevron-right"></i>
                        <a href="https://www.facebook.com/betacinemas/" class="cum-rap">Beta Cinemas Thanh Xuân, Hà Nội - Hotline 082 4812878</a>
                    </li>
                    <li>
                        <i class="bi bi-chevron-right"></i>
                        <a href="https://www.facebook.com/betacinemas/" class="cum-rap">Beta Cinemas Mỹ Đình, Hà Nội - Hotline 0866 154 610</a>
                    </li>
                    <li>
                        <i class="bi bi-chevron-right"></i>
                        <a href="https://www.facebook.com/betacinemas/" class="cum-rap">Beta Cinemas Nha Trang, Khánh Hòa - Hotline 0399 475 165</a>
                    </li>
                    <li>
                        <i class="bi bi-chevron-right"></i>
                        <a href="https://www.facebook.com/betacinemas/" class="cum-rap">Beta Cinemas Trần Quang Khải, TP Hồ Chí Minh - Hotline 1900 638 362</a>
                    </li>
                    <li>
                        <i class="bi bi-chevron-right"></i>
                        <a href="https://www.facebook.com/betacinemas/" class="cum-rap">Beta Cinemas Quang Trung, TP Hồ Chí Minh - Hotline 0706 075 509</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-16">
                <h3>KẾT NỐI</h3>
                <a href="https://www.facebook.com/betacinemas/"><i class="bi bi-facebook"></i></a>
                <a href="https://www.youtube.com/channel/UCGj6uah35-eNiH_2mdubYRw"><i class="bi bi-youtube"></i></a>
                <a href="https://www.tiktok.com/@beta_cinemas"><i class="bi bi-tiktok"></i></a>
                <a href="https://www.instagram.com/betacinemas/"><i class="bi bi-instagram"></i></a>
                <img class="mt-3" src="https://betacinemas.vn/Assets/Common/logo/dathongbao.png" alt="" style="width:220px; height:80px">
            </div>
            <div class="col-md-3 col-sm-16">
                <h3>LIÊN HỆ</h3>
                <h5>CÔNG TY CỔ PHẦN BETA MEDIA</h5>
                <p>Giấy chứng nhận ĐKKD số: 0106633482 - Đăng ký lần đầu ngày 08/09/2014 tại Sở Kế hoạch và Đầu tư Thành phố Hà Nội</p>
                <p>Địa chỉ trụ sở: Tầng 3, số 595, đường Giải Phóng, phường Giáp Bát, quận Hoàng Mai, thành phố Hà Nội</p>
                <p>Hotline: 1900 636807 / 0934632682</p>
                <p>Email: mkt@betacinemas.vn</p>
                <h4 style="font-weight:bold; margin-bottom: 20px">Liên hệ hợp tác kinh doanh:</h4>
                <h5>Hotline: 1800 646 420</h5>
                <h5>Email: bachtx@betagroup.vn</h5>
            </div>
        </div>
    </div>
</footer>
</body>
<style>
    .nav-link{
        color: #333;
        font-weight: bold;
        font-size: 16px;
    }

    #cinemas{
        border: solid 1px #ccc;
        border-radius: 16px;
        float: left;
        line-height: 1.2;
        min-height: 31px;
        font-size: 15px;
    }

    .nav-tabs .nav-link {
        font-weight: bold;
        color: #333;
        font-size: 25px;
    }
</style>
</html>