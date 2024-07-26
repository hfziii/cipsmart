<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pojok Baca-Cipsmart</title>
    <link rel="stylesheet" href="./css/dashcorner.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="img/favicon/android-chrome-192x192.png" type="image/png">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="./img/dashboard/logo-cipsmart-profile.png" alt="Logo">
        </div>
        <ul>
            <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="./dashadmin.html"><i class="fa fa-user"></i> Admin</a></li>
            <li><a href="#"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li class="active"><a href="#"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.html"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="#"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li><a href="./dashuser.html"><i class="fa fa-users"></i> Pengguna</a></li>
            <li><a href="./logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Hello, Sobat Cipsmart!</h1>
            <div class="header-icons">
                <i class="fa fa-search"></i>
                <i class="fa fa-bell"></i>
                <a href="./homepage.php">
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
                        <th>Total Buku Semua</th>
                        <th>Total Buku Pinjaman</th>
                        <th>Total Buku Tersedia</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        include("koneksi.php");

                        $query = mysqli_query($connection, "SELECT * FROM corner_education");
                        while ($data = mysqli_fetch_array ($query)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id_corner']; ?></td>
                        <td><?php echo $data['name_corner']; ?></td>
                        <td><?php echo $data['location_corner']; ?></td>
                        <td><?php echo $data['total_book']; ?></td>
                        <td><?php echo $data['total_book_ready']; ?></td>
                        <td><?php echo $data['total_book_borrow']; ?></td>
                        
                        <td>
                        <a href="update-corner.php?id_cornerk=<?php echo htmlspecialchars($data['id_corner']); ?>">
                            <i class="fa fa-pencil edit-btn"></i>
                        </a>
                        </td>
                    </tr>

                    <?php 
                      }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
