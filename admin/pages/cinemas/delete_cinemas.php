<?php
require 'config.php';

if (!isset($_GET['cinema_id'])) {
    die("CinemaID not provided.");
}

$cinema_id = intval($_GET['cinema_id']);

$query = "DELETE FROM cinemas WHERE CinemaID = $cinema_id";

if (mysqli_query($connect, $query)) {
    header("Location: /BetaCinema_Clone/admin/pages/index.php?message=Cinema deleted successfully.");
    exit();
} else {
    echo "Error: " . mysqli_error($connect);
}

mysqli_close($connect);
?>