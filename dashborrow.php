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
    <link rel="stylesheet" href="./css/dashborrow.css">
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
            <li><a href="./dashbook.php"><i class="fa fa-book"></i> Buku</a></li>
            <li class="active"><a href="./dashborrow.php"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
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
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Status Buku</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($query) == 0) {
                            echo "<tr><td colspan='8'>Tidak ada data.</td></tr>";
                        } else {
                            while ($data = mysqli_fetch_assoc($query)) {
                                echo "<tr>";
                                echo "<td>{$data['id_borrow']}</td>";
                                echo "<td>{$data['id_book']}</td>";
                                echo "<td>{$data['name']}</td>";
                                echo "<td>{$data['title_book']}</td>";
                                echo "<td>{$data['borrow_date']}</td>";
                                echo "<td>{$data['return_date']}</td>";
                                echo "<td>{$data['status']}</td>";
                                echo "<td>";
                                echo "<a href='#' class='edit-btn' data-id='{$data['id_borrow']}' data-table='{$table_name}'><i class='fa fa-check'></i></a>";
                                echo "<a href='dashborrow.php?id_borrow={$data['id_borrow']}&table_name={$table_name}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'><i class='fa fa-trash'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-btn');
        
        editButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var idBorrow = button.getAttribute('data-id');
                var tableName = button.getAttribute('data-table');

                // Prepare form data
                var formData = new FormData();
                formData.append('id_borrow', idBorrow);
                formData.append('table_name', tableName);
                formData.append('status', 'Tersedia');

                // Send the request to update the status
                fetch('update_borrow.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload the table with updated data
                        var tableBody = document.querySelector('#PinjamTable tbody');
                        tableBody.innerHTML = '';

                        data.books.forEach(function(book) {
                            var row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${book.id_borrow}</td>
                                <td>${book.id_book}</td>
                                <td>${book.name}</td>
                                <td>${book.title_book}</td>
                                <td>${book.borrow_date}</td>
                                <td>${book.return_date}</td>
                                <td>${book.status}</td>
                                <td>
                                    <a href="#" class="edit-btn" data-id="${book.id_borrow}" data-table="${book.table_name}">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a href="dashborrow.php?id_borrow=${book.id_borrow}&table_name=${book.table_name}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
    </script>


</body>
</html>