<?php
require 'koneksi.php';
session_start();

// Proteksi Halaman
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$error = '';

// Proses saat form disubmit (metode POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Sanitasi Data (mencegah kode jahat disisipkan ke form)
    $nama     = htmlspecialchars($_POST['nama_barang']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jumlah   = htmlspecialchars($_POST['jumlah']);

    // 2. Validasi Data (Struktur kontrol if-else)
    if (empty($nama) || empty($kategori) || empty($jumlah)) {
        $error = "Semua data wajib diisi!";
    } else {
        // 3. Simpan ke database (Create)
        $query = "INSERT INTO barang (nama_barang, kategori, jumlah) VALUES ('$nama', '$kategori', '$jumlah')";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php"); // Kembali ke halaman utama jika sukses
            exit;
        } else {
            $error = "Gagal menyimpan data ke database.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <style>body { font-family: Arial; margin: 30px; } form { max-width: 300px; display: flex; flex-direction: column; gap: 10px; } .error { color: red; }</style>
</head>
<body>
    <h2>Tambah Barang Baru</h2>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    
    <form method="POST" action="">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang">
        
        <label>Kategori:</label>
        <input type="text" name="kategori">
        
        <label>Jumlah:</label>
        <input type="number" name="jumlah">
        
        <button type="submit" style="background-color: #28a745; color: white; padding: 10px; border: none; cursor: pointer;">Simpan Data</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>