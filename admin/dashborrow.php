<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_borrow']) && isset($_POST['table_name']) && isset($_POST['status'])) {
    $id_borrow = (int) $_POST['id_borrow'];
    $table_name = $_POST['table_name'];
    $status = $_POST['status'];
    
    if (updateBorrowStatus($id_borrow, $table_name, $status)) {
        echo "<script>alert('Status peminjaman berhasil diperbarui'); window.location.href = 'dashborrow.php?table_name=$table_name';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui status peminjaman');</script>";
    }
}

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

// Fungsi untuk memperbarui status peminjaman dan buku
function updateBorrowStatus($id_borrow, $table_name, $status) {
    global $connection;
    
    // Validasi nama tabel dan status
    $table_name = mysqli_real_escape_string($connection, $table_name);
    $status = mysqli_real_escape_string($connection, $status);

    // Query untuk update status peminjaman
    $sql = "UPDATE $table_name SET status = ? WHERE id_borrow = ?";
    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'si', $status, $id_borrow);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($result && $status == 'Tersedia') {
            // Dapatkan id_book dari tabel peminjaman
            $sql = "SELECT id_book FROM $table_name WHERE id_borrow = ?";
            $stmt = mysqli_prepare($connection, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'i', $id_borrow);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_book);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                // Tentukan nama tabel buku yang sesuai
                $book_table = str_replace('borrowing_', 'book_', $table_name);
                $book_table = mysqli_real_escape_string($connection, $book_table);

                // Update status buku di tabel buku
                $sql = "UPDATE $book_table SET status = 'Tersedia' WHERE id_book = ?";
                $stmt = mysqli_prepare($connection, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 's', $id_book);
                    $result = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    return $result;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        return $result;
    } else {
        return false;
    }
}

// Mengambil data pinjam dari semua tabel
$tables = [
    'borrowing_literasi_imajinatif' => getBooksFromTable('borrowing_literasi_imajinatif'),
    'borrowing_social_connect' => getBooksFromTable('borrowing_social_connect'),
    'borrowing_pena_inspirasi_gemilang' => getBooksFromTable('borrowing_pena_inspirasi_gemilang'),
    'borrowing_kreatif_kids_corner' => getBooksFromTable('borrowing_kreatif_kids_corner'),
    'borrowing_bisnis_berdaya' => getBooksFromTable('borrowing_bisnis_berdaya'),
];

$table_name = 'borrowing_literasi_imajinatif'; // Default table

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table_name'])) {
    $table_name = $_POST['table_name'];
} elseif (isset($_GET['table_name'])) {
    $table_name = $_GET['table_name'];
}

if (isset($_GET['id_borrow']) && isset($_GET['table_name'])) {
    $id_borrow = (int) $_GET['id_borrow'];
    $table_name = $_GET['table_name'];
    if (deleteBook($table_name, $id_borrow)) {
        echo "<script>alert('Data pinjam berhasil dihapus'); window.location.href = 'dashborrow.php?table_name=$table_name';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data pinjam');</script>";
    }
}

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
    <title>Peminjaman Buku-Cipsmart</title>
    <link rel="stylesheet" href="../css/dashborrow.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">

    <style>
        /* Tambahkan CSS untuk popup */
        .popup-form {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            z-index: 1000;
        }
        .popup-form.active {
            display: block;
        }
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .popup-overlay.active {
            display: block;
        }
    </style>

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

            <form action="dashborrow.php" method="post" class="corner-education">
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
                        <th>Nama Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tables[$table_name] as $book) : ?>
                        <tr>
                            <td><?= htmlspecialchars($book['id_borrow']) ?></td>
                            <td><?= htmlspecialchars($book['id_book']) ?></td>
                            <td><?= htmlspecialchars($book['name']) ?></td>
                            <td><?= htmlspecialchars($book['title_book']) ?></td>
                            <td><?= htmlspecialchars($book['borrow_date']) ?></td>
                            <td><?= htmlspecialchars($book['return_date']) ?></td>
                            <td><?= htmlspecialchars($book['status']) ?></td>
                            <td>
                                <?php if ($book['status'] !== 'Tersedia') : ?>
                                    <a href="#" class="edit-btn" data-id="<?= htmlspecialchars($book['id_borrow']) ?>" data-table="<?= htmlspecialchars($table_name) ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="dashborrow.php?id_borrow=<?= htmlspecialchars($book['id_borrow']) ?>&table_name=<?= htmlspecialchars($table_name) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
   
    <!-- Overlay dan Form Popup -->
    <form id="borrowForm" method="POST" action="dashborrow.php">
        <input type="hidden" name="id_borrow">
        <input type="hidden" name="table_name">
        <div>
            <label for="borrower_name">Nama Peminjam</label>
            <input type="text" name="borrower_name" readonly>
        </div>
        <div>
            <label for="book_title">Judul Buku</label>
            <input type="text" name="book_title" readonly>
        </div>
        <div>
            <label for="status">Status</label>
            <select name="status">
                <option value="Dipinjam">Dipinjam</option>
                <option value="Tersedia">Tersedia</option>
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>

   
</body>
</html>
