<!-- SCRIPT UNTUK DELETE DATA -->
<?php
    ob_start();
    include("koneksi.php");

    // Cek apakah ada kiriman form dari method GET
    if (isset($_GET['id_book'])) {
        $id_book = mysqli_real_escape_string($connection, htmlspecialchars($_GET["id_book"]));

        $sql = "DELETE FROM book WHERE id_book='$id_book'";
        $hasil = mysqli_query($connection, $sql);

        // Kondisi apakah berhasil atau tidak
        if ($hasil) {
            header("Location: dashbook.php");
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
    <title>Katalog Buku-Cipsmart</title>
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
            <li><a href="#"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.html"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li class="active"><a href="#"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
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

            <div class="titletable">
                <h2>Katalog Buku</h2>
                <a href="create-book.php">
                    <img src="./img/dashboard/add-btn.png" alt="" class="add-data-btn">
                </a>
            </div>
                
            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>ID Buku</th>
                        <th>Foto Buku</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>ISBN</th>
                        <th>Sipnopsis</th>
                        <th>Total Halaman</th>
                        <th>Pojok Baca</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("koneksi.php");

                        $query = mysqli_query($connection, "SELECT * FROM book");
                        while ($data = mysqli_fetch_array ($query)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id_book']; ?></td>
                        <td><img src="<?php echo $data['photo']; ?>" alt="<?php echo $data['title_book']; ?>" style="width: 50px; height: auto;"></td>
                        <td><?php echo $data['title_book']; ?></td>
                        <td><?php echo $data['author_name']; ?></td>
                        <td><?php echo $data['publisher_name']; ?></td>
                        <td><?php echo $data['year_publish']; ?></td>
                        <td><?php echo $data['isbn']; ?></td>
                        <td><?php echo $data['sipnopsis']; ?></td>
                        <td><?php echo $data['total_page']; ?></td>
                        <td><?php echo $data['corner_education']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        
                        <td>
                        <a href="update-book.php?id_book=<?php echo htmlspecialchars($data['id_book']); ?>">
                            <i class="fa fa-pencil edit-btn"></i>
                        </a>
                        <a href="#" onclick="confirmDelete('<?php echo $data['id_book']; ?>');">
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
        // KONFIRMASI HAPUS DATA BUKU
        function confirmDelete(id_book) {
            if (confirm("Anda yakin ingin Hapus Data Buku ini?")) {
                window.location.href = "dashbook.php?id_book=" + id_book;
            }
        }
    </script>

</body>
</html>
