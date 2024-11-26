<?php
include 'config.php';

if (!isset($_GET['movie_id'])) {
    die("MovieID not provided.");
}

$movie_id = intval($_GET['movie_id']);

$query = "DELETE FROM show_times WHERE MovieID = $movie_id";
mysqli_query($connect, $query);

$deleteQuery = "DELETE FROM movies WHERE MoviesID = $movie_id";

if (mysqli_query($connect, $deleteQuery)) {
    header("Location: /BetaCinema_Clone/admin/pages/movies/movies.php");
    exit();
} else {
    echo "Error: " . mysqli_error($connect);
}

mysqli_close($connect);
?>