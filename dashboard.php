<!-- <?php
session_start();

// Access control
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <div class="d-flex">
      <span class="navbar-text text-white me-3">
        <?= htmlspecialchars($_SESSION['user_name']) ?>
      </span>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
  <p>This is the admin dashboard. You can manage users, deliveries, and system settings from here.</p>

  <div class="row mt-4">
    <div class="col-md-4">
      <div class="card border-primary shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Manage Users</h5>
          <p class="card-text">View, edit, or remove sender and driver accounts.</p>
          <a href="manage_users.php" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Manage Deliveries</h5>
          <p class="card-text">View and update all delivery records.</p>
          <a href="manage_deliveries.php" class="btn btn-success">Go</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-secondary shadow-sm">
        <div class="card-body">
          <h5 class="card-title">System Settings</h5>
          <p class="card-text">Configure roles, permissions, and platform settings.</p>
          <a href="#" class="btn btn-secondary">Go</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
