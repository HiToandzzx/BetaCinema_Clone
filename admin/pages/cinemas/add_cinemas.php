<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ADD CINEMA</title>
</head>
<body>
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $pic = $_POST['pic'];
    $map = $_POST['map'];
    $giave = $_POST['giave'];
    $hotline = $_POST['hotline'];

    $query = "INSERT INTO cinemas (CinemaName, Address, Location, Pic, Map, GiaVe, Hotline) 
              VALUES ('$name', '$address', '$location', '$pic', '$map', '$giave', '$hotline')";

    if (mysqli_query($connect, $query)) {
        header("Location: /BetaCinema_Clone/admin/pages/index.php?message=Cinema added successfully.");
        exit();
    } else {
        $error = "Error: " . mysqli_error($connect);
    }
}
?>

<div class="container w-50">
    <h2 class="text-center text-success mb-4">THÊM MỚI CINEMA</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="row mt-5">
            <div class="col">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="mb-3">
                    <label for="pic" class="form-label">Picture URL</label>
                    <input type="text" class="form-control" id="pic" name="pic" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="map" class="form-label">Map URL</label>
                    <input type="text" class="form-control" id="map" name="map" required>
                </div>
                <div class="mb-3">
                    <label for="giave" class="form-label">Ticket Price URL</label>
                    <input type="text" class="form-control" id="giave" name="giave" required>
                </div>
                <div class="mb-3">
                    <label for="hotline" class="form-label">Hotline</label>
                    <input type="text" class="form-control" id="hotline" name="hotline" required>
                </div>
            </div>
            <div class="row text-center">
                <button type="submit" class="btn btn-success mt-4">THÊM</button>
                <a href="/BetaCinema_Clone/admin/pages/index.php" class="btn btn-outline-success mt-3">QUAY LẠI</a>
            </div>
        </div>
    </form>
</div>
</body>
<style>
    body{
        background-color: #e5e5e5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container{
        border: 2px solid #198754;
        border-radius: 20px;
        padding: 30px;
        background-color: #fff;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-control{
        border: 1px solid #111;
    }

    label{
        font-weight: bold;
    }
</style>
</html>