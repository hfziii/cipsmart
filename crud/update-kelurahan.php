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
if (isset($_GET['id_profile'])) {
    $id_profile = input($_GET['id_profile']);
    $sql = "SELECT * FROM profile_kelurahan WHERE id_profile = '$id_profile'";
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

    $luas_wilayah = input($_POST["luas_wilayah"]);
    $jumlah_rw = input($_POST["jumlah_rw"]);
    $jumlah_rt = input($_POST["jumlah_rt"]);
    $jumlah_penduduk = input($_POST["jumlah_penduduk"]);
    $laki_laki = input($_POST["laki_laki"]);
    $perempuan = input($_POST["perempuan"]);
    $anak_anak = input($_POST["anak_anak"]);
    $remaja = input($_POST["remaja"]);
    $dewasa = input($_POST["dewasa"]);
    $tamat_sd_smp = input($_POST["tamat_sd_smp"]);
    $tamat_sma = input($_POST["tamat_sma"]);
    $tamat_sarjana = input($_POST["tamat_sarjana"]);
    $deskripsi = input($_POST["deskripsi"]);
    
    // Query untuk mengupdate data di tabel profile_kelurahan
    $sql = "UPDATE profile_kelurahan SET luas_wilayah='$luas_wilayah', jumlah_rw='$jumlah_rw', jumlah_rt='$jumlah_rt', jumlah_penduduk='$jumlah_penduduk', 
    laki_laki='$laki_laki', perempuan='$perempuan', anak_anak='$anak_anak', remaja='$remaja', dewasa='$dewasa', tamat_sd_smp='$tamat_sd_smp', tamat_sma='$tamat_sma', tamat_sarjana='$tamat_sarjana', deskripsi='$deskripsi' WHERE id_profile='$id_profile'";

    // Mengeksekusi query
    $hasil = mysqli_query($connection, $sql);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        header("Location: ../admin/dashboard_kelurahan.php");
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
    <title>Update Profile Kelurahan-Cipsmart</title>
    <link rel="stylesheet" href="../css/update-kelurahan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
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
            <li class="active"><a href="#"><i class="fa fa-home"></i> Update Profile Kelurahan</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-book"></i> Pojok Baca</a></li>
<<<<<<< HEAD
            <li class="disabled"><a href="#"><i class="fa fa-users"></i> Absen Pojok Baca</a></li>
            <li class="disabled"><a href=""><i class="fa fa-book"></i> Update Data Buku</a></li>
=======
            <li class="disabled"><a href="#"><i class="fa fa-users"></i> Pengunjung Pojok Baca</a></li>
            <li class="disabled"><a href=""><i class="fa fa-book"></i> Buku</a></li>
>>>>>>> 90f0e527cd54c0600733a1302764c73be801d388
            <li class="disabled"><a href="#"><i class="fa fa-exchange"></i> Peminjaman Buku</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-book"></i> E-Book</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-shopping-bag"></i> Produk UMKM</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-users"></i> Penjual UMKM</a></li>
            <li class="disabled"><a href="#"><i class="fa fa-sign-out"></i> Keluar</a></li>
        </ul>
    </div>
    <div class="main-content">
        
        <div class="content">
            <h2 class="form-title">Update Profile Kelurahan Cipaku</h2>
            <form class="profile-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_profile=' . $id_profile; ?>" method="post" enctype="multipart/form-data">
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Luas Wilayah:</span>
                            <input type="text" name="luas_wilayah" class="stat-input" value="<?php echo isset($data['luas_wilayah']) ? $data['luas_wilayah'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Jumlah Penduduk:</span>
                            <input type="number" name="jumlah_penduduk" class="stat-input" value="<?php echo isset($data['jumlah_penduduk']) ? $data['jumlah_penduduk'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Jumlah RW:</span>
                            <input type="number" name="jumlah_rw" class="stat-input" value="<?php echo isset($data['jumlah_rw']) ? $data['jumlah_rw'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Jumlah RT:</span>
                            <input type="number" name="jumlah_rt" class="stat-input" value="<?php echo isset($data['jumlah_rt']) ? $data['jumlah_rt'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Laki-laki:</span>
                            <input type="number" name="laki_laki" class="stat-input" value="<?php echo isset($data['laki_laki']) ? $data['laki_laki'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Perempuan:</span>
                            <input type="number" name="perempuan" class="stat-input" value="<?php echo isset($data['perempuan']) ? $data['perempuan'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-title">Anak-anak (0-12 th):</span>
                        <span class="stat-value">
                            <input type="number" name="anak_anak" class="stat-input" value="<?php echo isset($data['perempuan']) ? $data['perempuan'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Remaja (13-19 th):</span>
                            <input type="number" name="remaja" class="stat-input" value="<?php echo isset($data['remaja']) ? $data['remaja'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Dewasa (>20 th):</span>
                            <input type="number" name="dewasa" class="stat-input" value="<?php echo isset($data['dewasa']) ? $data['dewasa'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Tamat SD-SMP:</span>
                            <input type="number" name="tamat_sd_smp" class="stat-input" value="<?php echo isset($data['tamat_sd_smp']) ? $data['tamat_sd_smp'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Tamat SMA:</span>
                            <input type="number" name="tamat_sma" class="stat-input" value="<?php echo isset($data['tamat_sma']) ? $data['tamat_sma'] : ''; ?>" required>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">
                            <span class="stat-title">Tamat Sarjana:</span>
                            <input type="number" name="tamat_sarjana" class="stat-input" value="<?php echo isset($data['tamat_sarjana']) ? $data['tamat_sarjana'] : ''; ?>" required>
                        </span>
                    </div>
                </div>
                <div class="profile-description">
                    <span class="desc-title">Deskripsi:</span>
                    <textarea name="deskripsi" class="des-input" required><?php echo isset($data['deskripsi']) ? $data['deskripsi'] : ''; ?></textarea>
                </div>

                <div class="button-group">
                    <button type="button" onclick="window.location.href='../admin/dashboard_kelurahan.php';" class="btn-back">Kembali</button>
                    <button type="submit" name="submit" class="btn-input">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>
