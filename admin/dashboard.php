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
    <?php
        include("koneksi.php");

        // Mengambil total data pengunjung dari tabel absen
        $sql_pengunjung = "SELECT COUNT(*) as total FROM absen";
        $result_pengunjung = $connection->query($sql_pengunjung);
        $row_pengunjung = $result_pengunjung->fetch_assoc();
        $total_pengunjung = $row_pengunjung['total'];

        // Mengambil total data admin dari tabel admin
        $sql_admin = "SELECT COUNT(*) as total FROM admin";
        $result_admin = $connection->query($sql_admin);
        $row_admin = $result_admin->fetch_assoc();
        $total_admin = $row_admin['total'];

        // Mengambil total data umkm dari tabel umkm
        $sql_seller = "SELECT COUNT(*) as total FROM seller_umkm";
        $result_seller = $connection->query($sql_seller);
        $row_seller = $result_seller->fetch_assoc();
        $total_seller = $row_seller['total'];

        $sql_product = "SELECT COUNT(*) as total FROM product_umkm";
        $result_product = $connection->query($sql_product);
        $row_product = $result_product->fetch_assoc();
        $total_product = $row_product['total'];

        // Mengambil total data ebook dari tabel ebook
        $sql_ebook = "SELECT COUNT(*) as total FROM ebook";
        $result_ebook = $connection->query($sql_ebook);
        $row_ebook = $result_ebook->fetch_assoc();
        $total_ebook = $row_ebook['total'];

        // Mengambil total data buku dari beberapa tabel
        $sql_buku = "
            SELECT (
                (SELECT COUNT(*) FROM book_bisnis_berdaya) +
                (SELECT COUNT(*) FROM book_kreatif_kids_corner) +
                (SELECT COUNT(*) FROM book_literasi_imajinatif) +
                (SELECT COUNT(*) FROM book_pena_inspirasi_gemilang) +
                (SELECT COUNT(*) FROM book_social_connect)
            ) as total";
        $result_buku = $connection->query($sql_buku);
        $row_buku = $result_buku->fetch_assoc();
        $total_buku = $row_buku['total'];

        // Mengambil total data peminjaman dari beberapa tabel
        $sql_peminjaman = "
            SELECT (
                (SELECT COUNT(*) FROM borrowing_bisnis_berdaya) +
                (SELECT COUNT(*) FROM borrowing_kreatif_kids_corner) +
                (SELECT COUNT(*) FROM borrowing_literasi_imajinatif) +
                (SELECT COUNT(*) FROM borrowing_pena_inspirasi_gemilang) +
                (SELECT COUNT(*) FROM borrowing_social_connect)
            ) as total";
        $result_peminjaman = $connection->query($sql_peminjaman);
        $row_peminjaman = $result_peminjaman->fetch_assoc();
        $total_peminjaman = $row_peminjaman['total'];

        // Mengambil data kunjungan hari ini
        $current_date = date('Y-m-d');
        $sql_today = "SELECT visit_count FROM web_traffic WHERE visit_date = '$current_date'";
        $result_today = $connection->query($sql_today);
        $row_today = $result_today->fetch_assoc();
        $visitors_today = $row_today ? $row_today['visit_count'] : 0;

        // Mengambil data kunjungan bulan ini
        $current_month = date('Y-m');
        $sql_month = "SELECT SUM(visit_count) AS total FROM web_traffic WHERE visit_date LIKE '$current_month%'";
        $result_month = $connection->query($sql_month);
        $row_month = $result_month->fetch_assoc();
        $visitors_month = $row_month ? $row_month['total'] : 0;

        $connection->close();
    ?>
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
            <li><a href="#" class="cd-popup-trigger"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <h1>Hello,<br> Sobat Cipsmart!</h1>
        </div>  
        <div class="header-icons">
            <a href="./dashadmin.php">
                <i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: larger;"></i>
            </a>
            <a href="../homepage.php">
                <i class="fa fa-home" style="font-size: 41px"></i>
            </a>
        </div>

        <div class="widgets">
            <div class="widget widget-1">
                <?php
                    include("koneksi.php");

                    $query = mysqli_query($connection, "SELECT * FROM profile_kelurahan");
                    while ($data = mysqli_fetch_array ($query)) {
                ?>
                <h2 class="atasan">Kelurahan Cipaku</h2>
                <div class="padding-1">
                    <p class="profil-1">Luas Wilayah</p>
                    <p class="profil-2"><?php echo $data['luas_wilayah']; ?></p>
                </div>
                <div class="padding-1">
                    <p class="profil-1">Jumlah Penduduk</p>
                    <p class="profil-2"><?php echo $data['jumlah_penduduk']; ?> orang</p>
                 </div>
                 <div class="padding-1">
                    <p class="profil-1">Jumlah RW</p>
                    <p class="profil-2"><?php echo $data['jumlah_rw']; ?></p>
                </div>
                <div class="padding-1">
                    <p class="profil-1">Jumlah RT</p>
                    <p class="profil-2"><?php echo $data['jumlah_rt']; ?></p>
                </div>
                <?php 
                      }
                ?>
            </div>

            <div class="widget widget-2">
                <h2 class="atasan-2">Perpustakaan Digital</h2>
                <div class="bungkus-1">
                    <p class="teks-1">Pengunjung</p>
                    <p class="total-1"><?php echo $total_pengunjung; ?></p>
                    <img src="../img/newdashboard/Mask group (4).png" alt="" class="detail-gambar">
                </div>
                <div class="bungkus-2">
                    <p class="teks-1">Admin</p>
                    <p class="total-1"><?php echo $total_admin; ?></p>
                    <img src="../img/newdashboard/Group 525.png" alt="" class="detail-gambar">
                </div>
                <div class="bungkus-3">
                    <p class="teks-1">Total Buku</p>
                    <p class="total-1"><?php echo $total_buku; ?></p>
                    <img src="../img/newdashboard/Group 526.png" alt="" class="detail-gambar">
                </div>
                <div class="bungkus-4">
                    <p class="teks-1">Peminjaman</p>
                    <p class="total-1"><?php echo $total_peminjaman; ?></p>
                    <img src="../img/newdashboard/Group 527.png" alt="" class="detail-gambar">
                </div>
            </div>

            <div class="widget widget-3">
                <h2 class="atasan-3">Pengunjung Web</h2>
                <div class="visitor-1">
                    <p class="visitor-teks-1">Hari ini</p>
                    <p class="visitor-no-1"><?php echo $visitors_today; ?></p>
                </div>
                <div class="visitor-2">
                    <p class="visitor-teks-2">Bulan ini</p>
                    <p class="visitor-no-2"><?php echo $visitors_month; ?></p>
                </div>
            </div>

            <div class="widget-umkm">
                <div class="umkm-box">
                    <h2 class="atasan-4">UMKM</h2>
                    <div class="seller">
                        <img src="../img/newdashboard/icon-13.png" alt="" class="detail-gambar">
                        <p class="teks-1">Total Penjual UMKM</p>
                        <p class="total-1"><?php echo $total_seller; ?></p>
                    </div>
                    <div class="product">
                        <img src="../img/newdashboard/icon-12.png" alt="" class="detail-gambar">
                        <p class="teks-2">Total Produk UMKM</p>
                        <p class="total-2"><?php echo $total_product; ?></p>
                    </div>
                </div>
                <div class="ebook-box">
                    <h2 class="atasan-4">E-Book</h2>
                    <img src="../img/newdashboard/icon-ebook.png" alt="" class="detail-gambar">
                    <p class="teks-ebook">Total E-Book</p>
                    <p class="total-ebook"><?php echo $total_ebook; ?></p>
                </div>
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
