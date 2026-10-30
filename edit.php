<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }

$error = '';
$id = $_GET['id']; // Mengambil ID dari URL

// Menampilkan data lama
$query_lama = "SELECT * FROM barang WHERE id = $id";
$hasil_lama = mysqli_query($conn, $query_lama);
$data = mysqli_fetch_assoc($hasil_lama);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitasi input
    $nama     = htmlspecialchars($_POST['nama_barang']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jumlah   = htmlspecialchars($_POST['jumlah']);

    // Validasi input
    if (empty($nama) || empty($kategori) || empty($jumlah)) {
        $error = "Semua data wajib diisi!";
    } else {
        // Proses Update Data
        $query_update = "UPDATE barang SET nama_barang='$nama', kategori='$kategori', jumlah='$jumlah' WHERE id=$id";
        if (mysqli_query($conn, $query_update)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal mengubah data.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <style>body { font-family: Arial; margin: 30px; } form { max-width: 300px; display: flex; flex-direction: column; gap: 10px; } .error { color: red; }</style>
</head>
<body>
    <h2>Edit Data Barang</h2>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    
    <form method="POST" action="">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>">
        
        <label>Kategori:</label>
        <input type="text" name="kategori" value="<?= $data['kategori'] ?>">
        
        <label>Jumlah:</label>
        <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>">
        
        <button type="submit" style="background-color: #ffc107; padding: 10px; border: none; cursor: pointer;">Perbarui Data</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>