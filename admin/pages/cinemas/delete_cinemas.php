<?php
require 'config.php';

if (!isset($_GET['cinema_id'])) {
    die("CinemaID not provided.");
}

$cinema_id = intval($_GET['cinema_id']);

$queryShowTimes = "DELETE FROM show_times WHERE HallID IN (SELECT HallID FROM halls WHERE CinemaID = $cinema_id)";
mysqli_query($connect, $queryShowTimes);

$querySeats = "DELETE FROM seats WHERE HallID IN (SELECT HallID FROM halls WHERE CinemaID = $cinema_id)";
mysqli_query($connect, $querySeats);

$queryHalls = "DELETE FROM halls WHERE CinemaID = $cinema_id";
mysqli_query($connect, $queryHalls);

$deleteQuery = "DELETE FROM cinemas WHERE CinemaID = $cinema_id";

if (mysqli_query($connect, $deleteQuery)) {
    header("Location: /BetaCinema_Clone/admin/pages/cinemas/cinemas.php");
    exit();
} else {
    echo "Error: " . mysqli_error($connect);
}

mysqli_close($connect);
?>
