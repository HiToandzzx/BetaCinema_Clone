<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>EDIT CINEMA</title>
</head>
<body>
<?php
require 'config.php';

if (!isset($_GET['cinema_id'])) {
    die("CinemaID not provided.");
}

$cinema_id = intval($_GET['cinema_id']);

$query = "SELECT * FROM cinemas WHERE CinemaID = $cinema_id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Cinema not found.");
}

$cinema = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $pic = $_POST['pic'];
    $map = $_POST['map'];
    $giave = $_POST['giave'];
    $hotline = $_POST['hotline'];

    $updateQuery = "UPDATE cinemas 
                            SET CinemaName='$name', Address='$address', Location='$location', Pic='$pic', Map='$map', GiaVe='$giave', Hotline='$hotline' 
                            WHERE CinemaID=$cinema_id";

    if (mysqli_query($connect, $updateQuery)) {
        header("Location: /BetaCinema_Clone/admin/pages/index.php?message=Cinema updated successfully.");
        exit();
    } else {
        $error = "Error: " . mysqli_error($connect);
    }
}
?>

<div class="container w-50">
    <h2 class="text-center text-warning mb-4">CẬP NHẬT CINEMA <?= htmlspecialchars($cinema_id) ?></h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="row mt-5">
            <div class="col">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($cinema['CinemaName']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($cinema['Address']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($cinema['Location']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="pic" class="form-label">Picture URL</label>
                    <input type="text" class="form-control" id="pic" name="pic" value="<?= htmlspecialchars($cinema['Pic']) ?>" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="map" class="form-label">Map URL</label>
                    <input type="text" class="form-control" id="map" name="map" value="<?= htmlspecialchars($cinema['Map']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="giave" class="form-label">Ticket Price URL</label>
                    <input type="text" class="form-control" id="giave" name="giave" value="<?= htmlspecialchars($cinema['GiaVe']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="hotline" class="form-label">Hotline</label>
                    <input type="text" class="form-control" id="hotline" name="hotline" value="<?= htmlspecialchars($cinema['Hotline']) ?>" required>
                </div>
            </div>
            <div class="row text-center">
                <button type="submit" class="btn btn-warning mt-4">CẬP NHẬT</button>
                <a href="/BetaCinema_Clone/admin/pages/index.php" class="btn btn-outline-warning mt-3">QUAY LẠI</a>
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
        border: 2px solid #ffc107;
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