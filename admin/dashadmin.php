<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Cipsmart</title>
    <link rel="stylesheet" href="../css/dashcorner.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../img/dashboard/logo-cipsmart-profile.png" alt="Logo">
        </div>
        <ul>
            <li><a href="./dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="./dashadmin.php"><i class="fa fa-user"></i> Admin</a></li>
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
    <div class="main-content">
        <div class="header">
            <h1>Hello, Sobat Cipsmart!</h1>
            <div class="header-icons">
                <i class="fa fa-search"></i>
                <i class="fa fa-bell"></i>
                <a href="../homepage.php">
                    <i class="fa fa-home"></i>
                </a>
            </div>
        </div>
        <div class="content">
            <h2>Akun Admin</h2>
            <a href="../crud/form_create_admin.html">
                    <img src="../img/dashboard/add-btn.png" alt="" class="add-data-btn">
            </a>
            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>ID Admin</th>
                        <th>Nama Admin</th>
                        <th>No HP</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Hak Akses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("koneksi.php");

                        // Ambil nilai filter dari POST
                        $filter = isset($_POST['table_name']) ? $_POST['table_name'] : '';

                        // Sesuaikan query berdasarkan filter
                        $queryStr = "SELECT * FROM admin";
                        if (!empty($filter)) {
                            $queryStr .= " WHERE name_corner = '$filter'";
                        }

                        $query = mysqli_query($connection, $queryStr);
                        while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id_admin']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['nohp']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['password']; ?></td>
                        <td><?php echo $data['privileges']; ?></td>
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
