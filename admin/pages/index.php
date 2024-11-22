<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- JS -->
    <script src="/BetaCinema_Clone/admin/js/index.js"></script>
    <!-- CSS -->
    <link rel='stylesheet' href='/BetaCinema_Clone/admin/styles/index.css'>

    <title>ADMIN</title>
</head>
<body>
    <?php
        require 'config.php';
        session_start();
    ?>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="/BetaCinema_Clone/assets/logo.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">USER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">MOVIES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CINEMAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">HALLS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">SEATS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">SHOWTIMES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">PAYMENT</a>
                    </li>
                </ul>
                <div class="d-flex ml-4 admin">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <span class="text-white admin-name">Hi, <?php echo $_SESSION['Fullname']; ?></span>
                        <a class="btn" href="/BetaCinema_Clone/auth/logout.php"><i class="bi bi-box-arrow-left"></i></a>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div id="content-user" class="content" style="display:none;">
        <?php include './users/users.php'; ?>
    </div>
    <div id="content-movies" class="content" style="display:none;">
        <?php include './movies/movies.php'; ?>
    </div>
    <div id="content-cinemas" class="content" style="display:none;">
        <?php include './cinemas/cinemas.php'; ?>
    </div>
    <div id="content-halls" class="content" style="display:none;">
        <?php include './halls/halls.php'; ?>
    </div>
    <div id="content-seats" class="content" style="display:none;">
        <?php include './seats/seats.php'; ?>
    </div>
    <div id="content-showtimes" class="content" style="display:none;">
        <?php include './show_times.php'; ?>
    </div>
    <div id="content-payment" class="content" style="display:none;">
        <?php include './payments.php'; ?>
    </div>
</body>
<style>
    body{
        background-color: #e3f2fd;
    }

    .content {
        display: none;
    }

    #content-default {
        display: block;
        text-align: center;
    }

    #content-default img {
        max-width: 50%;
        height: auto;
    }
</style>
</html>