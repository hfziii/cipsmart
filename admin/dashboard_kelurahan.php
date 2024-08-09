<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Kelurahan Cipaku - Cipsmart</title>
    <link rel="stylesheet" href="../css/dash_kelurahan.css">
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
            <li><a href="./dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="./dashadmin.php"><i class="fa fa-user"></i> Admin</a></li>
            <li class="active"><a href="./dashboard_kelurahan.php"><i class="fa fa-university"></i> Profile Kelurahan</a></li>
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
    <div class="main-content">

        <div class="header">
            <div class="header-text">
                <h1>Hello, Sobat Cipsmart!</h1>
            </div>
            <div class="header-icons">
                <a href="../user/profile_kelurahan.php">
                    <i class="fa fa-university"></i>
                </a>
                <a href="../homepage.php">
                    <i class="fa fa-home" style="font-size: 41px;"></i>
                </a>
            </div>
        </div>
        <div class="header-line-horizontal"></div>

        <div class="content">
            <?php
                include("koneksi.php");

                $query = mysqli_query($connection, "SELECT * FROM profile_kelurahan");
                while ($data = mysqli_fetch_array ($query)) {
            ?>
            <h2>
                Profil Kelurahan Cipaku
                <a href="../crud/update-kelurahan.php?id_profile=<?php echo htmlspecialchars($data['id_profile']); ?>">
                    <i class="fa fa-pencil-square-o"  style="font-size: 30px; margin:5px; color:#fff;"></i>
                </a>
            </h2>
            <div class="profile-container">
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-title">Luas Wilayah:</span>
                        <span class="stat-value"><strong><?php echo $data['luas_wilayah']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Jumlah Penduduk:</span>
                        <span class="stat-value"><strong><?php echo $data['jumlah_penduduk']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Jumlah RW:</span>
                        <span class="stat-value"><strong><?php echo $data['jumlah_rw']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Laki-laki:</span>
                        <span class="stat-value"><strong><?php echo $data['laki_laki']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Jumlah RT:</span>
                        <span class="stat-value"><strong><?php echo $data['jumlah_rt']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Perempuan:</span>
                        <span class="stat-value"><strong><?php echo $data['perempuan']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Anak-anak <br> (0-12 th):</span>
                        <span class="stat-value"><strong><?php echo $data['anak_anak']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Tamat SD-SMP:</span>
                        <span class="stat-value"><strong><?php echo $data['tamat_sd_smp']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Remaja <br> (13-19 th):</span>
                        <span class="stat-value"><strong><?php echo $data['remaja']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Tamat SMA:</span>
                        <span class="stat-value"><strong><?php echo $data['tamat_sma']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Dewasa (>20 th):</span>
                        <span class="stat-value"><strong><?php echo $data['dewasa']; ?></strong></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Tamat Sarjana:</span>
                        <span class="stat-value"><strong><?php echo $data['tamat_sarjana']; ?></strong></span>
                    </div>
                </div>
                
                <div class="profile-map">
                    <img src="../img/dashboard/maps-cipaku.png" alt="Map of Cipaku">
                </div>

                <div class="profile-description">
                    <?php echo $data['deskripsi']; ?>
                </div>

                <?php 
                      }
                ?>
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
