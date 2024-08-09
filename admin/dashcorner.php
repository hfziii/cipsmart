<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pojok Baca - Cipsmart</title>
    <link rel="stylesheet" href="../css/dashcorner.css">
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
            <li><a href="./dashboard_kelurahan.php"><i class="fa fa-university"></i> Profile Kelurahan</a></li>
            <li class="active"><a href="./dashcorner.php"><i class="fa fa-book"></i> Pojok Baca</a></li>
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
            <h1>Hello, Sobat Cipsmart!</h1>
            <div class="header-icons">
                <a href="../user/catalog-book.php">
                    <i class="fa fa-book"></i>
                </a>
                <a href="../homepage.php">
                    <i class="fa fa-home"></i>
                </a>
            </div>
        </div>
        <div class="content">
            <h2>Pojok Baca</h2>
            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>ID Pojok Baca</th>
                        <th>Nama Pojok Baca</th>
                        <th>Lokasi Pojok Baca</th>
                        <th>Buku Dipinjam</th>
                        <th>Buku Tersedia</th>
                        <th>Total Buku</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include("koneksi.php");

                    $query = mysqli_query($connection, "
                    SELECT 
                        c.id_corner, 
                        c.name_corner, 
                        c.location_corner,
                        CASE
                            WHEN c.id_corner = 'CE-1' THEN (SELECT COUNT(*) FROM book_literasi_imajinatif WHERE id_corner = c.id_corner)
                            WHEN c.id_corner = 'CE-2' THEN (SELECT COUNT(*) FROM book_social_connect WHERE id_corner = c.id_corner)
                            WHEN c.id_corner = 'CE-3' THEN (SELECT COUNT(*) FROM book_bisnis_berdaya WHERE id_corner = c.id_corner)
                            WHEN c.id_corner = 'CE-4' THEN (SELECT COUNT(*) FROM book_kreatif_kids_corner WHERE id_corner = c.id_corner)
                            WHEN c.id_corner = 'CE-5' THEN (SELECT COUNT(*) FROM book_pena_inspirasi_gemilang WHERE id_corner = c.id_corner)
                            ELSE 0
                        END AS total_book,
                        CASE
                            WHEN c.id_corner = 'CE-1' THEN (SELECT COUNT(*) FROM book_literasi_imajinatif WHERE id_corner = c.id_corner AND status = 'Dipinjam')
                            WHEN c.id_corner = 'CE-2' THEN (SELECT COUNT(*) FROM book_social_connect WHERE id_corner = c.id_corner AND status = 'Dipinjam')
                            WHEN c.id_corner = 'CE-3' THEN (SELECT COUNT(*) FROM book_bisnis_berdaya WHERE id_corner = c.id_corner AND status = 'Dipinjam')
                            WHEN c.id_corner = 'CE-4' THEN (SELECT COUNT(*) FROM book_kreatif_kids_corner WHERE id_corner = c.id_corner AND status = 'Dipinjam')
                            WHEN c.id_corner = 'CE-5' THEN (SELECT COUNT(*) FROM book_pena_inspirasi_gemilang WHERE id_corner = c.id_corner AND status = 'Dipinjam')
                            ELSE 0
                        END AS total_book_borrow,
                        CASE
                            WHEN c.id_corner = 'CE-1' THEN (SELECT COUNT(*) FROM book_literasi_imajinatif WHERE id_corner = c.id_corner AND status = 'Tersedia')
                            WHEN c.id_corner = 'CE-2' THEN (SELECT COUNT(*) FROM book_social_connect WHERE id_corner = c.id_corner AND status = 'Tersedia')
                            WHEN c.id_corner = 'CE-3' THEN (SELECT COUNT(*) FROM book_bisnis_berdaya WHERE id_corner = c.id_corner AND status = 'Tersedia')
                            WHEN c.id_corner = 'CE-4' THEN (SELECT COUNT(*) FROM book_kreatif_kids_corner WHERE id_corner = c.id_corner AND status = 'Tersedia')
                            WHEN c.id_corner = 'CE-5' THEN (SELECT COUNT(*) FROM book_pena_inspirasi_gemilang WHERE id_corner = c.id_corner AND status = 'Tersedia')
                            ELSE 0
                        END AS total_book_ready
                    FROM corner_education c
                    ");

                    while ($data = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?php echo $data['id_corner']; ?></td>
                        <td><?php echo $data['name_corner']; ?></td>
                        <td><?php echo $data['location_corner']; ?></td>
                        <td><?php echo $data['total_book_borrow']; ?></td>                        
                        <td><?php echo $data['total_book_ready']; ?></td>
                        <td><?php echo $data['total_book']; ?></td>
                    </tr>

                <?php 
                    }
                ?>
                </tbody>
            </table>
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
