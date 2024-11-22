<?php
require 'config.php';

// Pagination logic
$limit = 5; // Number of rows per page
$page = isset($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 1;

// Get total number of rows
$total_query = "SELECT COUNT(*) as total FROM cinemas";
$total_result = mysqli_query($connect, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_rows = $total_row['total'];
$total_pages = ceil($total_rows / $limit);

// Ensure the current page is within the valid range
if ($page > $total_pages) {
    header("Location: ?page=$total_pages");
    exit();
}

$offset = ($page - 1) * $limit;

// Fetch limited rows for the current page
$query = "SELECT * FROM cinemas LIMIT $limit OFFSET $offset";
$result = mysqli_query($connect, $query);
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CINEMAS</title>
</head>
<body>
<div class="container mt-5">
    <a href="/BetaCinema_Clone/admin/pages/cinemas/add_cinemas.php" class="btn btn-success text-center mt-5">THÊM MỚI CINEMA</a>
    <table class="table table-info table-bordered border-info table-striped mt-3">
        <thead>
        <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Location</th>
            <th scope="col">Picture</th>
            <th scope="col">Map</th>
            <th scope="col">Ticket Price</th>
            <th scope="col">Hotline</th>
            <th scope="col">Function</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $counter = ($page - 1) * $limit + 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='text-center'>";
            echo "<td>" . $counter++ . "</td>";
            echo "<td>" . htmlspecialchars($row['CinemaName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Location']) . "</td>";
            echo "<td><img src='" . htmlspecialchars($row['Pic']) . "' alt='" . htmlspecialchars($row['CinemaName']) . "' style='width:50px;height:50px;'></td>";
            echo "<td><a href='" . htmlspecialchars($row['Map']) . "' target='_blank'>Map</a></td>";
            echo "<td><a href='" . htmlspecialchars($row['GiaVe']) . "' target='_blank'>Ticket Price</a></td>";
            echo "<td>" . htmlspecialchars($row['Hotline']) . "</td>";
            echo "<td>
                    <a href='/BetaCinema_Clone/admin/pages/cinemas/edit_cinemas.php?cinema_id=" . htmlspecialchars($row['CinemaID']) . "' class='btn btn-warning btn-sm'>SỬA</a>
                    <a href='/BetaCinema_Clone/admin/pages/cinemas/delete_cinemas.php?cinema_id=" . htmlspecialchars($row['CinemaID']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc chắn muốn xoá cinema này không?');\">XOÁ</a>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Pagination links -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
<style>
    thead th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100px;
    }

    tbody td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }
</style>
</html>