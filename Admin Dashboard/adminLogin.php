<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container-fluid col-md-4 col-sm-6 col-lg-4">
        <div class="title mb-3">
            <h1 class="text-center">Admin Login</h1>
        </div>
        <form action="admiLlogin.php" method="POST" class="bg-light p-4 shadow rounded">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-success">Login</button>
            <p class="mt-3">Don't have admin access? <a href="#" class="text-success">Contact Stevie</a></p>

        <?php
        session_start();
        include 'Database/dbconnect.php'; // Ensure this file contains the correct database connection code
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
        
            // Fetch user with role
            $stmt = $connect->prepare("SELECT id, password, role FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
        
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($user_id, $hashed_password, $role);
                $stmt->fetch();
                if (password_verify($password, $hashed_password)) {
                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["role"] = $role;
                    if ($role === 'admin') { // or use $role_id == 1 if using role_id
                        header("Location: dashboard.php");
                    } else {
                        header("Location: home_page.php");
                    }
                    exit;
                } else {
                    echo "Invalid email or password.";
                }
            } else {
                echo "Invalid email or password.";
            }
            $stmt->close();
        }
        $connect->close();
        ?>
        </form>
      </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>