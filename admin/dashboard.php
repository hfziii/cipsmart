<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cipsmart</title>
    <link rel="stylesheet" href="../css/newdashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../img/dashboard/logo-cipsmart-profile.png" alt="Logo">
        </div>
        <ul>
            <li class="active"><a href="./dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="./dashadmin.php"><i class="fa fa-user"></i> Admin</a></li>
            <li><a href="./dashboard_kelurahan.php"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.php"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li><a href="./dashabsen.php"><i class="fa fa-users"></i> Absen Pojok Baca</a></li>
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="./dash-sellerumkm.php"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li><a href="../logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Hello,<br> Sobat Cipsmart!</h1>
        </div>  
        <div class="header-icons">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <a href="./dashadmin.php">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </a>
            <a href="../homepage.php">
                <i class="fa fa-home"></i>
            </a>
        </div>

        <div class="widgets">
            <div class="widget-1">
                <h2 class="atasan">Kelurahan Cipaku</h2>
                <div class="padding-1">
                    <p class="profil-1">Luas Wilayah</p>
                    <p class="profil-2">30 km</p>
                </div>
                <div class="padding-2">
                    <p class="profil-3">Jumlah Penduduk</p>
                    <p class="profil-4">10,541 orang</p>
                 </div>
                 <div class="padding-3">
                    <p class="profil-5">Jumlah RW</p>
                    <p class="profil-6">10 RW</p>
                </div>
                <div class="padding-4">
                    <p class="profil-7">Jumlah RT</p>
                    <p class="profil-8">30 RT</p>
                </div>
            </div>
            <div class="widget-2">
                <h2 class="atasan-2">Perpustakaan Digital</h2>
                <div class="bungkus-1">
                    <p class="teks-1">Pengunjung</p>
                    <p class="total-1">200</p>
                </div>
                <div class="bungkus-2">
                    <p class="teks-2">Admin</p>
                    <p class="total-2">3</p>
                </div>
                <div class="bungkus-3">
                    <p class="teks-3">Total Buku</p>
                    <p class="total-3">589</p>
                </div>
                <div class="bungkus-4">
                    <p class="teks-4">Peminjaman</p>
                    <p class="total-4">125</p>
                </div>
            </div>
            <div class="widget-3">
                <h2 class="atasan-3">E-Book</h2>
                <div class="ebook-1">
                    <p class="ebook-teks-1">Total E-Book</p>
                    <p class="ebook-no-1">100</p>
                </div>
                <div class="ebook-2">
                    <p class="ebook-teks-2">E-book Terbaru</p>
                    <p class="ebook-no-2">Bonobonos 2</p>
                </div>
            </div>
            <div class="widget-4">
                <h2 class="atasan-4">UMKM</h2>
                <p>Total UMKM yang Tersedia: 50</p>
                <p>Total Produk UMKM: 200</p>
            </div>
        </div>
    </div>
</body>
</html>
