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

// Mengambil ID penjual dari URL
$id_seller = isset($_GET['id_seller']) ? input($_GET['id_seller']) : '';

if ($id_seller) {
    // Fetch seller data
    $seller_query = "SELECT id_seller, seller_name, no_whatsapp, address_seller FROM seller_umkm WHERE id_seller = '$id_seller'";
    $seller_result = mysqli_query($connection, $seller_query);
    $data = mysqli_fetch_assoc($seller_result);
}

// Cek kiriman form dari method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_seller = input($_POST["id_seller"]);
    $seller_name = input($_POST["seller_name"]);
    $no_whatsapp = input($_POST["no_whatsapp"]);
    $address_seller = input($_POST["address_seller"]);
    
    // Query update data dalam tabel
    $sql = "UPDATE seller_umkm SET 
            seller_name = '$seller_name', 
            no_whatsapp = '$no_whatsapp', 
            address_seller = '$address_seller' 
            WHERE id_seller = '$id_seller'";

    // Mengeksekusi query
    $hasil = mysqli_query($connection, $sql);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        header("Location: ../admin/dash-sellerumkm.php");
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
    <title>Update Penjual UMKM-Cipsmart</title>
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
        <li class="disabled"><a href="#"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
        <li class="disabled"><a href="#"><i class="fa fa-book"></i> E-Book</a></li>
        <li class="disabled"><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
        <li class="active"><a href="#"><i class="fa fa-users"></i> Update Penjual UMKM</a></li>
        <li class="disabled"><a href="#"><i class="fa fa-sign-out"></i> Keluar</a></li>
    </ul>
</div>
<div class="main-content" style="margin-top: 8%;">
    <p class="title-content">Update Penjual UMKM</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_seller=' . $data['id_seller']; ?>" method="post">
        <div class="form-group-container">

            <div class="form-group">
                <label>ID Penjual</label>
                <input type="text" name="id_seller" class="form-control" value="<?php echo isset($data['id_seller']) ? $data['id_seller'] : ''; ?>" readonly />
            </div>

            <div class="form-group">
                <label>Nama Penjual</label>
                <input type="text" name="seller_name" class="form-control" value="<?php echo isset($data['seller_name']) ? $data['seller_name'] : ''; ?>" required />
            </div>

            <div class="form-group">
                <label>No Whatsapp</label>
                <input type="text" name="no_whatsapp" class="form-control" value="<?php echo isset($data['no_whatsapp']) ? $data['no_whatsapp'] : ''; ?>" required />
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="address_seller" class="form-control" value="<?php echo isset($data['address_seller']) ? $data['address_seller'] : ''; ?>" required />
            </div>

        </div>

        <div class="button-group">
            <button type="button" onclick="window.location.href='../admin/dash-sellerumkm.php';" class="btn-back">Kembali</button>
            <button type="submit" name="submit" class="btn-input">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

</body>

</html>
