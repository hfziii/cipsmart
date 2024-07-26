<?php
ob_start();
include("koneksi.php");

// Cek apakah ada kiriman form dari method GET
if (isset($_GET['id_product'])) {
    $id_product = mysqli_real_escape_string($connection, htmlspecialchars($_GET["id_product"]));

    $sql = "DELETE FROM product_umkm WHERE id_product='$id_product'";
    $hasil = mysqli_query($connection, $sql);

    // Kondisi apakah berhasil atau tidak
    if ($hasil) {
        header("Location: dash-productumkm.php");
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
    <title>Katalog Produk UMKM - Cipsmart</title>
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
            <li><a href="./newdashboard.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="./dashadmin.html"><i class="fa fa-user"></i> Admin</a></li>
            <li><a href="./dashboard_kelurahan.html"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.html"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li class="active"><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="./dash-sellerumkm.php"><i class="fa fa-users"></i> Penjual UMKM</a></li>
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

            <div class="titletable">
                <h2>Produk UMKM</h2>
                <a href="create-productumkm.php">
                    <img src="./img/dashboard/add-btn.png" alt="" class="add-data-btn">
                </a>
            </div>
                
            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>ID Penjual</th>
                        <th>Penjual</th>
                        <th>No Whatsapp</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("koneksi.php");

                    // Query to fetch product and seller data
                    $query = "
                        SELECT p.*, s.seller_name, s.no_whatsapp
                        FROM product_umkm p
                        JOIN seller_umkm s ON p.id_seller = s.id_seller
                    ";
                    $result = mysqli_query($connection, $query);

                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id_product']; ?></td>
                        <td>
                            <img src="<?php echo $data['product_photo_1']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 50px; height: auto;">
                            <img src="<?php echo $data['product_photo_2']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 50px; height: auto;">
                            <img src="<?php echo $data['product_photo_3']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 50px; height: auto;">
                            <img src="<?php echo $data['product_photo_4']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 50px; height: auto;">
                        </td>
                        <td><?php echo $data['product_category']; ?></td>
                        <td><?php echo $data['product_name']; ?></td>
                        <td><?php echo 'Rp' . number_format($data['product_price'], 0, ',', '.'); ?></td>
                        <td><?php echo $data['product_description']; ?></td>
                        <td><?php echo $data['id_seller']; ?></td>
                        <td><?php echo $data['seller_name']; ?></td>
                        <td><?php echo $data['no_whatsapp']; ?></td>
                        <td>
                            <a href="update-productumkm.php?id_product=<?php echo htmlspecialchars($data['id_product']); ?>">
                                <i class="fa fa-pencil edit-btn"></i>
                            </a>
                            <a href="#" onclick="confirmDeleteProduct('<?php echo $data['id_product']; ?>');">
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
        // KONFIRMASI HAPUS DATA PRODUK UMKM
        function confirmDeleteProduct(id_product) {
            if (confirm("Anda yakin ingin menghapus produk UMKM ini?")) {
                window.location.href = "dash-productumkm.php?id_product=" + id_product;
            }
        }
    </script>
</body>
</html>
