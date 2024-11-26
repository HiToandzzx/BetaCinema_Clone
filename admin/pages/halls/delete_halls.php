<?php
include './config.php';

if (!isset($_GET['id'])) {
    die("HallID không được cung cấp.");
}

$id = intval($_GET['id']);

$query = "SELECT * FROM halls WHERE HallID = $id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Hall không tồn tại.");
}

$deleteShowTimesQuery = "DELETE FROM show_times WHERE HallID = $id";
mysqli_query($connect, $deleteShowTimesQuery);

$deleteSeatsQuery = "DELETE FROM seats WHERE HallID = $id";
mysqli_query($connect, $deleteSeatsQuery);

$deleteQuery = "DELETE FROM halls WHERE HallID = $id";
if (mysqli_query($connect, $deleteQuery)) {
    header("Location: /BetaCinema_Clone/admin/pages/halls/halls.php");
    exit();
} else {
    echo "Error: " . mysqli_error($connect);
}

mysqli_close($connect);
?>
