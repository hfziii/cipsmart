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

// Inisialisasi variabel $data dengan data buku dari database berdasarkan id_ebook
if (isset($_GET['id_ebook'])) {
    $id_ebook = input($_GET['id_ebook']);
    $sql = "SELECT * FROM ebook WHERE id_ebook = '$id_ebook'";
    $result = mysqli_query($connection, $sql);
    $data = mysqli_fetch_assoc($result);
} else {
    echo "ID ebook tidak ditemukan!";
    exit();
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

    // Inisialisasi variabel error
    $errorMessages = [];

    // Proses upload sampul ebook
    $sampul_ebook = $data['sampul_ebook']; // Default to existing file
    if (!empty($_FILES["sampul_ebook"]["name"])) {
        $target_dir_sampul = "uploads/ebook/";
        $target_file_sampul = $target_dir_sampul . basename($_FILES["sampul_ebook"]["name"]);
        $uploadOkSampul = 1;
        $imageFileType = strtolower(pathinfo($target_file_sampul, PATHINFO_EXTENSION));

        if (!empty($_FILES["sampul_ebook"]["tmp_name"])) {
            $check = getimagesize($_FILES["sampul_ebook"]["tmp_name"]);
            if ($check === false) {
                $errorMessages[] = "File is not an image.";
                $uploadOkSampul = 0;
            }
        } else {
            $uploadOkSampul = 0;
        }

        if (file_exists($target_file_sampul)) {
            $errorMessages[] = "Sorry, file already exists.";
            $uploadOkSampul = 0;
        }

        if ($_FILES["sampul_ebook"]["size"] > 5000000) {
            $errorMessages[] = "Sorry, your file is too large.";
            $uploadOkSampul = 0;
        }

        $allowed_formats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_formats)) {
            $errorMessages[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOkSampul = 0;
        }

        if ($uploadOkSampul == 1) {
            if (move_uploaded_file($_FILES["sampul_ebook"]["tmp_name"], $target_file_sampul)) {
                $sampul_ebook = $target_file_sampul;
            } else {
                $errorMessages[] = "Sorry, there was an error uploading your sampul.";
            }
        }
    }

    // Proses upload file ebook
    $file_ebook = $data['file_ebook']; // Default to existing file
    if (!empty($_FILES["file_ebook"]["name"])) {
        $target_dir_file = "uploads/ebook/";
        $target_file_file = $target_dir_file . basename($_FILES["file_ebook"]["name"]);
        $uploadOkFile = 1;
        $fileFileType = strtolower(pathinfo($target_file_file, PATHINFO_EXTENSION));

        if ($fileFileType != "pdf") {
            $errorMessages[] = "Sorry, only PDF files are allowed.";
            $uploadOkFile = 0;
        }

        if (file_exists($target_file_file)) {
            $errorMessages[] = "Sorry, file already exists.";
            $uploadOkFile = 0;
        }

        if ($_FILES["file_ebook"]["size"] > 10000000) { // 10MB
            $errorMessages[] = "Sorry, your file is too large.";
            $uploadOkFile = 0;
        }

        if ($uploadOkFile == 1) {
            if (move_uploaded_file($_FILES["file_ebook"]["tmp_name"], $target_file_file)) {
                $file_ebook = $target_file_file;
            } else {
                $errorMessages[] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (empty($errorMessages)) {
        $sql = "UPDATE ebook SET 
                    sampul_ebook='$sampul_ebook', 
                    file_ebook='$file_ebook', 
                    judul_ebook='$judul_ebook', 
                    kategori_ebook='$kategori_ebook', 
                    penulis_ebook='$penulis_ebook', 
                    penerbit_ebook='$penerbit_ebook', 
                    jumlah_halaman_ebook='$jumlah_halaman_ebook', 
                    tahun_ebook='$tahun_ebook', 
                    isbn_ebook='$isbn_ebook', 
                    sipnopsis_ebook='$sipnopsis_ebook' 
                WHERE id_ebook='$id_ebook'";

        if (mysqli_query($connection, $sql)) {
            header("Location: dashebook.php");
            exit();
        } else {
            $errorMessages[] = "Data Gagal disimpan. Error: " . mysqli_error($connection);
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
    <title>Update Data E Book-Cipsmart</title>
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
        <li class="disabled"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="disabled"><a href="./dashadmin.html"><i class="fa fa-user"></i> Admin</a></li>
        <li class="disabled"><a href="#"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
        <li class="disabled"><a href="./dashcorner.html"><i class="fa fa-book"></i> Pojok Baca</a></li>
        <li class="disabled"><a href="#"><i class="fa fa-book"></i> Buku</a></li>
        <li class="disabled"><a href="./dashborrow.html"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
        <li class="active"><a href="#"><i class="fa fa-book"></i> Update Data E-Book</a></li>
        <li class="disabled"><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
        <li class="disabled"><a href="#"><i class="fa fa-users"></i> Penjual UMKM</a></li>
        <li class="disabled"><a href="./dashuser.html"><i class="fa fa-users"></i> Pengguna</a></li>
        <li class="disabled"><a href="./logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
    </ul>
</div>

<div class="container">

    <?php
    if (!empty($errorMessages)) {
        echo '<div class="alert alert-danger">';
        foreach ($errorMessages as $message) {
            echo "<p>$message</p>";
        }
        echo '</div>';
    }
    ?>

    <div class="main-body">
        <div class="row">
            <div class="col-lg-8 mt-5">
                <form id="updateForm" action="update-ebook.php?id_ebook=<?php echo $id_ebook; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_ebook" value="<?php echo $data['id_ebook']; ?>">
                    <div class="card">
                        <div class="card-body">
                                                       
                            <!-- Judul -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Judul E-Book</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="judul_ebook" class="form-control" value="<?php echo isset($data['judul_ebook']) ? $data['judul_ebook'] : ''; ?>" required />
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Judul E-Book</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="kategori_ebook" class="form-control" value="<?php echo isset($data['kategori_ebook']) ? $data['kategori_ebook'] : ''; ?>" required />
                                </div>
                            </div>
                            <!-- Nama Penulis -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Penulis</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="penulis_ebook" class="form-control" value="<?php echo isset($data['penulis_ebook']) ? $data['penulis_ebook'] : ''; ?>" required />
                                </div>
                            </div>
                            <!-- Nama Penerbit -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Penerbit</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="penerbit_ebook" class="form-control" value="<?php echo isset($data['penerbit_ebook']) ? $data['penerbit_ebook'] : ''; ?>" required />
                                </div>
                            </div>
                            <!-- Tahun Terbit -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Tahun Terbit</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="tahun_ebook" class="form-control" value="<?php echo isset($data['tahun_ebook']) ? $data['tahun_ebook'] : ''; ?>" required />
                                </div>
                            </div>
                            <!-- ISBN -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">ISBN</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="isbn_ebook" class="form-control" value="<?php echo isset($data['isbn_ebook']) ? $data['isbn_ebook'] : ''; ?>" required />
                                </div>
                            </div>
                            <!-- Sinopsis -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Sinopsis</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea name="sipnopsis_ebook" style="height: 100px; width: 100%;" class="form-control form-sipnopsis" required><?php echo isset($data['sipnopsis_ebook']) ? $data['sipnopsis_ebook'] : ''; ?></textarea>
                                </div>
                            </div>
                            <!-- Total Halaman -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Total Halaman</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="jumlah_halaman_ebook" class="form-control" value="<?php echo isset($data['jumlah_halaman_ebook']) ? $data['jumlah_halaman_ebook'] : ''; ?>" required />
                                </div>
                            </div>
                           
                            <!-- Upload Sampul E-Book -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Upload Sampul</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" name="sampul_ebook" class="form-control" />
                                </div>
                            </div>
                            
                            <!-- File -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h5 class="mb-0">Upload File</h5>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" name="file_ebook" class="form-control" accept="application/pdf" />
                                    
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
                            <h5 class="mb-3">Sampul E-Book Sebelumnya</h5>
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?php echo htmlspecialchars($data['sampul_ebook']); ?>" alt="Sampul E-Book" class="img-thumbnail" style="max-width: 100%;">
                                <?php if (isset($data['file_ebook']) && !empty($data['file_ebook'])) { ?>
                                    <a href="<?php echo $data['file_ebook']; ?>" target="_blank" class="link-read">
                                        <img src="../img/detail/read-pdf.png" alt="Read">
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                                        
                <div class="btn-container">
                    <a href="dashebook.php" class="btn btn-secondary mt-3"><i class="fa fa-arrow-left"></i> Kembali ke Dashboard</a>
                    <input type="submit" class="btn btn-primary px-4 mt-3" value="Update" onclick="submitForm()">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
function submitForm() {
    document.getElementById("updateForm").submit();
}
</script>
</body>
</html>
