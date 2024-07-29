<?php
include("koneksi.php");

// Fungsi untuk mengambil data buku dari tabel
function getBooksFromTable($table) {
    global $connection;
    $sql = "SELECT id_book, title_book FROM $table";
    $result = mysqli_query($connection, $sql);
    $books = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
    return $books;
}

// Fungsi untuk menghapus buku berdasarkan ID
function deleteBook($table, $id_book) {
    global $connection;

    // Ambil jalur file foto dari database
    $sql = "SELECT photo FROM $table WHERE id_book = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id_book);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $photo_path = $row['photo'];

    // Hapus file foto jika ada
    if (file_exists($photo_path)) {
        unlink($photo_path);
    }

    // Hapus data buku dari database
    $sql = "DELETE FROM $table WHERE id_book = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id_book);
    return mysqli_stmt_execute($stmt);
}

// Mengambil data buku dari semua tabel
$tables = [
    'book_literasi_imajinatif' => getBooksFromTable('book_literasi_imajinatif'),
    'book_social_connect' => getBooksFromTable('book_social_connect'),
    'book_pena_inspirasi_gemilang' => getBooksFromTable('book_pena_inspirasi_gemilang'),
    'book_kreatif_kids_corner' => getBooksFromTable('book_kreatif_kids_corner'),
    'book_bisnis_berdaya' => getBooksFromTable('book_bisnis_berdaya'),
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table_name'])) {
    $table_name = $_POST['table_name'];
} elseif (isset($_GET['table_name'])) {
    $table_name = $_GET['table_name'];
} else {
    $table_name = 'book_literasi_imajinatif'; // Default table
}

if (isset($_GET['id_book']) && isset($_GET['table_name'])) {
    $id_book = $_GET['id_book'];
    $table_name = $_GET['table_name'];
    if (deleteBook($table_name, $id_book)) {
        echo "<script>alert('Data buku berhasil dihapus'); window.location.href = 'dashbook.php?table_name=$table_name';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data buku');</script>";
    }
}

$query = mysqli_query($connection, "SELECT * FROM " . mysqli_real_escape_string($connection, $table_name));
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
            <li><a href="./dashboard_kelurahan.html"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.php"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li class="active"><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="./dash-productumkm.php"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
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
                <h2>Katalog Buku</h2>
                <a href="create-book.php">
                    <img src="./img/dashboard/add-btn.png" alt="" class="add-data-btn">
                </a>
            </div>

            <form action="dashbook.php" method="post" class="corner-education">
                <label for="table-dropdown" class="title-ce">Pilih Pojok Baca</label>
                <select id="table-dropdown" class="drop-ce" name="table_name" onchange="this.form.submit()">
                    <option value="book_literasi_imajinatif" <?php if ($table_name == 'book_literasi_imajinatif') echo 'selected'; ?>>Literasi Imajinatif</option>
                    <option value="book_social_connect" <?php if ($table_name == 'book_social_connect') echo 'selected'; ?>>Social Connect</option>
                    <option value="book_bisnis_berdaya" <?php if ($table_name == 'book_bisnis_berdaya') echo 'selected'; ?>>Bisnis Berdaya</option>
                    <option value="book_kreatif_kids_corner" <?php if ($table_name == 'book_kreatif_kids_corner') echo 'selected'; ?>>Kreatif Kids Corner</option>
                    <option value="book_pena_inspirasi_gemilang" <?php if ($table_name == 'book_pena_inspirasi_gemilang') echo 'selected'; ?>>Pena Inspirasi Gemilang</option>
                </select>
            </form>

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
                        <th>Sinopsis</th>
                        <th>Total Halaman</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($query)) {
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
                        <td><?php echo $data['status']; ?></td>

                        <td>
                            <a href="update-book.php?id_book=<?php echo htmlspecialchars($data['id_book']); ?>&table_name=<?php echo htmlspecialchars($table_name); ?>">
                                <i class="fa fa-pencil edit-btn"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('<?php echo $data['id_book']; ?>', '<?php echo $table_name; ?>');">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous">
    </script>
    <script>
        // KONFIRMASI HAPUS DATA BUKU
        function confirmDelete(id_book, table_name) {
            if (confirm("Anda yakin ingin Hapus Data Buku ini?")) {
                window.location.href = "dashbook.php?id_book=" + encodeURIComponent(id_book) + "&table_name=" + encodeURIComponent(table_name);
            }
        }

        // INISIALISASI TABEL DENGAN FITUR SORTING DAN SEARCHING
        document.addEventListener('DOMContentLoaded', function() {
            var table = document.getElementById('pojokBacaTable');
            if (table) {
                var dataTable = new simpleDatatables.DataTable(table, {
                    searchable: true,
                    fixedHeight: true,
                });
            }
        });
    </script>
</body>
</html>
