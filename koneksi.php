<?php
$host     = "localhost"; // Nama server lokal komputer
$user     = "root";      // Username bawaan XAMPP (selalu 'root')
$password = "";          // Password bawaan XAMPP (selalu dikosongkan)
$db_name  = "inventaris_db"; // Nama database yang tadi kita buat

// Perintah untuk membangun jembatan koneksi
$conn = mysqli_connect($host, $user, $password, $db_name);

// Mengecek apakah jembatannya berhasil tersambung
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>