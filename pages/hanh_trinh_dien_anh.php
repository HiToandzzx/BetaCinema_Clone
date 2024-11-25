<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel='stylesheet' href='/BetaCinema_Clone/styles/home.css'>
    <!-- CSS -->
    <link rel='stylesheet' href='/BetaCinema_Clone/styles/thanh_vien.css'>

    <title>Hành trình điện ảnh</title>
</head>
<script>
    setTimeout(function() {
        var messageElement = document.getElementById("mess");
        if (messageElement) {
            messageElement.style.display = "none";
        }
    }, 2000); 

    setTimeout(function() {
        var messageElement = document.getElementById("error");
        if (messageElement) {
            messageElement.style.display = "none";
        }
    }, 2000); 
</script>
<body>
    <?php
        require 'config.php';
        session_start();

        $userID = $_SESSION['UserID'] ?? null;

        $query = "SELECT * FROM `payments` WHERE UserID = '$userID'";
        $result = mysqli_query($connect, $query);

        if (!$result) {
            die("Query Failed: " . mysqli_error($connect));
        }

        $rowsPerPage = 2;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $rowsPerPage;

        $query = "SELECT * FROM payments WHERE UserID = '$userID' LIMIT $offset, $rowsPerPage";
        $countQuery = "SELECT COUNT(*) AS total FROM payments WHERE UserID = '$userID'";

        $countResult = mysqli_query($connect, $countQuery);
        $totalRows = mysqli_fetch_assoc($countResult)['total'];
        $result = mysqli_query($connect, $query);
        $totalPages = ceil($totalRows / $rowsPerPage);
    ?>

    <div class="container">
        <h3 class="text-center">HÀNH TRÌNH ĐIỆN ẢNH</h3>
        <div class="row row-cols-1">
            <?php
                $stt = $offset + 1;
                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table table-bordered text-center mt-4">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>MÃ HOÁ ĐƠN</th>';
                    echo '<th>NGÀY ĐẶT</th>';
                    echo '<th>PHIM</th>';
                    echo '<th>RẠP CHIẾU</th>';
                    echo '<th>NGÀY CHIẾU</th>';
                    echo '<th>RẠP</th>';
                    echo '<th>SUẤT CHIẾU</th>';
                    echo '<th>GHẾ ĐÃ ĐẶT</th>';
                    echo '<th>PTTT</th>';
                    echo '<th>TỔNG GIÁ</th>';
                    echo '<th>CHỨC NĂNG</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    date_default_timezone_set('Asia/Ho_Chi_Minh');

                    // Fetch the current date and time in Vietnam's time zone
                    $currentDate = date("Y-m-d");
                    $currentTime = date("H:i");

                    while ($row = mysqli_fetch_assoc($result)) {
                        $formattedTotalPrice = number_format($row['TotalPrice'], 0, ',', '.');
                        $formattedShowDate = date("d/m/Y", strtotime($row['ShowDate']));
                        $formattedPaymentDate = date("d/m/Y", strtotime($row['PaymentDate']));
                        $formattedStartTime = date("H:i", strtotime($row['StartTime']));
                    
                        // Kiểm tra điều kiện hiển thị REFUND
                        $showDate = $row['ShowDate'];
                        $startTime = $row['StartTime'];
                        
                        // Combine show date and start time into a datetime string
                        $showDateTime = $showDate . ' ' . $startTime;
                        $showDateTimeTimestamp = strtotime($showDateTime);
                        
                        // Get the current datetime
                        $currentDateTime = date("Y-m-d H:i");
                        $currentDateTimeTimestamp = strtotime($currentDateTime);
                        
                        // Calculate the difference in hours between the current time and the show time
                        $timeDifferenceInSeconds = $showDateTimeTimestamp - $currentDateTimeTimestamp;
                        $timeDifferenceInHours = $timeDifferenceInSeconds / 3600; // Convert seconds to hours

                        // Check if the refund is available (showtime is at least 6 hours away)
                        $showRefundButton = ($timeDifferenceInHours >= 6);
                    
                        echo '<tr>';
                        echo '<td>' . $stt++ . '</td>';
                        echo '<td>' . htmlspecialchars($formattedPaymentDate) . '</td>';
                        echo '<td>' . htmlspecialchars($row['MovieTitle']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['CinemaName']) . '</td>';
                        echo '<td>' . htmlspecialchars($formattedShowDate) . '</td>';
                        echo '<td>' . htmlspecialchars($row['HallName']) . '</td>';
                        echo '<td>' . htmlspecialchars($formattedStartTime) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Seats']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['PaymentMethod']) . '</td>';
                        echo '<td>' . htmlspecialchars($formattedTotalPrice) . '</td>';
                        echo "<td>";
                        if ($showRefundButton) {
                            echo "<a href='/BetaCinema_Clone/pages/refund.php?id=" . htmlspecialchars($row['PaymentID']) . "' class='btn btn-danger btn-sm mt-1' onclick=\"return confirm('Bạn có chắc chắn muốn hoàn vé?');\">REFUND</a>";
                        }
                        echo "</td>";
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<div class="d-flex justify-content-center">';
                    echo '<img class="cart" src="/BetaCinema_Clone/assets/cart-empty.png" alt="">';
                    echo '</div>';
                }
                mysqli_free_result($result);
            ?>                 
            
            <!-- PAGINATION -->
            <div class="d-flex justify-content-center">
                <ul class="pagination">
                    <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?tab=history&page=<?= $currentPage - 1 ?>">&lt;</a>
                    </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                        <a class="page-link" href="?tab=history&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?tab=history&page=<?= $currentPage + 1 ?>">&gt;</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col">
                <a href="/BetaCinema_Clone/pages/index.php" class="btn btn-back col-12 w-100 mt-3">QUAY LẠI</a>
            </div>
        </div>
    </div>
</body>
<style>
    body { 
        font-size: 15px;
    }

    .form-control{
        font-size: 15px;
    }

    .nav-tabs .nav-link {
        font-weight: bold;
        color: #333;
        font-size: 20px;
    }

    .btn-next, .btn-back{
        font-size: 15px;
    }

    .table{
        border-radius: 20px;
        table-layout: fixed;
    }

    .table th, .table td {
        background: none; 
        font-size: 18px;
    }

    .container{
        max-width: 1300px; 
    }

    .cart{
        width: 350px;
        height: auto;
    }
</style>
</html>