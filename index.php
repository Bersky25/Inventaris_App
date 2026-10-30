<?php
require 'koneksi.php';
require 'bahasa.php';

// Proteksi Halaman: Jika belum login, tendang kembali ke halaman login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Mengambil seluruh data dari tabel barang (Operasi READ)
$query = "SELECT * FROM barang";
$hasil = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Inventaris</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 8px 12px; text-decoration: none; color: white; background-color: #28a745; border-radius: 4px; border: none; cursor: pointer; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-hapus { background-color: #dc3545; }
        .btn-logout { background-color: #6c757d; }
    </style>
</head>
<body>

    <div class="header">
        <!-- Menampilkan nama user yang sedang login dari Session -->
        <h2>Halo, <?= htmlspecialchars($_SESSION['user']) ?>! Ini Data Inventaris</h2>
        
        <div>
            <!-- Tombol Ganti Bahasa -->
            <a href="?lang=id" style="text-decoration:none;">🇮🇩 ID</a> | 
            <a href="?lang=en" style="text-decoration:none;">🇬🇧 EN</a> &nbsp;
            
            <!-- Tombol Logout -->
            <a href="logout.php" class="btn btn-logout">Keluar</a>
        </div>
    </div>

    <br>
    <a href="tambah.php" class="btn">+ Tambah Barang</a>
    <br><br>

    <!-- Tabel Data HTML -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        
        <?php 
        $no = 1;
        // Melakukan perulangan (looping) untuk menampilkan data dari database ke baris tabel
        while($baris = mysqli_fetch_assoc($hasil)) { 
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($baris['nama_barang']); ?></td>
            <td><?= htmlspecialchars($baris['kategori']); ?></td>
            <td><?= htmlspecialchars($baris['jumlah']); ?></td>
            <td>
                <!-- Tombol Aksi CRUD -->
                <a href="edit.php?id=<?= $baris['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="hapus.php?id=<?= $baris['id']; ?>" class="btn btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
        
    </table>

</body>
</html>