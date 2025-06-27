<?php include 'Database/dbconnect.php'; // Ensure this file contains the correct database connection code ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
  </head>
  <body class="bg-light d-flex justify-content-center align-items-center min-vh-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
          <div class="mb-4">
            <h1 class="text-center">Register</h1>
          </div>
          <form action="register.php" method="POST" class="bg-white p-4 shadow rounded">
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            <div class="form-group">
              <label for="role">Role</label>
              <select class="form-control" id="role" name="role" required>
                <option value="" disabled selected>Select your role</option>
                <option value="sender">Sender</option>
                <option value="driver">Driver</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success btn-block mt-3">Register</button>
            <p class="mt-3 mb-0 text-center">Already have an account? <a href="login.php" class="text-success">Login here</a></p>
            <p class="mb-0 text-center">Admin login <a href="adminLogin.php" class="text-success">here</a></p>

            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                $confirm_password = $_POST['confirm_password'] ?? '';
                $role = $_POST['role'] ?? '';

                // Validate inputs
                if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
                    echo "<div class='alert alert-danger mt-3'>All fields are required.</div>";
                } elseif ($password !== $confirm_password) {
                    echo "<div class='alert alert-danger mt-3'>Passwords do not match.</div>";
                } else {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert into database
                    $stmt = $connect->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success mt-3'>Registration successful! You can now <a href='login.php'>login</a>.</div>";
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
                    }
                    $stmt->close();
                }
            }
            $connect->close();
            ?>
          </form>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>