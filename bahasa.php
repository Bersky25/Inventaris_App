<?php
// Memulai sesi untuk menyimpan data pengguna dan pilihan bahasa
session_start();

// Jika tombol ubah bahasa ditekan, simpan pilihan bahasanya ke dalam session
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Jika belum ada bahasa yang dipilih, atur default ke bahasa Indonesia ('id')
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'id';

// Kamus kata-kata untuk antarmuka (interface)
$teks = [
    'id' => [
        'judul_login' => 'Masuk ke Sistem',
        'pengguna' => 'Nama Pengguna',
        'sandi' => 'Kata Sandi',
        'tombol_masuk' => 'Masuk',
        'pesan_gagal' => 'Username atau Password salah!'
    ],
    'en' => [
        'judul_login' => 'Login to System',
        'pengguna' => 'Username',
        'sandi' => 'Password',
        'tombol_masuk' => 'Login',
        'pesan_gagal' => 'Invalid Username or Password!'
    ]
];
?>