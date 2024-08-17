<?php
// Mulai session di sini
session_start();

// Fungsi untuk memeriksa akses
function checkAccess($allowed_roles) {
    // Cek apakah role sudah diset di session
    if (!isset($_SESSION['role'])) {
        header("Location: ../login.php"); // Arahkan ke halaman login jika belum login
        exit();
    }

    // Periksa apakah role pengguna ada di daftar yang diizinkan
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        $_SESSION['access_denied'] = true; // Set session untuk menandai akses ditolak
        header("Location: access_denied.php"); // Arahkan ke halaman access_denied.php
        exit();
    }
}
?>
