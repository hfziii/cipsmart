<!-- SCRIPT UNTUK DELETE DATA -->
<?php
    
    include 'auth.php';
    checkAccess(['Super Admin', 'Admin UMKM']);

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
<<<<<<< HEAD
=======

    // Fetch data with optional search filter
    $query = "SELECT * FROM seller_umkm";
    if ($search) {
        $query .= " WHERE 
            id_seller LIKE '%$search%' OR 
            seller_name LIKE '%$search%' OR 
            no_whatsapp LIKE '%$search%' OR 
            address_seller LIKE '%$search%'";
    }
    $query .= " ORDER BY id_seller ASC";
    $result = mysqli_query($connection, $query);

>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjual UMKM - Cipsmart</title>
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
            <li><a href="./dashboard_kelurahan.php"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.php"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li><a href="./dashabsen.php"><i class="fa fa-users"></i> Pengunjung Pojok Baca</a></li>
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li class="active"><a href="./dash-sellerumkm.php"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li><a href="#" class="cd-popup-trigger"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Hello, <?php echo htmlspecialchars($_SESSION['role']); ?>!</h1>
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
                        <th>Aksi</th>
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
                        
                        <td class="icon-container">
                            <a href="../crud/update-sellerumkm.php?id_seller=<?php echo htmlspecialchars($data['id_seller']); ?>">
                                <i class="fa fa-pencil-square-o edit-btn" style="font-size: 20px"></i>                            
                            </a>
                            <a href="#"  class="cd-popup-trigger-del" onclick="showDeletePopup('<?php echo $data['id_seller']; ?>');">
                                <i class="fa fa-trash delete-btn" style="font-size: 20px"></i>       
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

    <!-- Delete Confirmation Popup -->
    <div class="cd-popup-del" role="alert">
        <div class="cd-popup-container-del">
            <p>Anda Yakin Ingin Hapus Penjual ini?</p>
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
                            window.location.href = "dash-sellerumkm.php?id_seller=" + deleteId;
                        }
                    }
                });
    </script>
    <script src="../js/logout.js"></script>
</body>
</html>
