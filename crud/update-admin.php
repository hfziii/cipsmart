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

// Inisialisasi variabel $data dengan data dari database berdasarkan id
if (isset($_GET['id_admin'])) {
    $id_admin = input($_GET['id_admin']);
    $sql = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        if (!$data) {
            echo "Data tidak ditemukan!";
            exit();
        }
    } else {
        echo "Query error: " . mysqli_error($connection);
        exit();
    }
} else {
    echo "ID tidak ditemukan!";
    exit();
}

// Cek kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = input($_POST["name"]);
    $nohp = input($_POST["nohp"]);
    $username = input($_POST["username"]);
    $password = input($_POST["password"]);
    $role = input($_POST["role"]);

    // Query untuk mengupdate data di tabel admin
    $sql = "UPDATE admin SET name='$name', nohp='$nohp', username='$username', password='$password', role='$role' WHERE id_admin='$id_admin'";

    // Mengeksekusi query
    $hasil = mysqli_query($connection, $sql);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        header("Location: ../admin/dashadmin.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin - Cipsmart</title>
    <link href="../css/create-book.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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
            <li class="active"><a href="#"><i class="fa fa-user"></i> Update Admin</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-home"></i> Profile Kelurahan</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-book"></i> Pojok Baca</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-users"></i> Pengunjung Pojok Baca</a></li>
            <li class="disabled"><a href=""><i class="fa fa-book"></i> Data Buku</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-book"></i> E-Book</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="main-content" style="margin-top: 8%;">            
        <p class="title-content">Update Admin</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_admin=' . $id_admin; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group-container">

                <div class="form-group">
                    <label>Nama Admin</label>
                    <input type="text" name="name" class="form-control" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" required />
                </div>

                <div class="form-group">
                    <label>No Hp</label>
                    <input type="text" name="nohp" class="form-control" value="<?php echo isset($data['nohp']) ? $data['nohp'] : ''; ?>" required />
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>" required />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>" required />
                </div>

                <div class="form-group">
                    <label>Hak Akses</label>
                    <select name="role" class="form-control" required>
                        <option value="Super Admin" <?php if ($data['role'] == 'Super Admin') echo 'selected'; ?>>Super Admin</option>
                        <option value="Admin Kelurahan" <?php if ($data['role'] == 'Admin Kelurahan') echo 'selected'; ?>>Kelurahan</option>
                        <option value="Admin Literasi" <?php if ($data['role'] == 'Admin Literasi') echo 'selected'; ?>>Literasi Imajinatif</option>
                        <option value="Admin Social" <?php if ($data['role'] == 'Admin Social') echo 'selected'; ?>>Social Connect</option>
                        <option value="Admin Bisnis" <?php if ($data['role'] == 'Admin Bisnis') echo 'selected'; ?>>Bisnis Berdaya</option>
                        <option value="Admin Kreatif" <?php if ($data['role'] == 'Admin Kreatif') echo 'selected'; ?>>Kreatif Kids Corner</option>
                        <option value="Admin Pena" <?php if ($data['role'] == 'Admin Pena') echo 'selected'; ?>>Pena Inspirasi Gemilang</option>
                        <option value="Admin UMKM" <?php if ($data['role'] == 'Admin UMKM') echo 'selected'; ?>>UMKM</option>
                    </select>
                </div>

            </div>

            <div class="button-group">
                <button type="button" onclick="window.location.href='../admin/dashadmin.php';" class="btn-back">Kembali</button>
                <button type="submit" name="submit" class="btn-input">Simpan</button>
            </div>
        </form>
        
    </div>
</body>
</html>
