<?php
include '../Database/dbconnect.php'; // Updated path
$msg = $_GET['msg'] ?? '';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Manage Users</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../style.css"> <!-- Updated path if needed -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Add Font Awesome for the icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
  <body class="bg-light">
      <div class="container-fluid p-4 bg-white shadow rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h1 class="mt-2">Manage Users</h1>
          <a href="dashboard.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
          </a>
        </div>
        <p class="lead">Here you can view, update, or delete user accounts.</p>

        <?php if ($msg === 'deleted'): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            User deleted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif ($msg === 'error'): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed to delete user.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <div class="d-flex justify-content-end mb-3">
          <a href="add_user.php" class="btn btn-success">
            <i class="fas fa-user-plus"></i> Add User
          </a>
        </div>

        <table class="table table-striped table-hover table-bordered mt-4">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $result = $connect->query("SELECT id, name, email, role FROM users");
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars(ucfirst($row['role'])) . "</td>";
                echo "<td>
                        <a href='edit_user.php?id=" . urlencode($row['id']) . "' class='btn btn-sm btn-warning'>Update</a>
                        <a href='delete_user.php?id=" . urlencode($row['id']) . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                      </td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='5' class='text-center'>No users found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>