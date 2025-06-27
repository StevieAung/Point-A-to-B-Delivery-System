<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/Delivery Project/delete_user.php
include '../Database/dbconnect.php'; // Fixed path

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $connect->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manage_users.php?msg=deleted");
        exit;
    } else {
        header("Location: manage_users.php?msg=error");
        exit;
    }
}
header("Location: manage_users.php?msg=error");
exit;
?>