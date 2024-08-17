<?php
include("koneksi.php");
include 'auth.php';
checkAccess(['Super Admin', 'Admin Literasi', 'Admin Social', 'Admin Bisnis', 'Admin Kreatif', 'Admin Pena']);

// Fungsi untuk mengambil data buku dari tabel (PARAMATER PENCARIAN : id_book, judul buku, penulis, status)
function getBooksFromTable($table, $search = null) {
    global $connection;
    $sql = "SELECT id_book, title_book, author_name, status, photo, publisher_name, year_publish, isbn, sipnopsis, total_page, category FROM $table";
    
    if ($search) {
        $sql .= " WHERE id_book LIKE ? OR title_book LIKE ? OR author_name LIKE ? OR status LIKE ? OR publisher_name LIKE ? OR year_publish LIKE ? OR isbn LIKE ? OR sipnopsis LIKE ? OR total_page LIKE ? OR category LIKE ?";
    }
    
    $stmt = mysqli_prepare($connection, $sql);
    if ($search) {
        $search_param = '%' . $search . '%';
        mysqli_stmt_bind_param($stmt, 'ssssssssss', $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
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

// Determine the table based on user role
switch ($_SESSION['role']) {
    case 'Admin Literasi':
        $table_name = 'book_literasi_imajinatif';
        break;
    case 'Admin Social':
        $table_name = 'book_social_connect';
        break;
    case 'Admin Bisnis':
        $table_name = 'book_bisnis_berdaya';
        break;
    case 'Admin Kreatif':
        $table_name = 'book_kreatif_kids_corner';
        break;
    case 'Admin Pena':
        $table_name = 'book_pena_inspirasi_gemilang';
        break;
    case 'Super Admin':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table_name'])) {
            $table_name = $_POST['table_name'];
        } elseif (isset($_GET['table_name'])) {
            $table_name = $_GET['table_name'];
        } else {
            $table_name = 'book_literasi_imajinatif'; // Default table
        }
        break;
    default:
        // Default table for unexpected roles (just in case)
        $table_name = 'book_literasi_imajinatif';
        break;
}

// Get the search query if it exists
$search = isset($_GET['search']) ? $_GET['search'] : '';
$books = getBooksFromTable($table_name, $search);

// Delete book if delete action is triggered
if (isset($_GET['delete_book']) && isset($_GET['table_name'])) {
    $id_book = $_GET['delete_book'];
    $table_name = $_GET['table_name'];
    if (deleteBook($table_name, $id_book)) {
        echo "<script>alert('Data buku berhasil dihapus'); window.location.href = 'dashbook.php?table_name=$table_name';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data buku');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Cipsmart</title>
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
            <li><a href="./dashboard_kelurahan.php"><i class="fa fa-university"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.php"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li><a href="./dashabsen.php"><i class="fa fa-users"></i> Pengunjung Pojok Baca</a></li>
            <li class="active"><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
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
                <a href="../user/catalog-book.php">
                    <i class="fa fa-book"></i>
                </a>
                <a href="../homepage.php">
                    <i class="fa fa-home"></i>
                </a>
            </div>
        </div>

        <div class="content">
            <div class="titletable">
                <h2>Katalog Buku</h2>
                <a href="../crud/create-book.php">
                    <img src="../img/dashboard/add-btn.png" alt="" class="add-data-btn">
                </a>
            </div>

            <div class="filter">
                <form action="dashbook.php" method="post" class="corner-education">
                    <label for="table-dropdown" class="title-ce">Pilih Pojok Baca</label>
                    <select id="table-dropdown" class="drop-ce" name="table_name" onchange="this.form.submit()" 
                        <?php if ($_SESSION['role'] != 'Super Admin') echo 'disabled'; ?>>
                        <option value="book_literasi_imajinatif" <?php if ($table_name == 'book_literasi_imajinatif') echo 'selected'; ?>>Literasi Imajinatif</option>
                        <option value="book_social_connect" <?php if ($table_name == 'book_social_connect') echo 'selected'; ?>>Social Connect</option>
                        <option value="book_bisnis_berdaya" <?php if ($table_name == 'book_bisnis_berdaya') echo 'selected'; ?>>Bisnis Berdaya</option>
                        <option value="book_kreatif_kids_corner" <?php if ($table_name == 'book_kreatif_kids_corner') echo 'selected'; ?>>Kreatifitas Kids Corner</option>
                        <option value="book_pena_inspirasi_gemilang" <?php if ($table_name == 'book_pena_inspirasi_gemilang') echo 'selected'; ?>>Pena Inspirasi Gemilang</option>
                    </select>
                </form>
    
                <div class="search-bar">
                    <form action="dashbook.php" method="get" class="form-search">
                        <input type="hidden" name="table_name" value="<?php echo htmlspecialchars($table_name); ?>">
                        <input type="text" name="search" placeholder="Cari Buku" value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit" class="submit-src">
                            <img src="../img/navbar/search-nav-icon.png" alt="Search">
                        </button>
                    </form>
                </div>
            </div>

            <table id="pojokBacaTable">
                <thead>
                    <tr>
                        <th>ID Buku</th>
                        <th>Sampul Buku</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>ISBN</th>
                        <th>Sinopsis</th>
                        <th>Total Halaman</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($book['id_book']); ?></td>
                            <td><img src="../<?php echo htmlspecialchars($book['photo']); ?>" alt="Foto Buku" width="50"></td>
                            <td><?php echo htmlspecialchars($book['title_book']); ?></td>
                            <td><?php echo htmlspecialchars($book['category']); ?></td>
                            <td><?php echo htmlspecialchars($book['author_name']); ?></td>
                            <td><?php echo htmlspecialchars($book['publisher_name']); ?></td>
                            <td><?php echo htmlspecialchars($book['year_publish']); ?></td>
                            <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                            <td><?php echo htmlspecialchars($book['sipnopsis']); ?></td>
                            <td><?php echo htmlspecialchars($book['total_page']); ?></td>
                            <td><?php echo htmlspecialchars($book['status']); ?></td>
                            <td>
                            <a href="../crud/update-book.php?id_book=<?php echo htmlspecialchars($book['id_book']); ?>&table_name=<?php echo htmlspecialchars($table_name); ?>">
                                    <i class="fa fa-pencil-square-o edit-btn" style="font-size: 20px"></i>
                                </a>
                                <a href="#" class="cd-popup-trigger-del" onclick="showDeletePopup('<?php echo htmlspecialchars($book['id_book']); ?>', '<?php echo htmlspecialchars($table_name); ?>');">
                                    <i class="fa fa-trash delete-btn" style="font-size: 20px"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Popup -->
    <div class="cd-popup-del" role="alert">
        <div class="cd-popup-container-del">
            <p>Anda Yakin Ingin Hapus Buku ini?</p>
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
    document.addEventListener('DOMContentLoaded', function() {
        var popup = document.querySelector('.cd-popup-del');
        var popupCloseButtons = document.querySelectorAll('.cd-popup-close-del');
        var deleteId = null;
        var deleteTable = null;

        // Function to show delete popup and set the id_book and table_name
        window.showDeletePopup = function(id_book, table_name) {
            deleteId = id_book;
            deleteTable = table_name;
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
            if (deleteId && deleteTable) {
                window.location.href = "dashbook.php?delete_book=" + deleteId + "&table_name=" + deleteTable;
            }
        }

    });
    </script>

    <script src="../js/logout.js"></script>
</body>
</html>
