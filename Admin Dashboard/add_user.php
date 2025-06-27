<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/Delivery Project/Admin Dashboard/add_user.php
include '../Database/dbconnect.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $msg = "<div class='alert alert-danger'>All fields are required.</div>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connect->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>User added successfully. <a href='manage_users.php'>Back to Manage Users</a></div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Add User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="bg-white p-4 rounded shadow mt-5">
                    <h2 class="mb-4 text-center">Add User</h2>
                    <?php if ($msg) echo $msg; ?>
                    <form method="POST">
                        <div class="form-group mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="" disabled selected>Select role</option>
                                <option value="admin">Admin</option>
                                <option value="sender">Sender</option>
                                <option value="driver">Driver</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Add User</button>
                        <a href="manage_users.php" class="btn btn-link w-100 mt-2">Back to Manage Users</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>