<!-- SCRIPT UNTUK DELETE DATA -->
<?php
    ob_start();
    include("koneksi.php");

    // Cek apakah ada kiriman form dari method GET
    if (isset($_GET['id_borrow'])) {
        $id_borrow = mysqli_real_escape_string($connection, htmlspecialchars(var_dump($_GET['id_borrow'])));

        $sql = "DELETE FROM book_borrowing WHERE id_borrow='$id_borrow'";
        $hasil = mysqli_query($connection, $sql);

        // Kondisi apakah berhasil atau tidak
        if ($hasil) {
            header("Location: dashborrow.php");
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
    <title>Peminjaman Buku-Cipsmart</title>
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
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li class="active"><a href=""><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
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
            <h2>Pojok Baca</h2>
            <table id="pojokBacaTable">
            <thead>
                    <tr>
                        <th>ID Pinjam</th>
                        <th>ID Buku</th>
                        <th>ID User</th>
                        <th>Nama Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("koneksi.php");

                        $query = mysqli_query($connection, "SELECT * FROM book_borrowing");
                        while ($data = mysqli_fetch_array ($query)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id_borrow']; ?></td>
                        <td><?php echo $data['id_book']; ?></td>
                        <td><?php echo $data['id_user']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['title_book']; ?></td>
                        <td><?php echo $data['borrow_date']; ?></td>
                        <td><?php echo $data['return_date']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        
                        <td>
                        <a href="update-borrow.php?id_borrow=<?php echo htmlspecialchars($data['id_borrow']); ?>">
                            <i class="fa fa-pencil edit-btn"></i>
                        </a>
                        <a href="dashborrow.php?id_borrow" onclick="confirmDeleteBorrow('<?php echo $data['id_borrow']; ?>');">
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
        function confirmDeleteBorrow(id_borrow) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = "delete-borrow.php?id_borrow=" + id_borrow;
            }
        }
    </script>
    <!-- <script src="./js/delete.js"></script> -->
</body>
</html>
