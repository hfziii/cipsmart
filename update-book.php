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

// Inisialisasi variabel $data dengan data buku dari database berdasarkan id_book
if (isset($_GET['id_book'])) {
    $id_book = input($_GET['id_book']);
    $sql = "SELECT * FROM book WHERE id_book = '$id_book'";
    $result = mysqli_query($connection, $sql);
    $data = mysqli_fetch_assoc($result);
} else {
    echo "ID Book tidak ditemukan!";
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
    $corner_education = input($_POST["corner_education"]);
    $status = input($_POST["status"]);

    // Proses upload photo
    $target_dir = "uploads/";
    $photo = $data['photo']; // Default photo if not updated
    if ($_FILES["photo"]["error"] == 0) {
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
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Query untuk memperbarui data dalam tabel
    $sql = "UPDATE book SET 
            photo = '$photo', 
            title_book = '$title_book', 
            author_name = '$author_name', 
            publisher_name = '$publisher_name', 
            year_publish = '$year_publish', 
            isbn = '$isbn', 
            sipnopsis = '$sipnopsis', 
            total_page = '$total_page', 
            corner_education = '$corner_education', 
            status = '$status' 
            WHERE id_book = '$id_book'";

    // Mengeksekusi query
    $hasil = mysqli_query($connection, $sql);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        header("Location: dashbook.php");
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
    <link href="./css/create-book.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="img/favicon_io/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
        <p class="title-content">Update Buku</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_book=' . $data['id_book'];?>" method="post" enctype="multipart/form-data">
        
            <div class="form-group-container">

                <div class="form-group">
                    <label>ID Book</label>
                    <input type="text" name="id_book" class="form-control" value="<?php echo isset($data['id_book']) ? $data['id_book'] : ''; ?>" required readonly />
                </div>

                <div class="form-group">
                    <label>Foto Buku </label>
                    <input type="file" name="photo" class="form-control" />
                    <?php if (isset($data['photo']) && !empty($data['photo'])) { ?>
                        <img src="<?php echo $data['photo']; ?>" alt="<?php echo $data['title_book']; ?>" style="width: 100px; height: auto; margin-top: 10px;">
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="title_book" class="form-control" value="<?php echo isset($data['title_book']) ? $data['title_book'] : ''; ?>" required  />
                </div>

                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="author_name" class="form-control" value="<?php echo isset($data['author_name']) ? $data['author_name'] : ''; ?>" required  />
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="publisher_name" class="form-control" value="<?php echo isset($data['publisher_name']) ? $data['publisher_name'] : ''; ?>" required  />
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="text" name="year_publish" class="form-control" value="<?php echo isset($data['year_publish']) ? $data['year_publish'] : ''; ?>" required  />
                </div>

                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="<?php echo isset($data['isbn']) ? $data['isbn'] : ''; ?>" required  />
                </div>

                <div class="form-group">
                    <label>Total Halaman</label>
                    <input type="text" name="total_page" class="form-control" value="<?php echo isset($data['total_page']) ? $data['total_page'] : ''; ?>" required  />
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Tersedia" <?php echo isset($data['status']) && $data['status'] == 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                        <option value="Dipinjam" <?php echo isset($data['status']) && $data['status'] == 'Dipinjam' ? 'selected' : ''; ?>>Dipinjam</option>
                        <option value="Rusak" <?php echo isset($data['status']) && $data['status'] == 'Rusak' ? 'selected' : ''; ?>>Rusak</option>
                        <option value="Hilang" <?php echo isset($data['status']) && $data['status'] == 'Hilang' ? 'selected' : ''; ?>>Hilang</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>sipnopsis</label>
                    <textarea name="sipnopsis" class="form-control" style="height: 200px; width: 100%; border-radius: 15px;" required><?php echo isset($data['sipnopsis']) ? htmlspecialchars($data['sipnopsis']) : ''; ?></textarea>
                </div>

                <div class="form-group box-last">
                    <label>Pojok Baca</label>
                    <input type="text" name="corner_education" class="form-control" value="<?php echo isset($data['corner_education']) ? $data['corner_education'] : ''; ?>" required/>
                </div>
                
            </div>

            <div class="button-group">
                <button type="button" onclick="window.location.href='dashbook.php';"
                    class="btn-back">Kembali</button>
                <button type="submit" name="submit" class="btn-input">Simpan</button>
            </div>
        </form>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>
