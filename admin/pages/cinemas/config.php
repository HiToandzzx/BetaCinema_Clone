<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "betacinema_clone";
    $connect = mysqli_connect($servername, $username, $password, $db_name);

    if(!$connect)
        die("Connect failed !" . mysqli_connect_error());
?>