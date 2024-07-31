<?php
include("koneksi.php");

// Fungsi untuk mengambil data pinjam dari tabel
function getBooksFromTable($table) {
    global $connection;
    $table = mysqli_real_escape_string($connection, $table);
    $sql = "SELECT id_borrow, id_book, name, title_book, borrow_date, return_date, status FROM $table";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }
    $books = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
    return $books;
}

// Fungsi untuk menghapus pinjam berdasarkan ID
function deleteBook($table, $id_borrow) {
    global $connection;
    
    $table = mysqli_real_escape_string($connection, $table);
    $sql = "DELETE FROM $table WHERE id_borrow = ?";
    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id_borrow);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    } else {
        die("Prepared statement failed: " . mysqli_error($connection));
    }
}

// Fungsi untuk memperbarui status buku
function updateBookStatus($id_borrow, $table_name) {
    global $connection;

    // Mendapatkan nama tabel pinjam dan tabel buku yang sesuai
    $borrowing_tables = [
        'borrowing_literasi_imajinatif',
        'borrowing_social_connect',
        'borrowing_pena_inspirasi_gemilang',
        'borrowing_kreatif_kids_corner',
        'borrowing_bisnis_berdaya'
    ];

    $book_tables = [
        'book_literasi_imajinatif',
        'book_social_connect',
        'book_pena_inspirasi_gemilang',
        'book_kreatif_kids_corner',
        'book_bisnis_berdaya'
    ];

    // Update status di tabel borrowing_
    if (in_array($table_name, $borrowing_tables)) {
        $sql = "UPDATE $table_name SET status = 'Tersedia' WHERE id_borrow = ?";
        $stmt = mysqli_prepare($connection, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $id_borrow);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    // Update status di tabel book_
    foreach ($book_tables as $book_table) {
        $sql = "UPDATE $book_table SET status = 'Tersedia' WHERE id_book IN (SELECT id_book FROM $table_name WHERE id_borrow = ?)";
        $stmt = mysqli_prepare($connection, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $id_borrow);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

// Mendapatkan data pinjam dari tabel yang dipilih
$table_name = isset($_GET['table_name']) ? $_GET['table_name'] : 'borrowing_literasi_imajinatif';
$tables = [
    'borrowing_literasi_imajinatif' => getBooksFromTable('borrowing_literasi_imajinatif'),
    'borrowing_social_connect' => getBooksFromTable('borrowing_social_connect'),
    'borrowing_pena_inspirasi_gemilang' => getBooksFromTable('borrowing_pena_inspirasi_gemilang'),
    'borrowing_kreatif_kids_corner' => getBooksFromTable('borrowing_kreatif_kids_corner'),
    'borrowing_bisnis_berdaya' => getBooksFromTable('borrowing_bisnis_berdaya'),
];

// Menangani update status buku
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['update_status']) && isset($_GET['id_borrow']) && isset($_GET['table_name'])) {
    $id_borrow = (int) $_GET['id_borrow'];
    $table_name = $_GET['table_name'];
    updateBookStatus($id_borrow, $table_name);
    echo "<script>alert('Status buku berhasil diperbarui menjadi Tersedia'); window.location.href = 'dashborrow.php?table_name=$table_name';</script>";
}

// Menangani penghapusan data pinjam
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_borrow']) && isset($_GET['id_borrow']) && isset($_GET['table_name'])) {
    $id_borrow = (int) $_GET['id_borrow'];
    $table_name = $_GET['table_name'];
    if (deleteBook($table_name, $id_borrow)) {
        echo "<script>alert('Data pinjam berhasil dihapus'); window.location.href = 'dashborrow.php?table_name=$table_name';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data pinjam');</script>";
    }
}

// Query untuk mendapatkan data dari tabel yang dipilih
$query = mysqli_query($connection, "SELECT * FROM " . mysqli_real_escape_string($connection, $table_name));
if (!$query) {
    die("Query failed: " . mysqli_error($connection));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku - Cipsmart</title>
    <link rel="stylesheet" href="../css/dashborrow.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-btn').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const idBorrow = this.dataset.id;
                const tableName = this.dataset.table;

                // Dapatkan elemen baris yang mengandung data
                const row = this.closest('tr');
                const borrowerName = row.querySelector('.name').textContent;
                const bookTitle = row.querySelector('.title-book').textContent;
                const status = row.querySelector('.status').textContent;

                const form = document.getElementById('borrowForm');
                form.id_borrow.value = idBorrow;
                form.table_name.value = tableName;
                form.borrower_name.value = borrowerName;
                form.book_title.value = bookTitle;
                form.status.value = status;

                document.querySelector('.popup-overlay').classList.add('active');
                document.querySelector('.popup-form').classList.add('active');
            });
        });

        document.querySelector('.popup-overlay').addEventListener('click', function() {
            document.querySelector('.popup-overlay').classList.remove('active');
            document.querySelector('.popup-form').classList.remove('active');
        });
    });

    </script>
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
            <li class="active"><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
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
                <a href="./homepage.php">
                    <i class="fa fa-home"></i>
                </a>
            </div>
        </div>
        <div class="content">
            <h2>Peminjaman Buku</h2>

            <form action="dashborrow.php" method="get" class="corner-education">
                <label for="table-dropdown" class="title-ce">Pilih Pojok Baca</label>
                <select id="table-dropdown" class="drop-ce" name="table_name" onchange="this.form.submit()">
                    <option value="borrowing_literasi_imajinatif" <?php if ($table_name == 'borrowing_literasi_imajinatif') echo 'selected'; ?>>Literasi Imajinatif</option>
                    <option value="borrowing_social_connect" <?php if ($table_name == 'borrowing_social_connect') echo 'selected'; ?>>Social Connect</option>
                    <option value="borrowing_bisnis_berdaya" <?php if ($table_name == 'borrowing_bisnis_berdaya') echo 'selected'; ?>>Bisnis Berdaya</option>
                    <option value="borrowing_kreatif_kids_corner" <?php if ($table_name == 'borrowing_kreatif_kids_corner') echo 'selected'; ?>>Kreatif Kids Corner</option>
                    <option value="borrowing_pena_inspirasi_gemilang" <?php if ($table_name == 'borrowing_pena_inspirasi_gemilang') echo 'selected'; ?>>Pena Inspirasi Gemilang</option>
                </select>
            </form>
            
            <table id="PinjamTable">
                <thead>
                    <tr>
                        <th>ID Pinjam</th>
                        <th>ID Buku</th>
                        <th>Judul Buku</th>
                        <th>Nama Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tables[$table_name] as $book) : ?>
                        <tr>
                            <td><?= htmlspecialchars($book['id_borrow']) ?></td>
                            <td><?= htmlspecialchars($book['id_book']) ?></td>
                            <td><?= htmlspecialchars($book['title_book']) ?></td>
                            <td><?= htmlspecialchars($book['name']) ?></td>
                            <td><?= htmlspecialchars($book['borrow_date']) ?></td>
                            <td><?= htmlspecialchars($book['return_date']) ?></td>
                            <td><?= htmlspecialchars($book['status']) ?></td>
                            <td>
                                <?php if ($book['status'] === 'Dipinjam') : ?>
                                    <a href="dashborrow.php?update_status=1&id_borrow=<?= htmlspecialchars($book['id_borrow']) ?>&table_name=<?= htmlspecialchars($table_name) ?>" onclick="return confirm('Apakah Anda yakin ingin mengubah status buku ini menjadi Tersedia?');">
                                        <i class="fa fa-check"></i> Update Status
                                    </a>
                                <?php endif; ?>
                                <a href="dashborrow.php?delete_borrow=1&id_borrow=<?= htmlspecialchars($book['id_borrow']) ?>&table_name=<?= htmlspecialchars($table_name) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
   
</body>
</html>
