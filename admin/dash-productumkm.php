<?php
    ob_start();
    include("../koneksi.php");

    // Handle the search parameters
    $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, htmlspecialchars($_GET['search'])) : '';

    // Handle delete operation
    if (isset($_GET['id_product'])) {
        $id_product = mysqli_real_escape_string($connection, htmlspecialchars($_GET["id_product"]));

        $sql = "DELETE FROM product_umkm WHERE id_product='$id_product'";
        $hasil = mysqli_query($connection, $sql);

        if ($hasil) {
            header("Location: dash-productumkm.php");
            exit(); // Stop script execution
        } else {
            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
        }
    }

    // Fetch data with optional search filters
    $query = "SELECT p.*, s.seller_name, s.no_whatsapp
          FROM product_umkm p
          JOIN seller_umkm s ON p.id_seller = s.id_seller";

    if ($search) {
        $query .= " WHERE 
            p.product_name LIKE '%$search%' OR 
            p.product_category LIKE '%$search%' OR 
            p.product_price LIKE '%$search%' OR 
            p.product_description LIKE '%$search%' OR 
            p.id_seller LIKE '%$search%' OR
            s.seller_name LIKE '%$search%' OR
            s.no_whatsapp LIKE '%$search%'";
    }
    $query .= " ORDER BY p.id_seller ASC";
    $result = mysqli_query($connection, $query);

    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk UMKM - Cipsmart</title>
    <link rel="stylesheet" href="../css/dashumkm.css">
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
            <li><a href="./dashcorner.php"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li><a href="./dashabsen.php"><i class="fa fa-users"></i> Pengunjung Pojok Baca</a></li>
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li class="active"><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="./dash-sellerumkm.php"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li><a href="#" class="cd-popup-trigger"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Hello, Sobat Cipsmart!</h1>
            <div class="header-icons">
                <a href="../user/catalog-umkm.php">
                    <i class="fa fa-shopping-bag"></i>
                </a>
                <a href="../homepage.php">
                    <i class="fa fa-home"></i>
                </a>
            </div>
        </div>
        <div class="content">

            <div class="titletable">
                <h2>Produk UMKM</h2>
                <div class="search-bar">
                    <form action="dash-productumkm.php" method="get" class="form-search">
                        <input type="text" name="search" placeholder="Cari Produk/Penjual" value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit" class="submit-src">
                            <img src="../img/navbar/search-nav-icon.png" alt="Search">
                        </button>
                    </form>
                </div>
                <a href="../crud/create-productumkm.php">
                    <img src="../img/dashboard/add-btn.png" alt="" class="add-data-btn">
                </a>
            </div>
                
            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>ID Penjual</th>
                        <th>Penjual</th>
                        <th>No Whatsapp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $data['id_product']; ?></td>
                            <td>
                                <img src="../<?php echo $data['product_photo_1']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 50px; height: auto;">
                                <img src="../<?php echo $data['product_photo_2']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 50px; height: auto;">
                                <img src="../<?php echo $data['product_photo_3']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 50px; height: auto;">
                                <img src="../<?php echo $data['product_photo_4']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 50px; height: auto;">
                            </td>
                            <td><?php echo $data['product_category']; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?php echo 'Rp' . number_format($data['product_price'], 0, ',', '.'); ?></td>
                            <td><?php echo $data['product_description']; ?></td>
                            <td><?php echo $data['id_seller']; ?></td>
                            <td><?php echo $data['seller_name']; ?></td>
                            <td><?php echo $data['no_whatsapp']; ?></td>
                            <td>
                                <a href="../crud/update-productumkm.php?id_product=<?php echo htmlspecialchars($data['id_product']); ?>">
                                    <i class="fa fa-pencil-square-o edit-btn" style="font-size: 20px"></i>                            
                                </a>
                                <a href="#" class="cd-popup-trigger-del" onclick="showDeletePopup('<?php echo $data['id_product']; ?>');">
                                    <i class="fa fa-trash delete-btn" style="font-size: 20px"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Popup -->
    <div class="cd-popup-del" role="alert">
        <div class="cd-popup-container-del">
            <p>Anda Yakin Ingin Hapus Produk ini?</p>
            <ul class="cd-buttons-del">
                <li><a href="#" class="cd-popup-yes-del" onclick="confirmDelete()">Ya</a></li>
                <li><a href="#" class="cd-popup-close-del">Tidak</a></li>
            </ul>            
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

    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous">
    </script>
    <script>
        // KONFIRMASI HAPUS DATA        
        document.addEventListener('DOMContentLoaded', function() {
            var popup = document.querySelector('.cd-popup-del');
            var popupCloseButtons = document.querySelectorAll('.cd-popup-close-del');
            var deleteId = null;

            // Function to show delete popup and set the id_ebook
            window.showDeletePopup = function(id_ebook) {
                deleteId = id_ebook;
                popup.classList.add('is-visible');
            }

            // Attach event listeners to close buttons
            if (popupCloseButtons) {
                popupCloseButtons.forEach(function (button) {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        popup.classList.remove('is-visible');
                    });
                });
            }

            // Close popup when clicking outside of it
            popup.addEventListener('click', function (event) {
                if (event.target === popup) {
                    popup.classList.remove('is-visible');
                }
            });

            // Function to handle delete confirmation
            window.confirmDelete = function() {
                if (deleteId) {
                    window.location.href = "dash-productumkm.php?id_product=" + deleteId;
                }
            }
        });
    </script>
    <script src="../js/logout.js"></script>
</body>
</html>
