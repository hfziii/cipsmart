<?php
// Include file koneksi, untuk koneksikan ke database
include "koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    if (!isset($data)) {
        return "";
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fungsi untuk mengambil data buku dari tabel
function getBookById($id_book, $table_name) {
    global $connection;
    $sql = "SELECT * FROM $table_name WHERE id_book = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id_book);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Mengambil data buku dari semua tabel
$tables = [
    'book_literasi_imajinatif' => 'Literasi Imajinatif',
    'book_social_connect' => 'Social Connect',
    'book_pena_inspirasi_gemilang' => 'Pena Inspirasi Gemilang',
    'book_kreatif_kids_corner' => 'Kreatif Kids Corner',
    'book_bisnis_berdaya' => 'Bisnis Berdaya',
];

// Inisialisasi variabel $data dengan data buku dari database berdasarkan id_book
$data = [];
$table_name = "";

if (isset($_GET['id_book']) && isset($_GET['table_name'])) {
    $id_book = input($_GET['id_book']);
    $table_name = input($_GET['table_name']);
    
    if (!array_key_exists($table_name, $tables)) {
        echo "Invalid table_name.";
        exit();
    }

    $data = getBookById($id_book, $table_name);
    if (!$data) {
        echo "Data buku tidak ditemukan.";
        exit();
    }
} else {
    echo "ID Book atau Table Name tidak ditemukan!";
    exit();
}

// Cek kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_book = input($_POST["id_book"]);
    $title_book = input($_POST["title_book"]);
    $author_name = input($_POST["author_name"]);
    $publisher_name = input($_POST["publisher_name"]);
    $year_publish = input($_POST["year_publish"]);
    $isbn = input($_POST["isbn"]);
    $sipnopsis = input($_POST["sipnopsis"]);
    $total_page = input($_POST["total_page"]);
    $status = input($_POST["status"]);
    $id_corner = $table_name;

    // Menentukan target directory berdasarkan id_corner
    $target_dir = "../uploads/";
    switch ($id_corner) {
        case 'book_literasi_imajinatif':
            $target_dir .= "BOOK_CE-1/";
            break;
        case 'book_social_connect':
            $target_dir .= "BOOK_CE-2/";
            break;
        case 'book_bisnis_berdaya':
            $target_dir .= "BOOK_CE-3/";
            break;
        case 'book_kreatif_kids_corner':
            $target_dir .= "BOOK_CE-4/";
            break;
        case 'book_pena_inspirasi_gemilang':
            $target_dir .= "BOOK_CE-5/";
            break;
        default:
            echo "Invalid id_corner.";
            exit();
    }

    // Buat folder jika belum ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Update foto buku jika ada yang diunggah
    if (!empty($_FILES["photo"]["name"])) {
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["photo"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowed_formats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_formats)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $photo = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Jika tidak ada file baru diunggah, gunakan foto yang sudah ada
        $photo = $data['photo'];
    }

    // Menentukan tabel berdasarkan id_corner
    $table_name = $id_corner;

    // Query update untuk memperbarui data buku
    $sql = "UPDATE $table_name SET 
            title_book = ?,
            author_name = ?,
            publisher_name = ?,
            year_publish = ?,
            isbn = ?,
            sipnopsis = ?,
            total_page = ?,
            status = ?,
            photo = ?
            WHERE id_book = ?";

    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssssss', $title_book, $author_name, $publisher_name, $year_publish, $isbn, $sipnopsis, $total_page, $status, $photo, $id_book);

    // Eksekusi query update
    $result = mysqli_stmt_execute($stmt);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
    if ($result) {
        header("Location: ../admin/dashbook.php?table_name=$table_name");
        exit(); // untuk menghentikan eksekusi skrip
    } else {
        echo "<div class='alert alert-danger'> Data Gagal diperbarui. Error: " . mysqli_error($connection) . "</div>";
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
    <!-- Google Fonts link for Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
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
            <li class="active"><a href=""><i class="fa fa-book"></i> Update Data Buku</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
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
                    <form id="updateForm" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">
                                <!-- ID Buku -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">ID Buku</h5>
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
                                        <input type="text" class="form-control" name="title_book" value="<?php echo htmlspecialchars($data['title_book']); ?>" required>
                                    </div>
                                </div>
                                <!-- Nama Penulis -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Penulis</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="author_name" value="<?php echo htmlspecialchars($data['author_name']); ?>" required>
                                    </div>
                                </div>
                                <!-- Nama Penerbit -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Penerbit</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="publisher_name" value="<?php echo htmlspecialchars($data['publisher_name']); ?>" required>
                                    </div>
                                </div>
                                <!-- Tahun Terbit -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Tahun Terbit</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" class="form-control" name="year_publish" value="<?php echo htmlspecialchars($data['year_publish']); ?>" required>
                                    </div>
                                </div>
                                <!-- ISBN -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">ISBN</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="isbn" value="<?php echo htmlspecialchars($data['isbn']); ?>" required>
                                    </div>
                                </div>
                                <!-- Sinopsis -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Sinopsis</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea class="form-control" name="sipnopsis" style="height: 80px; width: 100%;" required><?php echo htmlspecialchars($data['sipnopsis']); ?></textarea>
                                    </div>
                                </div>
                                <!-- Total Halaman -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Total Halaman</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" class="form-control" name="total_page" value="<?php echo htmlspecialchars($data['total_page']); ?>" required>
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
                                <!-- Pojok Baca -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Pojok Baca</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-control" name="id_corner" disabled>
                                            <?php
                                            foreach ($tables as $key => $value) {
                                                $selected = ($table_name == $key) ? 'selected' : '';
                                                echo "<option value='$key' $selected>$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Upload Foto Buku Baru -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h5 class="mb-0">Upload Foto Baru</h5>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" class="form-control" name="photo">
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
                        <a href="../admin/dashbook.php?table_name=<?php echo $table_name; ?>" class="btn btn-secondary mt-3"><i class="fa fa-arrow-left"></i> Kembali ke Dashboard</a>
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
