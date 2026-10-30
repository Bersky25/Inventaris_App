<?php
require 'koneksi.php';
session_start();

// Cek sesi login
if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit; 
}

// Mengecek apakah ada ID yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Perintah hapus data berdasarkan ID
    $query = "DELETE FROM barang WHERE id = $id";
    mysqli_query($conn, $query);
}

// Setelah dihapus, kembali ke halaman utama
header("Location: index.php");
exit;
?>