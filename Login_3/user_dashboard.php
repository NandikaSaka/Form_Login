<?php
session_start();

// Memeriksa role user
if ($_SESSION['role'] !== 'user') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, User!</h2>
        <a href="logout.php" class="logout-btn">Logout</a>
        <!-- Tambahkan kode HTML untuk tampilan dashboard user di sini -->
    </div>
</body>
</html>
