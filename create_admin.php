<?php
// IMPORTANT: You should delete this file after you run it once for security!
include '../config/database.php'; // Make sure you have a db_connect.php file

// --- Configuration ---
$admin_username = 'admin';
$admin_password = '123'; // Change this to a strong password
// -------------------

// Hash the password
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Prepare and execute the SQL statement
$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("ss", $admin_username, $hashed_password);

if ($stmt->execute()) {
    echo "Admin user '$admin_username' created successfully!";
} else {
    echo "Error creating admin user: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>