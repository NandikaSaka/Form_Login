<?php
session_start();

// Koneksi ke MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbName = "dblogin";
$collectionName = "users";

// Mengambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Membuat filter untuk mencari user di database
$filter = ['username' => $username, 'password' => $password];
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager->executeQuery("$dbName.$collectionName", $query);
$user = $cursor->toArray();

if (count($user) > 0) {
    // Menyimpan role user ke dalam session
    $_SESSION['role'] = $user[0]->role;

    // Mengarahkan ke dashboard sesuai role
    if ($user[0]->role === 'admin') {
        header('Location: admin_dashboard.php');
    } else {
        header('Location: user_dashboard.php');
    }
} else {
    // Jika login gagal, kembali ke halaman login
    header('Location: index.php');
}
