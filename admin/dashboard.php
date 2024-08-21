<?php
    include 'auth.php';
    checkAccess(['Super Admin', 'Admin Kelurahan', 'Admin Literasi', 'Admin Social', 'Admin Bisnis', 'Admin Kreatif', 'Admin Pena', 'Admin UMKM']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cipsmart</title>
    <link rel="stylesheet" href="../css/newdashboard.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <!-- Google Fonts link for Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
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
            <li><a href="./dashabsen.php"><i class="fa fa-users"></i> Pengunjung Pojok Baca</a></li>
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="./dash-sellerumkm.php"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li><a href="#" class="cd-popup-trigger"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Hello,<br> <?php echo htmlspecialchars($_SESSION['role']); ?>!</h1>
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
<<<<<<< HEAD
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
=======
                    <a href="./dashboard_kelurahan.php">
                        <p class="profil-2"><?php echo $data['luas_wilayah']; ?></p>
                    </a>
                </div>
                <div class="padding-1">
                    <p class="profil-1">Jumlah Penduduk</p>
                    <a href="./dashboard_kelurahan.php"> 
                        <p class="profil-2"><?php echo $data['jumlah_penduduk']; ?> orang</p>
                    </a>
                 </div>
                 <div class="padding-1">
                    <p class="profil-1">Jumlah RW</p>
                    <a href="./dashboard_kelurahan.php">
                        <p class="profil-2"><?php echo $data['jumlah_rw']; ?></p>
                    </a>
                </div>
                <div class="padding-1">
                    <p class="profil-1">Jumlah RT</p>
                    <a href="./dashboard_kelurahan.php">
                        <p class="profil-2"><?php echo $data['jumlah_rt']; ?></p>
                    </a>
>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388
                </div>
            </div>
<<<<<<< HEAD
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
=======

            <div class="widget widget-2">
                <h2 class="atasan-2">Pojok Baca</h2>
                <a href="./dashabsen.php">
                    <div class="bungkus-1">
                        <p class="teks-1">Pengunjung</p>
                        <p class="total-1"><?php echo $total_pengunjung; ?></p>
                        <img src="../img/newdashboard/Mask group (4).png" alt="" class="detail-gambar">
                    </div>
                </a>
                <a href="./dashadmin.php">
                    <div class="bungkus-2">
                        <p class="teks-1">Admin</p>
                        <p class="total-1"><?php echo $total_admin; ?></p>
                        <img src="../img/newdashboard/Group 525.png" alt="" class="detail-gambar">
                    </div>
                </a>
                <a href="./dashbook.php">
                    <div class="bungkus-3">
                        <p class="teks-1">Total Buku</p>
                        <p class="total-1"><?php echo $total_buku; ?></p>
                        <img src="../img/newdashboard/Group 526.png" alt="" class="detail-gambar">
                    </div>
                </a>
                <a href="./dashborrow.php">
                    <div class="bungkus-4">
                        <p class="teks-1">Peminjaman</p>
                        <p class="total-1"><?php echo $total_peminjaman; ?></p>
                        <img src="../img/newdashboard/Group 527.png" alt="" class="detail-gambar">
                    </div>
                </a>
            </div>

            <div class="widget widget-3">
                <h2 class="atasan-3">Pengunjung <br>Perpustakaan Digital</h2>
                <div class="visitor-1">
                    <p class="visitor-teks-1">Hari ini</p>                    
                    <p class="visitor-no-1"><?php echo $visitors_today; ?></p>
>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388
                </div>
                <div class="ebook-2">
                    <p class="ebook-teks-2">E-book Terbaru</p>
                    <p class="ebook-no-2">Bonobonos 2</p>
                </div>
            </div>
<<<<<<< HEAD
            <div class="widget-4">
                <h2 class="atasan-4">UMKM</h2>
                <p>Total UMKM yang Tersedia: 50</p>
                <p>Total Produk UMKM: 200</p>
            </div>
            <div class="widget-5">
                <h2 class="atasan-5">UMKM</h2>
                <p>Total UMKM yang Tersedia: 50</p>
                <p>Total Produk UMKM: 200</p>
=======

            <div class="widget-umkm">
                <div class="umkm-box">
                    <h2 class="atasan-4">UMKM</h2>
                    <a href="./dash-sellerumkm.php">
                        <div class="seller">
                            <img src="../img/newdashboard/icon-13.png" alt="" class="detail-gambar">
                            <p class="teks-1">Total Penjual UMKM</p>
                            <p class="total-1"><?php echo $total_seller; ?></p>
                        </div>
                    </a>
                    <a href="./dash-productumkm.php">
                        <div class="product">
                            <img src="../img/newdashboard/icon-12.png" alt="" class="detail-gambar">
                            <p class="teks-2">Total Produk UMKM</p>
                            <p class="total-2"><?php echo $total_product; ?></p>
                        </div>
                    </a>
                </div>
                <div class="ebook-box">
                    <h2 class="atasan-4">E-Book</h2>
                    <a href="./dashebook.php">
                        <img src="../img/newdashboard/icon-ebook.png" alt="" class="detail-gambar">
                    </a>
                    <p class="teks-ebook">Total E-Book</p>
                    <p class="total-ebook"><?php echo $total_ebook; ?></p>
                </div>
>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Popup -->
    <div class="cd-popup" role="alert">
        <div class="cd-popup-container">
            <p>Anda yakin ingin Keluar?</p>
            <ul class="cd-buttons">
                <li><a href="#" class="cd-popup-yes" onclick="confirmLogout()">Ya</a></li>
                <li><a href="#" class="cd-popup-close">Tidak</a></li>
            </ul>            
        </div>
    </div>

    <script src="../js/logout.js"></script>
</body>
</html>
