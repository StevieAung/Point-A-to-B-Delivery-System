<?php
session_start();
if (!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]) || $_SESSION["role"] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../Database/dbconnect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
  <body class="bg-light min-vh-100" >
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
      <div class="container-fluid">
        <h1><a class="navbar-brand text-success fw-bold fs-2 bg-light shadow-lg p-2 rounded" href="dashboard.php">A TO B DELIVERY</a></h1>
        <div class="mx-auto order-0">
          <form class="d-flex" style="width: 350px;">
            <input class="form-control me-2 mx-2 shadow" type="search" placeholder="Search..." aria-label="Search">
            <button class="btn-success btn-outline-black rounded px-4 shadow" type="submit">
              <span class="fas fa-search"></span>
            </button>
          </form>
        </div>
        <div class="d-flex">
          <span class="navbar-text text-black me-3">
            <?= htmlspecialchars($_SESSION['user_name']) ?>
          </span>
          <a href="../logout.php" class="btn-black btn-outline-black btn-m">Logout</a>
        </div>
      </div>
    </nav>

    <!-- dashboard container -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 bg-light d-flex flex-column p-0">
          <div class="h-100 p-4">
            <div class="container bg-white h-auto rounded-lg p-4 shadow d-block">
              <h3 class="text-center">DASHBOARD</h3>
              <ul>
                <li class="my-4">
                  <a href="dashboard.php" class="text-decoration-none text-dark sidebar-link">
                    <i class="fas fa-tachometer-alt"></i> Main Dashboard
                  </a>
                </li>
                <li class="my-4">
                  <a href="manage_users.php" class="text-decoration-none text-dark sidebar-link" data-url="manage_users.php">
                    <i class="fas fa-users"></i> Manage Users
                  </a>
                </li>
                <li class="my-4">
                  <a href="manage_deliveries.php" class="text-decoration-none text-dark sidebar-link">
                    <i class="fas fa-box"></i> Manage Deliveries
                  </a>
                </li>
                <li class="my-4">
                  <a href="system_settings.php" class="text-decoration-none text-dark">
                    <i class="fas fa-cog"></i> System Settings
                  </a>
                </li>
                <li class="my-4">
                  <a href="reports.php" class="text-decoration-none text-dark">
                    <i class="fas fa-chart-line"></i> Reports
                  </a>
                </li>
                <li class="my-4">
                  <a href="help.php" class="text-decoration-none text-dark">
                    <i class="fas fa-question-circle"></i> Help
                  </a>
                </li>
                <li class="my-4">
                  <a href="contact.php" class="text-decoration-none text-dark">
                    <i class="fas fa-envelope"></i> Contact Support
                  </a>
                </li>
                <li class="my-4">
                  <a href="../logout.php" class="text-decoration-none text-dark">    
                    <i class="fas fa-sign-out-alt"></i> Logout
                  </a>
                </li>   
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9 bg-light d-flex flex-column p-0">
          <div class="p-4">
            <div id="main-content">
              <div class="container bg-white h-auto rounded-lg p-4 shadow d-block">
                <h3 class="text-center">Main Dashboard</h3>
                <?php
                  // Get total senders
                  $result = $connect->query("SELECT COUNT(*) AS total FROM users WHERE role='sender'");
                  $row = $result->fetch_assoc();
                  $total_senders = $row['total'];

                  // Get total drivers
                  $result_driver = $connect->query("SELECT COUNT(*) AS total FROM users WHERE role='driver'");
                  $row_driver = $result_driver->fetch_assoc();
                  $total_drivers = $row_driver['total'];

                  // Get total admins
                  $result_admin = $connect->query("SELECT COUNT(*) AS total FROM users WHERE role='admin'");
                  $row_admin = $result_admin->fetch_assoc();
                  $total_admins = $row_admin['total'];
                ?>
                <div class="row">
                  <div class="col-md-2 mb-3">
                    <div class="card border-dark shadow-sm">
                      <div class="card-body">
                        <h5 class="card-title">Total Senders:</h5>
                        <p class="card-text display-4 text-center"><?php echo $total_senders; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 mb-3">
                    <div class="card border-success shadow-sm">
                      <div class="card-body">
                        <h5 class="card-title">Total Drivers:</h5>
                        <p class="card-text display-4 text-center"><?php echo $total_drivers; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 mb-3">
                    <div class="card border-info shadow-sm">
                      <div class="card-body">
                        <h5 class="card-title">Total Admins:</h5>
                        <p class="card-text display-4 text-center"><?php echo $total_admins; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <div class="card border-primary shadow-sm"> 
                      <div class="card-body">
                        <h5 class="card-title">Manage Users</h5>
                        <p class="card-text">View, edit, or remove sender and driver accounts.</p>
                        <a href="manage_users.php" class="btn btn-primary">Go</a>     
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <div class="card border-success shadow-sm">
                      <div class="card-body">
                        <h5 class="card-title">Manage Deliveries</h5>
                        <p class="card-text">View and update all delivery records.</p>
                        <a href="manage_deliveries.php" class="btn btn-success">Go</a>  
                      </div>      
                    </div>
                  </div>
                </div>
                <!-- You can add more dashboard content below if needed -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
      document.querySelectorAll('.sidebar-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
          var url = this.getAttribute('data-url');
          if (!url) return; // Only handle links with data-url
          e.preventDefault();
          fetch(url)
            .then(response => response.text())
            .then(html => {
              document.getElementById('main-content').innerHTML = html;
            });
        });
      });
    </script>
  </body>
</html>