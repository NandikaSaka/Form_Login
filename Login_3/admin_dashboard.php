<?php
session_start();

// Memeriksa role admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Koneksi ke MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbName = "dblogin";
$collectionName = "users";

// Menampilkan data user dari database
$query = new MongoDB\Driver\Query([]);
$cursor = $manager->executeQuery("$dbName.$collectionName", $query);
$users = $cursor->toArray();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, Admin!</h2>
        <a href="logout.php" class="logout-btn">Logout</a>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->alamat ?></td>
                <td><?= $user->nomor_telepon ?></td>
                <td>
                    <a href="update.php?id=<?= $user->_id ?>" class="update-btn">Update</a>
                    <a href="delete.php?id=<?= $user->_id ?>" class="delete-btn">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
