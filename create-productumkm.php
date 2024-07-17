<?php
// Include file koneksi, untuk koneksikan ke database
include "koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    if (!isset($data)) {
        return '';
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


// Cek kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_photo = input($_POST["product_photo_1"]);
    $product_photo = input($_POST["product_photo_2"]);
    $product_photo = input($_POST["product_photo_3"]);
    $product_photo = input($_POST["product_photo_4"]);
    $product_category = input($_POST["product_category"]);
    $product_name = input($_POST["product_name"]);
    $product_price = input($_POST["product_price"]);
    $product_description = input($_POST["product_description"]);
    $id_seller = input($_POST["seller_name"]);
    $id_seller = input($_POST["no_whatsapp"]);

   // Proses upload photo
   $target_dir = "uploads/umkm/";
   $target_file = $target_dir . basename($_FILES["product_photo"]["product_name"]);
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

   // Check if image file is a actual image or fake image
   $check = getimagesize($_FILES["product_photo"]["tmp_name"]);
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
       if (move_uploaded_file($_FILES["product_photo"]["tmp_name"], $target_file)) {
           $photo = $target_file;

           // Query input menginput data kedalam tabel
           $sql = "INSERT INTO book (product_photo_1, product_photo_2, product_photo_3, product_photo_4, product_category, product_name, product_price, product_description, seller_name, no_whatsapp) VALUES ('$product_photo', '$product_category', '$product_name', '$product_price', '$product_description', '$seller_name', '$no_whatsapp')";

           // Mengeksekusi query
           $hasil = mysqli_query($connection, $sql);

           // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
           if ($hasil) {
               header("Location: dash-productumkm.php");
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
    <title>Tambah Data Produk UMKM-Cipsmart</title>
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
            <li><a href="#"><i class="fa fa-book"></i> E-Book</a></li>
            <li class="active"><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li><a href="#"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li><a href="./dashuser.html"><i class="fa fa-users"></i> Pengguna</a></li>
            <li><a href="./logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="main-content">
        <p class="title-content">Tambah Produk UMKM Baru</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <div class="form-group-container">

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="product_name" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="product_category" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="product_price" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" name="product_description" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Id Seller</label>
                    <input type="text" name="id_seller" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="text" name="tahun_ebook" class="form-control" required />
                </div>
                
                <div class="form-group">
                    <label>Foto Produk 1 (jpg/jpeg/png/gif)</label>
                    <input type="file" name="product_photo_1" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Foto Produk 2 (jpg/jpeg/png/gif)</label>
                    <input type="file" name="product_photo_2" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Foto Produk 3 (jpg/jpeg/png/gif)</label>
                    <input type="file" name="product_photo_3" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Foto Produk 4 (jpg/jpeg/png/gif)</label>
                    <input type="file" name="product_photo_4" class="form-control" required />
                </div>

            </div>

            <div class="button-group">
                <button type="button" onclick="window.location.href='dash-productumkm.php';"
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