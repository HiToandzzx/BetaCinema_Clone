<?php
    include './config.php';

    if (!isset($_GET['id'])) {
        die("UserID not provided.");
    }

    $id = intval($_GET['id']); 

    $query = "DELETE FROM users WHERE UserID = $id";
    mysqli_query($connect, $query);

    if (mysqli_query($connect, $query)) {
        header("Location: /BetaCinema_Clone/admin/pages/users/users.php");
        exit();
    } else {
        die("Error deleting user: " . mysqli_error($connect));
    }

?>
