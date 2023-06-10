<?php
session_start();

// Koneksi ke MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbName = "dblogin";
$collectionName = "users";

// Mengambil data dari form register
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$nomor_telepon = $_POST['nomor_telepon'];
$role = $_POST['role'];

// Menyimpan user ke database
$user = [
    'username' => $username,
    'password' => $password,
    'email' => $email,
    'alamat' => $alamat,
    'nomor_telepon' => $nomor_telepon,
    'role' => $role
];

$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert($user);
$manager->executeBulkWrite("$dbName.$collectionName", $bulk);

// Menyimpan role user ke dalam session
$_SESSION['role'] = $role;

// Mengarahkan ke dashboard sesuai role
if ($role === 'admin') {
    header('Location: admin_dashboard.php');
} else {
    header('Location: user_dashboard.php');
}
