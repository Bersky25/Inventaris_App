<?php
require 'koneksi.php';
require 'bahasa.php';

// Jika pengguna sudah pernah login, langsung arahkan ke halaman utama (index.php)
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$error = '';

// Proses saat tombol login ditekan (metode POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitasi data input untuk mencegah celah keamanan
    $username = htmlspecialchars($_POST['username']);
    
    // Enkripsi password menggunakan MD5 (karena di Tahap 1 kita menyimpan admin123 dengan MD5)
    $password = md5($_POST['password']); 

    // Mencari kecocokan di database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $hasil = mysqli_query($conn, $query);

    // Struktur kontrol percabangan if-else untuk cek apakah data ditemukan
    if (mysqli_num_rows($hasil) > 0) {
        // Jika benar, simpan username ke session dan pindah halaman
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit;
    } else {
        // Jika salah, tampilkan pesan error
        $error = $teks[$lang]['pesan_gagal'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $teks[$lang]['judul_login'] ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .kotak-login { border: 1px solid #ccc; padding: 20px; width: 300px; }
        .error { color: red; }
    </style>
</head>
<body>

    <!-- Tombol ganti bahasa -->
    <a href="?lang=id">🇮🇩 Indonesia</a> | <a href="?lang=en">🇬🇧 English</a>
    <br><br>

    <div class="kotak-login">
        <h2><?= $teks[$lang]['judul_login'] ?></h2>

        <?php if($error) echo "<p class='error'>$error</p>"; ?>

        <!-- Form Login POST -->
        <form method="POST" action="">
            <label><?= $teks[$lang]['pengguna'] ?>:</label><br>
            <input type="text" name="username" required><br><br>
            
            <label><?= $teks[$lang]['sandi'] ?>:</label><br>
            <input type="password" name="password" required><br><br>
            
            <button type="submit"><?= $teks[$lang]['tombol_masuk'] ?></button>
        </form>
    </div>

</body>
</html>