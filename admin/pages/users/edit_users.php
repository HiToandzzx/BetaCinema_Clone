<?php
require 'config.php';

if (!isset($_GET['id'])) {
    die("UserID not provided.");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM users WHERE UserID = $id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("User not found.");
}

$user = mysqli_fetch_assoc($result);
$mess = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    $updateQuery = "UPDATE users 
                    SET Fullname='$fullname', Email='$email', Pass_word='$password', Dob='$dob', Sex='$sex', Phone='$phone', Role='$role' 
                    WHERE UserID=$id";

    if (mysqli_query($connect, $updateQuery)) {
        $mess = "Cập nhật thành công.";
    } else {
        $mess = "Error: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/BetaCinema_Clone/styles/admin.css">

    <title>EDIT USER</title>
</head>
<body>
    <div class="container w-50">
        <h2 class="text-center text-warning mb-4">CẬP NHẬT USERS</h2>
        <form method="POST">
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= htmlspecialchars($user['Fullname']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['Email']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?= htmlspecialchars($user['Pass_word']) ?>" 
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" 
                            title="Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và một ký tự đặc biệt">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="0" <?php if ($user['Role'] == '0') echo 'selected'; ?>>0</option>
                            <option value="1" <?php if ($user['Role'] == '1') echo 'selected'; ?>>1</option>
                        </select>
                    </div> -->
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sex" class="form-label">Giới tính</label>
                        <select class="form-control" id="sex" name="sex">
                            <option value="Nam" <?php if ($user['Sex'] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value="Nữ" <?php if ($user['Sex'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                            <option value="Khác" <?php if ($user['Sex'] == 'Khác') echo 'selected'; ?>>Khác</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">SĐT</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['Phone']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($user['Dob']) ?>">
                    </div>
                </div>
                <div class="col text-center mt-4">
                    <a href="/BetaCinema_Clone/admin/pages/users/users.php" class="btn btn-outline-warning" style="margin-right:15px">QUAY LẠI</a>
                    <button type="submit" class="btn btn-warning">CẬP NHẬT</button>
                </div>
                <?php if ($mess): ?>
                    <div class='alert alert-success mt-4 p-1 text-center' id='mess' style='color:green; font-weight:bold'>
                        <?= $mess ?>
                    </div>
                    <script>
                        setTimeout(function() {
                            window.location.href = "/BetaCinema_Clone/admin/pages/users/users.php";
                        }, 1000);
                    </script>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>
<style>
    body {
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
