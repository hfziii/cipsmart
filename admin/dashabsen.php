<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Pojok Baca - Cipsmart</title>
    <link rel="stylesheet" href="../css/styleabsen.css">
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
            <li><a href="./dashboard_kelurahan.php"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.php"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li class="active"><a href="./dashabsen.php"><i class="fa fa-users"></i> Absen Pojok Baca</a></li>
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
                <i class="fa fa-search"></i>
                <i class="fa fa-bell"></i>
                <a href="../homepage.php">
                    <i class="fa fa-home"></i>
                </a>
            </div>
        </div>
        <div class="content">
            <h2>Absen Pojok Baca</h2>
            <div class="titletable">
                <form action="dashabsen.php" method="post" class="corner-education">
                    <label for="table-dropdown" class="title-ce">Pilih Pojok Baca</label>
                    <select id="table-dropdown" class="drop-ce" name="table_name" onchange="this.form.submit()">
                        <option value="" <?php if (!isset($_POST['table_name']) || $_POST['table_name'] == '') echo 'selected'; ?>>Semua</option>
                        <option value="Literasi Imajinatif" <?php if (isset($_POST['table_name']) && $_POST['table_name'] == 'Literasi Imajinatif') echo 'selected'; ?>>Literasi Imajinatif</option>
                        <option value="Social Connect" <?php if (isset($_POST['table_name']) && $_POST['table_name'] == 'Social Connect') echo 'selected'; ?>>Social Connect</option>
                        <option value="Bisnis Berdaya" <?php if (isset($_POST['table_name']) && $_POST['table_name'] == 'Bisnis Berdaya') echo 'selected'; ?>>Bisnis Berdaya</option>
                        <option value="Kreatif Kids Corner" <?php if (isset($_POST['table_name']) && $_POST['table_name'] == 'Kreatif Kids Corner') echo 'selected'; ?>>Kreatif Kids Corner</option>
                        <option value="Pena Inspirasi Gemilang" <?php if (isset($_POST['table_name']) && $_POST['table_name'] == 'Pena Inspirasi Gemilang') echo 'selected'; ?>>Pena Inspirasi Gemilang</option>
                    </select>
                </form>
            </div>
            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pojok Baca</th>
                        <th>Tanggal Mengunjungi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("koneksi.php");

                        // Ambil nilai filter dari POST
                        $filter = isset($_POST['table_name']) ? $_POST['table_name'] : '';

                        // Sesuaikan query berdasarkan filter
                        $queryStr = "SELECT * FROM absen";
                        if (!empty($filter)) {
                            $queryStr .= " WHERE name_corner = '$filter'";
                        }

                        $query = mysqli_query($connection, $queryStr);
                        while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id_absen']; ?></td>
                        <td><?php echo $data['name_member']; ?></td>
                        <td><?php echo $data['name_corner']; ?></td>
                        <td><?php echo $data['date']; ?></td>
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

    <script>
    function filterTable() {
        var filter = document.getElementById("pojokBacaFilter").value;
        window.location.href = "?filter=" + filter;
    }
    </script>
    <script src="../js/logout.js"></script>
</body>
</html>
