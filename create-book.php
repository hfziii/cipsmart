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

    $id_book = input($_POST["id_book"]);
    $title_book = input($_POST["title_book"]);
    $author_name = input($_POST["author_name"]);
    $publisher_name = input($_POST["publisher_name"]);
    $year_publish = input($_POST["year_publish"]);
    $isbn = input($_POST["isbn"]);
    $sipnopsis = input($_POST["sipnopsis"]);
    $total_page = input($_POST["total_page"]);
    $corner_education = input($_POST["corner_education"]);
    $status = input($_POST["status"]);

    // Proses upload photo
    $target_dir = "uploads/";
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
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = $target_file;

            // Query input menginput data kedalam tabel
            $sql = "INSERT INTO book (id_book, photo, title_book, author_name, publisher_name, year_publish, isbn, sipnopsis, total_page, corner_education, status) VALUES ('$id_book', '$photo', '$title_book', '$author_name', '$publisher_name', '$year_publish', '$isbn', '$sipnopsis', '$total_page', '$corner_education', '$status')";

            // Mengeksekusi query
            $hasil = mysqli_query($connection, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
            if ($hasil) {
                header("Location: dashbook.php");
                exit(); // untuk menghentikan eksekusi skrip
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan. Error: " . mysqli_error($connection) . "</div>";
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
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
    <title>Tambah Data Buku-Cipsmart</title>
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
            <li class="active"><a href="#"><i class="fa fa-book"></i> Buku</a></li>
            <li><a href="./dashborrow.html"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li><a href="#"><i class="fa fa-book"></i> E-Book</a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="#"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li><a href="./dashuser.html"><i class="fa fa-users"></i> Pengguna</a></li>
            <li><a href="./logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="main-content">
        <p class="title-content">Tambah Buku Baru</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <div class="form-group-container">

                <div class="form-group">
                    <label>ID Book</label>
                    <input type="text" name="id_book" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Foto Buku </label>
                    <input type="file" name="photo" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="title_book" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="author_name" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="publisher_name" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="text" name="year_publish" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Total Halaman</label>
                    <input type="text" name="total_page" class="form-control" required />
                </div>

                
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipinjam">Dipinjam</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Hilang">Hilang</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Sipnopsis</label>
                    <textarea name="sipnopsis" style="height: 200px; width: 100%; border-radius: 15px;" class="form-control form-sipnopsis" required></textarea>
                </div>

                <div class="form-group box-last">
                    <label>Pojok Baca</label>
                    <input type="text" name="corner_education" class="form-control" required />
                </div>
                
            </div>

            <div class="button-group">
                <button type="button" onclick="window.location.href='dashbook.php';"
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