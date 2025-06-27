<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/Delivery Project/edit_user.php
include '../Database/dbconnect.php'; // Fixed path

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<div class='alert alert-danger'>No user ID provided.</div>";
    exit;
}

// Fetch user data
$stmt = $connect->prepare("SELECT name, email, role FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    echo "<div class='alert alert-danger'>User not found.</div>";
    exit;
}
$stmt->bind_result($name, $email, $role);
$stmt->fetch();
$stmt->close();

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = $_POST['name'] ?? '';
    $new_email = $_POST['email'] ?? '';
    $new_role = $_POST['role'] ?? '';

    if (empty($new_name) || empty($new_email) || empty($new_role)) {
        $msg = "<div class='alert alert-danger'>All fields are required.</div>";
    } else {
        $update = $connect->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
        $update->bind_param("sssi", $new_name, $new_email, $new_role, $id);
        if ($update->execute()) {
            $msg = "<div class='alert alert-success'>User updated successfully. <a href='manage_users.php'>Back to Manage Users</a></div>";
            $name = $new_name;
            $email = $new_email;
            $role = $new_role;
        } else {
            $msg = "<div class='alert alert-danger'>Update failed: " . $update->error . "</div>";
        }
        $update->close();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Edit User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="bg-white p-4 rounded shadow mt-5">
                    <h2 class="mb-4 text-center">Edit User</h2>
                    <?php if (isset($msg)) echo $msg; ?>
                    <form method="POST">
                        <div class="form-group mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin" <?php if($role=='admin') echo 'selected'; ?>>Admin</option>
                                <option value="sender" <?php if($role=='sender') echo 'selected'; ?>>Sender</option>
                                <option value="driver" <?php if($role=='driver') echo 'selected'; ?>>Driver</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Update User</button>
                        <a href="manage_users.php" class="btn btn-link w-100 mt-2">Back to Manage Users</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>