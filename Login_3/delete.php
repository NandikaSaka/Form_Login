<?php
// Koneksi ke MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbName = "dblogin";
$collectionName = "users";

// Mendapatkan ID user dari URL
$id = new MongoDB\BSON\ObjectId($_GET['id']);

// Membuat filter untuk menghapus data user
$filter = ['_id' => $id];
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->delete($filter);
$manager->executeBulkWrite("$dbName.$collectionName", $bulk);

// Mengarahkan kembali ke admin dashboard setelah delete
header('Location: admin_dashboard.php');
exit();
