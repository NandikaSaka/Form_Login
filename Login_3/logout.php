<?php
session_start();

// Menghapus data session
session_destroy();

// Kembali ke halaman login
header('Location: index.php');
exit();
