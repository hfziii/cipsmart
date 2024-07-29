<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id_ebook'])) {
    header("Location: catalog-ebook.php");
    exit();
}
$id_ebook = $_GET['id_ebook'];
$sql = "SELECT * FROM ebook WHERE id_ebook='$id_ebook'";
$query = mysqli_query($connection, $sql);
$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "E-Book tidak ditemukan";
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$userNameQuery = "SELECT name, id_user FROM user WHERE username='$username'";
$userNameResult = mysqli_query($connection, $userNameQuery);
$userData = mysqli_fetch_assoc($userNameResult);
$name = isset($userData['name']) ? $userData['name'] : 'Guest';
$id_user = isset($userData['id_user']) ? $userData['id_user'] : 0;
$pdf_url = isset($data['file_ebook']) ? '../' . $data['file_ebook'] : '';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail E-Book</title>
    <link rel="stylesheet" href="../css/detail-ebook.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <?php
    // session_start();
    // include 'koneksi.php';
    if (!isset($_GET['id_ebook'])) {
        header("Location: catalog-ebook.php");
        exit();
    }
    $id_ebook = $_GET['id_ebook'];
    $sql = "SELECT * FROM ebook WHERE id_ebook='$id_ebook'";
    $query = mysqli_query($connection, $sql);
    $data = mysqli_fetch_assoc($query);
    if (!$data) {
        echo "E-Book tidak ditemukan";
        exit;
    }    
    ?>

    <?php
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
    $userNameQuery = "SELECT name FROM user WHERE username='$username'";
    $userNameResult = mysqli_query($connection, $userNameQuery);
    $userData = mysqli_fetch_assoc($userNameResult);
    $name = isset($userData['name']) ? $userData['name'] : 'Guest';
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if ($showSuccessPopup): ?>
                document.querySelector('#successPopupForm').style.display = 'block';
            <?php endif; ?>

            var okBtn = document.querySelector('#successPopupForm .success-ok-btn');
            if (okBtn) {
                okBtn.addEventListener('click', function () {
                    document.getElementById('successPopupForm').style.display = 'none';
                });
            }

            var loginBtn = document.getElementById("loginBtn");
            var dropdownContent = document.getElementById("dropdownContent");
            var borrowForm = document.getElementById("borrowForm");

            <?php if (isset($_SESSION['username'])): ?>
                loginBtn.classList.add("username-btn");
                loginBtn.style.cursor = "pointer";

                // Tambahkan event listener untuk menampilkan dropdown
                loginBtn.addEventListener("click", function (event) {
                    event.preventDefault();
                    dropdownContent.classList.toggle("show");
                });

                // Event listener untuk logout
                var logoutItem = document.createElement('a');
                logoutItem.textContent = "Logout";
                logoutItem.href = "../logout.php";
                logoutItem.onclick = function(event) {
                    if (!confirm("Anda Yakin Ingin Logout?")) {
                        event.preventDefault();
                    }
                };
                dropdownContent.appendChild(logoutItem);

                // Event listener untuk pinjam ebook
                var borrowBtn = document.querySelector('.wa');
                if (borrowBtn) {
                    borrowBtn.addEventListener('click', function(event) {
                        event.preventDefault();
                        document.querySelector('.popup-form').style.display = 'block';
                    });
                }
            <?php else: ?>
                loginBtn.href = "../login.php"; // Link ke halaman login.php jika belum login
            <?php endif; ?>

            window.onclick = function (event) {
                if (!event.target.matches('.login-btn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    for (var i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
                if (event.target.matches('.popup-form .close-btn')) {
                    document.querySelector('.popup-form').style.display = 'none';
                }
            }

            
        });
    </script>

</head>
<body>
    <div class="bg-base-body">

        <header class="bg-navbar">
            <nav class="navbar">
                <div class="logo-nav">
                    <a href="../homepage.php">
                        <img src="../img/navbar/logo-cipsmart-nav.png" alt="" class="logonav">
                    </a>
                </div>
                
                <div class="search-bar">
                    <form action="catalog-ebook.php" method="GET">
                        <input type="text" name="search" placeholder="Cari E-Book" class="input-src">
                        <div class="search-icon">
                            <button type="submit" class="submit-src">
                                <img src="../img/navbar/search-nav-icon.png" alt="Search">
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="navigator">
                    <a href="../homepage.php"><p class="home">Beranda</p></a>
                    <div class="login user-dropdown">
                        <?php if (!isset($_SESSION['username'])): ?>
                            <a href="../login.php" class="login-btn" id="loginBtn">
                            <p style="color: #fff">
                            Login    
                            </p>    
                            </a>
                        <?php else: ?>
                            <a href="#" class="login-btn username-btn" id="loginBtn"><?php echo $_SESSION['username']; ?></a>
                            <div class="dropdown-content" id="dropdownContent">
                                <a href="../admin/dashboard.php">Dashboard</a>
                                <!-- The logout link will be added dynamically via JavaScript -->
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>        

        <div class="main">

            <div class="content">

                <div class="sidebar">
                    <div class="front-sidebar">
                        <div class="perpus">
                            <a href="../user/catalog-book.php">
                                <img src="../img/catalog/lib-btn.png" alt="">
                            </a>
                            <p class="perpustext">
                                Perpustakaan
                            </p>
                        </div>

                        <div class="ebook">
                            <a href="../user/catalog-ebook.php">
                                <img src="../img/catalog/ebook-btn.png" alt="">
                            </a>
                            <p class="ebooktext">
                                E-Book
                            </p>
                        </div>

                        <div class="umkm">
                            <a href="../user/catalog-umkm.php">
                                <img src="../img/catalog/umkm-btn.png" alt="">
                            </a>
                            <p class="umkmtext">
                                UMKM
                            </p>
                        </div>
                    </div>
                    
                    <div class="box-bg"></div>
                </div>

                <div class="detailframe">

                    <div class="detail-1">
                        <div class="photobook">
                            <img src="<?php echo '../' . $data['sampul_ebook']; ?>" alt="<?php echo $data['judul_ebook']; ?>" style="width: 200px; height: 280px; margin: 10px 0px 0px 30px">
                        </div>
                    </div> 

                    <div class="detail-2">
                        <h2 style="color: #fff;"><?php echo $data['penulis_ebook']; ?></h2>
                        <h1 style="color: #fff;"><?php echo $data['judul_ebook']; ?></h1>

                        <div class="linked">
                            <p class="sipnopsis">Sipnopsis E-Book</p>
                            <p class="detailbook">Detail E-Bbook</p>

                            <a href="<?php echo $pdf_url; ?>" class="download-btn" download>
                                <img src="../img/detail/download-pdf.png" alt="Download">
                                <span class="rentbutton">Download</span>
                            </a>
                            <a href="<?php echo $pdf_url; ?>" class="read-btn" target="_blank">
                                <img src="../img/detail/read-pdf.png" alt="Read">
                                <span class="rentbutton">Baca Online</span>
                            </a>
                            
                        </div>

                        <hr class="white-line">

                        <div class="title-1">
                            <h2 class="t1" style="color: #fff;">Sipnopsis E-Book</h2>
                        </div>
                        <div class="sipnopsis-desc">
                            <p><?php echo $data['sipnopsis_ebook']; ?></p>
                        </div>
                        <div class="title-1">
                            <h2 class="t1" style="color: #fff;">Detail E-Book</h2>
                        </div>
                        <div class="book-desc">
                            <div class="bd1">
                                <p class="desc-1">Penerbit <br><p><?php echo $data['penerbit_ebook']; ?></p></p>
                                <p class="desc-2">Tahun Terbit <br><p><?php echo $data['tahun_ebook']; ?></p></p>
                            </div>
                            <div class="bd-2">
                                <p class="desc-3">ISBN <br><p><?php echo $data['isbn_ebook']; ?></p></p>
                                <p class="desc-4">Total Halaman <br><p><?php echo $data['jumlah_halaman_ebook']; ?></p></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php
        // Mengambil 10 ebook secara acak dari tabel book
        $recommendationQuery = "SELECT * FROM ebook ORDER BY RAND() LIMIT 10";
        $recommendationResult = mysqli_query($connection, $recommendationQuery);
        ?>

        <div class="recomend">
            <div class="box-1">
                <!-- Content for the first box -->
            </div>

            <div class="box-2">
                <h1 class="title-rec">Rekomendasi E-Book</h1>

                <a href="#" class="other-btn other-btn-1">
                    <img src="../img/detail/prev-recommend.png" alt="" class="other-btn-1">
                </a>

                <div class="frame-container-wrapper">
                    <div class="frame-container">
                        <?php while ($ebook = mysqli_fetch_assoc($recommendationResult)): ?>
                            <a href="detail-ebook.php?id_ebook=<?php echo $ebook['id_ebook']; ?>" class="frame-card-link">
                                <div class="frame-card">
                                    <img src="<?php echo '../' . $ebook['sampul_ebook']; ?>" alt="<?php echo $ebook['judul_ebook']; ?>" class="img-p">
                                    <h1 class="judul_ebook"><?php echo $ebook['judul_ebook']; ?></h1>
                                    <h1 class="penulis_ebook"><?php echo $ebook['penulis_ebook']; ?></h1>
                                    <h1 class="kategori_ebook"><?php echo $ebook['kategori_ebook']; ?></h1>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>

                <a href="#" class="other-btn other-btn-2">
                    <img src="../img/detail/next-recommend.png" alt="" class="other-btn-2">
                </a>
            </div>
        </div>


        <!--  -->
        <div class="footer">
            
            <div class="linked">
                
                <div class="logofot">
                    <img src="../img/footer/logo-cipsmart-sidebar.png" alt="">
                </div>

                <div class="perpusfot">
                    <a href="#">
                        <p class="title-perpusfot">Perpustakaan Digital</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Literasi Imajinatif
                        </p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Social Connect
                        </p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Bisnis Berdaya
                        </p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Kreatifitas Kids Corner
                        </p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Pena Inspirasi Gemilang
                        </p>
                    </a>
                </div>

                <div class="ebookfot">
                    <a href="#">
                        <p class="title-ebookfot">E-Book</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Teks K-13
                        </p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Teks Kurikulum Merdeka
                        </p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Non Teks
                        </p>
                    </a>
                </div>

                <div class="umkmfot">
                    <a href="#">
                        <p class="title-umkmfot">UMKM Cipaku</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Katalog Produk
                        </p>
                    </a>
                    <a href="#">
                        <p class="linked-1">
                            Penjual UMKM
                        </p>
                    </a>
            
                </div>
                
                <div class="callfot">
                    <a href="#">
                        <p class="title-callfot">Hubungi Kami</p>
                    </a>
                    <p class="linked-1">
                        Jalan Raya, RT.01/RW.03, Cipaku, Bogor Selatan, Kota Bogor, Jawa Barat 16137
                    </p>
                    <img src="./img/footer/ig-icon.png" alt="" class="iconcs">
                    <img src="./img/footer/wa-icon.png" alt="" class="iconcs">
                    <img src="./img/footer/gmail-icon.png" alt="" class="iconcs">
                </div>

            </div>

            <div class="copyright">
                <p class="copy">© Cipsmart BLM FEB UNPAK. All rights reserved.</p>
            </div>
        
        </div>

    </div>

    <script src="../js/carousel.js"></script>

</body>
</html>