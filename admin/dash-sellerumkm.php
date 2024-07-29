<!-- SCRIPT UNTUK DELETE DATA -->
<?php
    ob_start();
    include("koneksi.php");

    // Cek apakah ada kiriman form dari method GET
    if (isset($_GET['id_seller'])) {
        $id_seller = mysqli_real_escape_string($connection, htmlspecialchars($_GET["id_seller"]));

        $sql = "DELETE FROM seller_umkm WHERE id_seller='$id_seller'";
        $hasil = mysqli_query($connection, $sql);

        // Kondisi apakah berhasil atau tidak
        if ($hasil) {
            header("Location: ./dash-sellerumkm.php");
            exit(); // untuk menghentikan eksekusi skrip
        } else {
            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
        }
    }
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk UMKM - Cipsmart</title>
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
            <li><a href="./dashadmin.php"><i class="fa fa-user"></i> Admin</a></li>
            <li><a href="./dashboard_kelurahan.php"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.php"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li><a href="./dashabsen.php"><i class="fa fa-users"></i> Absen Pojok Baca</a></li>
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li class="active"><a href="./dash-sellerumkm.php"><i class="fa fa-users"></i> Penjual UMKM</a></li>
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

            <div class="titletable">
                <h2>Penjual UMKM</h2>
                <a href="../crud/create-sellerumkm.php">
                    <img src="../img/dashboard/add-btn.png" alt="" class="add-data-btn">
                </a>
            </div>
                
            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>ID Penjual</th>
                        <th>Nama Penjual</th>
                        <th>No Whatsapp </th>
                        <th>Alamat </th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("koneksi.php");

                        $query = mysqli_query($connection, "SELECT * FROM seller_umkm");
                        while ($data = mysqli_fetch_array ($query)) {
                    ?>
                   <tr>
                        <td><?php echo $data['id_seller']; ?></td>                        
                        <td><?php echo $data['seller_name']; ?></td>
                        <td><?php echo $data['no_whatsapp']; ?></td>
                        <td><?php echo $data['address_seller']; ?></td>
                        
                        <td>
                            <a href="../crud/update-sellerumkm.php?id_seller=<?php echo htmlspecialchars($data['id_seller']); ?>">
                                <i class="fa fa-pencil edit-btn"></i>
                            </a>
                            <a href="#" onclick="confirmDeleteEbook('<?php echo $data['id_seller']; ?>');">
                                <i class="fa fa-trash delete-btn"></i>
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

    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous">
    </script>
    <script>
        // KONFIRMASI HAPUS DATA E-BOOK
        function confirmDeleteEbook(id_seller) {
            if (confirm("Anda yakin ingin Hapus Data Penjual UMKM ini?")) {
                window.location.href = "dash-sellerumkm.php?id_seller=" + id_seller;
            }
        }
    </script>
</body>
</html>
