<?php
// Include file koneksi, untuk koneksikan ke database
include "koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Nama tabel yang akan digunakan
$table_name = 'book_literasi_imajinatif'; // Contoh nama tabel

// Mengambil ID dari URL
$id_borrow = isset($_GET['id_borrow']) ? input($_GET['id_borrow']) : '';

if ($id_borrow) {
    // Fetch data
    $borrow_query = "SELECT id_borrow, id_book, name, title_book, borrow_date, return_date, status FROM $table_name WHERE id_borrow = '$id_borrow'";
    $borrow_result = mysqli_query($connection, $borrow_query);
    if (!$borrow_result) {
        die("Error fetching data: " . mysqli_error($connection));
    }
    $data = mysqli_fetch_assoc($borrow_result);
}

// Cek kiriman form dari method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_borrow = input($_POST["id_borrow"]);
    $id_book = input($_POST["id_book"]);
    $name = input($_POST["name"]);
    $title_book = input($_POST["title_book"]);
    $borrow_date = input($_POST["borrow_date"]);
    $return_date = input($_POST["return_date"]);
    $status = input($_POST["status"]);
    
    // Query update data dalam tabel
    $sql = "UPDATE $table_name SET 
            id_book = '$id_book',
            name = '$name',
            title_book = '$title_book',
            borrow_date = '$borrow_date',
            return_date = '$return_date',
            status = '$status'
            WHERE id_borrow = '$id_borrow'";

    // Mengeksekusi query
    $hasil = mysqli_query($connection, $sql);
    if (!$hasil) {
        die("Error updating data: " . mysqli_error($connection));
    }

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        header("Location: ../admin/dashborrow.php");
        exit(); // untuk menghentikan eksekusi skrip
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan. Error: " . mysqli_error($connection) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Buku</title>
    <link href="../css/create-book.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="../img/favicon/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../img/dashboard/logo-cipsmart-profile.png" alt="Logo">
        </div>
        <ul>
            <li class="disabled"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-user"></i> Admin</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-users"></i> Absen Pojok Baca</a></li>
            <li class="disabled"><a href=""><i class="fa fa-book"></i> Buku</a></li>
            <li class="active"><a href="#"><i class="fa fa-exchange"></i> Update Peminjaman Buku</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-book"></i> E-Book</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8 mt-5">
                    <form id="updateForm" method="post" enctype="multipart/form-data" action="">
                        <div class="card">
                            <div class="card-body">
                                <!-- ID Buku -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">ID Book</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="id_book" value="<?php echo htmlspecialchars($data['id_book']); ?>" readonly>
                                    </div>
                                </div>
                                <!-- Judul Buku -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Judul Buku</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="title_book" value="<?php echo htmlspecialchars($data['title_book']); ?>" readonly>
                                    </div>
                                </div>
                                <!-- Nama Penulis -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Nama Peminjam</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" readonly>
                                    </div>
                                </div>
                                <!-- Nama Penerbit -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Tanggal Pinjam</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="borrow_date" value="<?php echo htmlspecialchars($data['borrow_date']); ?>" required>
                                    </div>
                                </div>
                                <!-- Tahun Terbit -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Tanggal Kembali</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" class="form-control" name="return_date" value="<?php echo htmlspecialchars($data['return_date']); ?>" required>
                                    </div>
                                </div>                                
                                <!-- Status -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Status</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-control" name="status" required>
                                            <option value="Tersedia" <?php if ($data['status'] == 'Tersedia') echo 'selected'; ?>>Tersedia</option>
                                            <option value="Dipinjam" <?php if ($data['status'] == 'Dipinjam') echo 'selected'; ?>>Dipinjam</option>
                                            <option value="Rusak" <?php if ($data['status'] == 'Rusak') echo 'selected'; ?>>Rusak</option>
                                            <option value="Hilang" <?php if ($data['status'] == 'Hilang') echo 'selected'; ?>>Hilang</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Foto Buku Sebelumnya dan Tombol Kembali -->
                <div class="col-lg-4 mt-5">
                    <div class="card">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="mb-3">Foto Buku Sebelumnya</h5>
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="../<?php echo htmlspecialchars($data['photo']); ?>" alt="Foto Buku" class="img-thumbnail" style="max-width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-container">
                        <a href="../admin/dashborrow.php" class="btn btn-secondary mt-3"><i class="fa fa-arrow-left"></i> Kembali ke Dashboard</a>
                        <input type="submit"  class="btn btn-primary px-4 mt-3" value="Update" onclick="submitForm()">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function submitForm() {
        document.getElementById("updateForm").submit();
    }
    </script>
</body>

</html>
