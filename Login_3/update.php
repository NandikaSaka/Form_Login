<?php
// Koneksi ke MongoDB
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbName = "dblogin";
$collectionName = "users";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form update
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];

    // Membuat filter dan update untuk mengubah data user
    $filter = ['_id' => $id];
    $update = ['$set' => ['username' => $username, 'email' => $email, 'alamat' => $alamat, 'nomor_telepon' => $nomor_telepon]];
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update($filter, $update);
    $manager->executeBulkWrite("$dbName.$collectionName", $bulk);

    // Mengarahkan kembali ke admin dashboard setelah update
    header('Location: admin_dashboard.php');
    exit();
}

// Mendapatkan ID user dari URL
$id = new MongoDB\BSON\ObjectId($_GET['id']);

// Mencari user berdasarkan ID
$filter = ['_id' => $id];
$query = new MongoDB\Driver\Query($filter);
$cursor = $manager->executeQuery("$dbName.$collectionName", $query);
$user = $cursor->toArray();

if (count($user) === 0) {
    // Jika user tidak ditemukan, kembali ke admin dashboard
    header('Location: admin_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $user[0]->_id ?>">
            <input type="text" name="username" placeholder="Username" value="<?= $user[0]->username ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?= $user[0]->email ?>" required>
            <input type="text" name="alamat" placeholder="Alamat" value="<?= $user[0]->alamat ?>" required>
            <input type="text" name="nomor_telepon" placeholder="Nomor Telepon" value="<?= $user[0]->nomor_telepon ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
