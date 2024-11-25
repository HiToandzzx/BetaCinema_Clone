<?php
    session_start();
    include './config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if (!isset($_GET['id'])) {
        die("PaymentID not provided.");
    }

    $id = intval($_GET['id']); 

    // Lấy thông tin vé từ cơ sở dữ liệu
    $query = "SELECT * FROM payments WHERE PaymentID = $id";
    $result = mysqli_query($connect, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        die("PaymentID not found.");
    }

    // Lấy dữ liệu vé
    $payment = mysqli_fetch_assoc($result);
    $userID = $_SESSION['UserID'];
    $email = $_SESSION['Email'];
    $movie_title = $payment['MovieTitle'];
    $show_date = $payment['ShowDate'];
    $start_time = $payment['StartTime'];
    $hall_name = $payment['HallName'];
    $selected_seats = $payment['Seats'];
    $total_price = $payment['TotalPrice'];
    $payment_method = $payment['PaymentMethod'];

    // Xóa bản ghi khỏi cơ sở dữ liệu
    $deleteQuery = "DELETE FROM payments WHERE PaymentID = $id";
    if (mysqli_query($connect, $deleteQuery)) {
        // Gửi email thông báo đã hủy vé
        require __DIR__ . '/../vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  
            $mail->SMTPAuth   = true;
            $mail->Username   = 'betacinema.clone@gmail.com'; 
            $mail->Password   = 'hqvqbvtopyuebjby'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->CharSet = 'UTF-8';

            // Thiết lập thông tin người gửi và người nhận
            $mail->setFrom('betacinema.clone@gmail.com', 'Beta Cinema Clone');
            $mail->addAddress($email); // Email người nhận

            // Đính kèm logo
            $mail->addEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/BetaCinema_Clone/assets/logo.png', 'logo_cid');

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'THÔNG BÁO HUỶ VÉ';
            $mail->Body    = '
                <h2>Vé của bạn đã được huỷ!</h2>
                <img src="cid:logo_cid" alt="Logo" style="width: 200px; height: auto;">
                <p>Thông tin vé bạn đã huỷ:</p>
                <ul>
                    <li><strong>Phim:</strong> ' . $movie_title . '</li>
                    <li><strong>Ngày chiếu:</strong> ' . date("d/m/Y", strtotime($show_date)) . '</li>
                    <li><strong>Giờ chiếu:</strong> ' . date("H:i", strtotime($start_time)) . '</li>
                    <li><strong>Phòng chiếu:</strong> ' . $hall_name . '</li>
                    <li><strong>Số ghế:</strong> ' . $selected_seats . '</li>
                    <li><strong>Tổng giá:</strong> ' . $total_price . ' VND</li>
                    <li><strong>Phương thức thanh toán:</strong> ' . $payment_method . '</li>
                </ul>
                <p>Nếu có sai sót hãy liên hệ hotline 1800 646 420!</p>
            ';
            $mail->AltBody = 'Cảm ơn bạn đã tin tưởng Beta Cinema!';

            // Gửi email
            $mail->send();
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }

    } else {
        die("Error deleting: " . mysqli_error($connect));
    }     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='/BetaCinema_Clone/styles/thank.css'>
    <title>Refund</title>
</head>
<body>
    <div class="container mt-5 text-center">
        <img class="mb-5" src="/BetaCinema_Clone/assets/logo.png" alt="Logo">
        <h5 class="mb-5">BẠN ĐÃ HUỶ VÉ THÀNH CÔNG</h5>
        <h5 class="mb-5">THÔNG TIN VÉ HUỶ ĐÃ ĐƯỢC GỬI VÀO EMAIL CỦA BẠN</h5>
        <a href="/BetaCinema_Clone/pages/index.php" class="btn col-12 w-50 mt-3">
            TRANG CHỦ
        </a>
    </div>
</body>
</html>
