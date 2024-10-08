<?php
    include("koneksi.php");
    include 'auth.php';
    checkAccess(['Super Admin', 'Admin Literasi', 'Admin Social', 'Admin Bisnis', 'Admin Kreatif', 'Admin Pena']);

<<<<<<< HEAD
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
=======
    // Dapatkan role pengguna saat ini
    $current_role = $_SESSION['role'];
>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388

    // Tentukan tabel yang dapat diakses berdasarkan role
    $role_table_map = [
        'Super Admin' => [
            'borrowing_literasi_imajinatif',
            'borrowing_social_connect',
            'borrowing_bisnis_berdaya',
            'borrowing_kreatif_kids_corner',
            'borrowing_pena_inspirasi_gemilang'
        ],
        'Admin Literasi' => ['borrowing_literasi_imajinatif'],
        'Admin Social' => ['borrowing_social_connect'],
        'Admin Bisnis' => ['borrowing_bisnis_berdaya'],
        'Admin Kreatif' => ['borrowing_kreatif_kids_corner'],
        'Admin Pena' => ['borrowing_pena_inspirasi_gemilang']
    ];

    // Dapatkan tabel yang diperbolehkan untuk role saat ini
    $allowed_tables = $role_table_map[$current_role];

    // Dapatkan tabel yang diminta atau gunakan tabel pertama yang diizinkan sebagai default
    $table_name = isset($_GET['table_name']) ? $_GET['table_name'] : $allowed_tables[0];

    // Cek apakah tabel yang diminta sesuai dengan yang diperbolehkan untuk role pengguna
    if (!in_array($table_name, $allowed_tables)) {
        // Jika tidak, gunakan tabel pertama yang diizinkan
        $table_name = $allowed_tables[0];
    }

    // Fungsi untuk mengambil data pinjam dari tabel (Parameter Pencarian: id_book, judul buku, nama peminjam, status)
    function getBooksFromTable($table, $search = null) {
        global $connection;
        $sql = "SELECT id_borrow, id_book, name, title_book, borrow_date, return_date, status FROM $table";
        if ($search) {
            $sql .= " WHERE id_borrow LIKE ? OR id_book LIKE ? OR name LIKE ? OR title_book LIKE ? OR borrow_date LIKE ? OR return_date LIKE ? OR status LIKE ?";
        }
        
        $stmt = mysqli_prepare($connection, $sql);
        if ($search) {
            $search_param = '%' . $search . '%';
            mysqli_stmt_bind_param($stmt, 'sssssss', $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param);
        }
        
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
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

<<<<<<< HEAD
// Mendapatkan data pinjam dari tabel yang dipilih
$table_name = isset($_GET['table_name']) ? $_GET['table_name'] : 'borrowing_literasi_imajinatif';
$tables = [
    'borrowing_literasi_imajinatif' => getBooksFromTable('borrowing_literasi_imajinatif'),
    'borrowing_social_connect' => getBooksFromTable('borrowing_social_connect'),
    'borrowing_pena_inspirasi_gemilang' => getBooksFromTable('borrowing_pena_inspirasi_gemilang'),
    'borrowing_kreatif_kids_corner' => getBooksFromTable('borrowing_kreatif_kids_corner'),
    'borrowing_bisnis_berdaya' => getBooksFromTable('borrowing_bisnis_berdaya'),
];
=======
    // Mendapatkan data pinjam dari tabel yang dipilih
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $books = getBooksFromTable($table_name, $search);
>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388

    // Menangani update status buku
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['update_status']) && isset($_GET['id_borrow']) && isset($_GET['table_name'])) {
        $id_borrow = (int) $_GET['id_borrow'];
        $table_name = $_GET['table_name'];
        updateBookStatus($id_borrow, $table_name);
        echo "<script>alert('Status buku berhasil diperbarui menjadi Tersedia'); window.location.href = 'dashborrow.php?table_name=$table_name';</script>";
    }

<<<<<<< HEAD
// Query untuk mendapatkan data dari tabel yang dipilih
$query = mysqli_query($connection, "SELECT * FROM " . mysqli_real_escape_string($connection, $table_name));
if (!$query) {
    die("Query failed: " . mysqli_error($connection));
}

=======
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
>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku - Cipsmart</title>
    <link rel="stylesheet" href="../css/dashborrow.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <!-- Google Fonts link for Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing delete confirmation code
        document.querySelectorAll('.delete-btn').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const idBorrow = this.dataset.id;
                const tableName = this.dataset.table;

                // Show the delete confirmation popup
                document.querySelector('.cd-popup-del').classList.add('is-visible');

                // Set the confirm button URL
                document.querySelector('.cd-popup-yes-del').dataset.id = idBorrow;
                document.querySelector('.cd-popup-yes-del').dataset.table = tableName;
            });
        });

        document.querySelector('.cd-popup-close-del').addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('.cd-popup-del').classList.remove('is-visible');
        });

        document.querySelector('.cd-popup-yes-del').addEventListener('click', function(event) {
            event.preventDefault();
            const idBorrow = this.dataset.id;
            const tableName = this.dataset.table;
            window.location.href = `dashborrow.php?delete_borrow=1&id_borrow=${idBorrow}&table_name=${tableName}`;
        });

        // New update confirmation code
        document.querySelectorAll('.update-btn').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const idBorrow = this.dataset.id;
                const tableName = this.dataset.table;

                // Show the update confirmation popup
                document.querySelector('.cd-popup-update').classList.add('is-visible');

                // Set the confirm button URL
                document.querySelector('.cd-popup-yes-update').dataset.id = idBorrow;
                document.querySelector('.cd-popup-yes-update').dataset.table = tableName;
            });
        });

        document.querySelector('.cd-popup-close-update').addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('.cd-popup-update').classList.remove('is-visible');
        });

        document.querySelector('.cd-popup-yes-update').addEventListener('click', function(event) {
            event.preventDefault();
            const idBorrow = this.dataset.id;
            const tableName = this.dataset.table;
            window.location.href = `dashborrow.php?update_status=1&id_borrow=${idBorrow}&table_name=${tableName}`;
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
            <li><a href="./dashabsen.php"><i class="fa fa-users"></i> Pengunjung Pojok Baca</a></li>
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li class="active"><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="./dashebook.php"><i class="fa fa-book"></i> E-Book</a></li>
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
            <h2>Peminjaman Buku</h2>

<<<<<<< HEAD
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
=======
            <div class="filter">

                <form action="dashborrow.php" method="get" class="corner-education">
                    <label for="table-dropdown" class="title-ce">Pilih Pojok Baca</label>
                    <select id="table-dropdown" class="drop-ce" name="table_name" onchange="this.form.submit()">
                        <?php if ($_SESSION['role'] != 'Super Admin') echo 'disabled'; ?>>
                        <option value="borrowing_literasi_imajinatif" <?php if ($table_name == 'borrowing_literasi_imajinatif') echo 'selected'; ?>>Literasi Imajinatif</option>
                        <option value="borrowing_social_connect" <?php if ($table_name == 'borrowing_social_connect') echo 'selected'; ?>>Social Connect</option>
                        <option value="borrowing_bisnis_berdaya" <?php if ($table_name == 'borrowing_bisnis_berdaya') echo 'selected'; ?>>Bisnis Berdaya</option>
                        <option value="borrowing_kreatif_kids_corner" <?php if ($table_name == 'borrowing_kreatif_kids_corner') echo 'selected'; ?>>Kreatifitas Kids Corner</option>
                        <option value="borrowing_pena_inspirasi_gemilang" <?php if ($table_name == 'borrowing_pena_inspirasi_gemilang') echo 'selected'; ?>>Pena Inspirasi Gemilang</option>
                    </select>
                    <button type="submit" formaction="../crud/export_borrow.php" class="report-btn">Unduh Laporan</button>
                </form>

                <div class="search-bar">
                    <form action="dashborrow.php" method="get" class="form-search">
                        <input type="hidden" name="table_name" value="<?php echo htmlspecialchars($table_name); ?>">
                        <input type="text" name="search" placeholder="Cari Peminjaman" value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit" class="submit-src">
                            <img src="../img/navbar/search-nav-icon.png" alt="Search">
                        </button>
                    </form>
                </div>

            </div>
>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388
            
            <table id="PinjamTable">
                <thead>
                    <tr>
                        <th>No</th>
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
                            <td class="icon-container">
                                <?php if ($book['status'] === 'Dipinjam') : ?>
                                    <a href="#" class="update-btn" data-id="<?= htmlspecialchars($book['id_borrow']) ?>" data-table="<?= htmlspecialchars($table_name) ?>">
                                        <i class="fa fa-check" style="font-size: 20px"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="#" class="delete-btn" data-id="<?= htmlspecialchars($book['id_borrow']) ?>" data-table="<?= htmlspecialchars($table_name) ?>">
                                    <i class="fa fa-trash" style="font-size: 20px"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Update Confirmation Popup -->
    <div class="cd-popup-update" role="alert">
        <div class="cd-popup-container-update">
            <p>Apakah Buku Telah Dikembalikan?</p>
            <ul class="cd-buttons-update">
                <li><a href="#" class="cd-popup-yes-update" onclick="confirmUpdate()">Ya</a></li>
                <li><a href="#" class="cd-popup-close-update">Tidak</a></li>
            </ul>            
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
            <p>Anda Yakin ingin Keluar?</p>
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
        
   <script src="../js/logout.js"></script>
</body>
</html>
