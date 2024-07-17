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

// Cek kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_ebook = input($_POST["id_ebook"]);
    $judul_ebook = input($_POST["judul_ebook"]);
    $kategori_ebook = input($_POST["kategori_ebook"]);
    $penulis_ebook = input($_POST["penulis_ebook"]);
    $penerbit_ebook = input($_POST["penerbit_ebook"]);
    $jumlah_halaman_ebook = input($_POST["jumlah_halaman_ebook"]);
    $tahun_ebook = input($_POST["tahun_ebook"]);
    $isbn_ebook = input($_POST["isbn_ebook"]);
    $sipnopsis_ebook = input($_POST["sipnopsis_ebook"]);

    // Proses upload sampul ebook
    $target_dir_sampul = "uploads/ebook/";
    $target_file_sampul = $target_dir_sampul . basename($_FILES["sampul_ebook"]["name"]);
    $uploadOkSampul = 1;
    $imageFileType = strtolower(pathinfo($target_file_sampul, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["sampul_ebook"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOkSampul = 0;
    }

    // Check if file already exists
    if (file_exists($target_file_sampul)) {
        echo "Sorry, file already exists.";
        $uploadOkSampul = 0;
    }

    // Check file size
    if ($_FILES["sampul_ebook"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOkSampul = 0;
    }

    // Allow certain file formats
    $allowed_formats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOkSampul = 0;
    }

    // Proses upload file ebook
    $target_dir_file = "uploads/ebook/";
    $target_file_file = $target_dir_file . basename($_FILES["file_ebook"]["name"]);
    $uploadOkFile = 1;
    $fileFileType = strtolower(pathinfo($target_file_file, PATHINFO_EXTENSION));

    // Check if file is a actual pdf
    if ($fileFileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOkFile = 0;
    }

    // Check if file already exists
    if (file_exists($target_file_file)) {
        echo "Sorry, file already exists.";
        $uploadOkFile = 0;
    }

    // Check file size
    if ($_FILES["file_ebook"]["size"] > 10000000) { // 10MB
        echo "Sorry, your file is too large.";
        $uploadOkFile = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOkSampul == 0 || $uploadOkFile == 0) {
        echo "Sorry, your files were not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["sampul_ebook"]["tmp_name"], $target_file_sampul) && move_uploaded_file($_FILES["file_ebook"]["tmp_name"], $target_file_file)) {
            $sampul_ebook = $target_file_sampul;
            $file_ebook = $target_file_file;

            // Query input menginput data kedalam tabel
            $sql = "INSERT INTO ebook (id_ebook, sampul_ebook, file_ebook, judul_ebook, kategori_ebook, penulis_ebook, penerbit_ebook, jumlah_halaman_ebook, tahun_ebook, isbn_ebook, sipnopsis_ebook) VALUES ('$id_ebook', '$sampul_ebook', '$file_ebook', '$judul_ebook', '$kategori_ebook', '$penulis_ebook', '$penerbit_ebook', '$jumlah_halaman_ebook', '$tahun_ebook', '$isbn_ebook', '$sipnopsis_ebook')";

            // Mengeksekusi query
            $hasil = mysqli_query($connection, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
            if ($hasil) {
                header("Location: dashebook.php");
                exit(); // untuk menghentikan eksekusi skrip
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan. Error: " . mysqli_error($connection) . "</div>";
            }

        } else {
            echo "Sorry, there was an error uploading your files.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data E Book-Cipsmart</title>
    <link href="./css/create-book.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="img/favicon/android-chrome-192x192.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="./img/dashboard/logo-cipsmart-profile.png" alt="Logo">
        </div>
        <ul>
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="./dashadmin.html"><i class="fa fa-user"></i> Admin</a></li>
            <li><a href="#"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li><a href="./dashcorner.html"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.html"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li class="active"><a href="#"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="#"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li><a href="./dashuser.html"><i class="fa fa-users"></i> Pengguna</a></li>
            <li><a href="./logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="main-content">
        <p class="title-content">Tambah E-Book Baru</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <div class="form-group-container">

                <div class="form-group">
                    <label>ID E-Book</label>
                    <input type="text" name="id_ebook" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul_ebook" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori_ebook" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="penulis_ebook" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit_ebook" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Jumlah Halaman</label>
                    <input type="text" name="jumlah_halaman_ebook" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="text" name="tahun_ebook" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn_ebook" class="form-control" required />
                </div>
                
                <div class="form-group">
                    <label>Sampul E-Book (jpg/jpeg/png/gif)</label>
                    <input type="file" name="sampul_ebook" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>File E-Book (PDF)</label>
                    <input type="file" name="file_ebook" class="form-control" accept="application/pdf" required />
                </div>

                <div class="form-group">
                    <label>Sipnopsis</label>
                    <textarea name="sipnopsis_ebook" style="height: 200px; width: 100%; border-radius: 15px;" class="form-control form-sipnopsis" required></textarea>
                </div>

            </div>

            <div class="button-group">
                <button type="button" onclick="window.location.href='dashebook.php';"
                    class="btn-back">Kembali</button>
                <button type="submit" name="submit" class="btn-input">Simpan</button>
            </div>
        </form>
    </div>

           

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>