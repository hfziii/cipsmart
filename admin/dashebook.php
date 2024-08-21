<!-- SCRIPT UNTUK DELETE DATA -->
<?php
    
    include 'auth.php';
    checkAccess(['Super Admin', 'Admin Literasi', 'Admin Social', 'Admin Bisnis', 'Admin Kreatif', 'Admin Pena']);

    ob_start();
    include("koneksi.php");

    // Cek apakah ada kiriman form dari method GET
    if (isset($_GET['id_ebook'])) {
        $id_ebook = mysqli_real_escape_string($connection, htmlspecialchars($_GET["id_ebook"]));

        $sql = "DELETE FROM ebook WHERE id_ebook='$id_ebook'";
        $hasil = mysqli_query($connection, $sql);

        // Kondisi apakah berhasil atau tidak
        if ($hasil) {
            header("Location: dashebook.php");
            exit(); // untuk menghentikan eksekusi skrip
        } else {
            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
        }
    }
<<<<<<< HEAD
=======

    // Fetch data with optional search filter
    $query = "SELECT * FROM ebook";
    if ($search) {
        $query .= " WHERE 
            id_ebook LIKE '%$search%' OR
            judul_ebook LIKE '%$search%' OR
            kategori_ebook LIKE '%$search%' OR
            penulis_ebook LIKE '%$search%' OR
            penerbit_ebook LIKE '%$search%' OR
            jumlah_halaman_ebook LIKE '%$search%' OR
            tahun_ebook LIKE '%$search%' OR
            isbn_ebook LIKE '%$search%' OR
            sipnopsis_ebook LIKE '%$search%' OR
            file_ebook LIKE '%$search%'";
    }
    $query .= " ORDER BY id_ebook ASC";
    $result = mysqli_query($connection, $query);

>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Book - Cipsmart</title>
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
            <li class="active"><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="./dash-sellerumkm.php"><i class="fa fa-users"></i> Penjual UMKM</a></li>
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
                <h2>E-Book</h2>
                <a href="../crud/create-ebook.php">
                    <img src="../img/dashboard/add-btn.png" alt="" class="add-data-btn">
                </a>
            </div>
                
            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul </th>
                        <th>Kategori </th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Total Halaman</th>
                        <th>Tahun Terbit</th>
                        <th>ISBN</th>
                        <th>Sinopsis</th>
                        <th>Sampul</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("koneksi.php");

                        $query = mysqli_query($connection, "SELECT * FROM ebook");
                        while ($data = mysqli_fetch_array ($query)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id_ebook']; ?></td>
                        <td><?php echo $data['judul_ebook']; ?></td>
                        <td><?php echo $data['kategori_ebook']; ?></td>
                        <td><?php echo $data['penulis_ebook']; ?></td>
                        <td><?php echo $data['penerbit_ebook']; ?></td>
                        <td><?php echo $data['jumlah_halaman_ebook']; ?></td>
                        <td><?php echo $data['tahun_ebook']; ?></td>
                        <td><?php echo $data['isbn_ebook']; ?></td>
                        <td><?php echo $data['sipnopsis_ebook']; ?></td>
                        <td><img src="../<?php echo $data['sampul_ebook']; ?>" alt="<?php echo $data['judul_ebook']; ?>" style="width: 50px; height: auto;"></td>
                        <td><?php echo $data['file_ebook']; ?></td>
                        
                        <td>
                            <a href="../crud/update-ebook.php?id_ebook=<?php echo htmlspecialchars($data['id_ebook']); ?>">
                                <i class="fa fa-pencil-square-o edit-btn" style="font-size: 20px"></i>
                            </a>
                            <a href="#" class="cd-popup-trigger-del" onclick="showDeletePopup('<?php echo $data['id_ebook']; ?>');">
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
            <p>Anda Yakin Ingin Hapus Data ini?</p>
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
                    window.location.href = "dashebook.php?id_ebook=" + deleteId;
                }
            }
        });
    </script>

    <script src="../js/logout.js"></script>
</body>
</html>
