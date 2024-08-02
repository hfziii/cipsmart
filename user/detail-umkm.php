<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id_product'])) {
    header("Location: catalog-ebook.php");
    exit();
}
$id_product = $_GET['id_product'];
$sql = "
    SELECT p.*, s.seller_name, s.no_whatsapp
    FROM product_umkm p
    JOIN seller_umkm s ON p.id_seller = s.id_seller
    WHERE p.id_product='$id_product'
";
$query = mysqli_query($connection, $sql);
$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "Produk tidak ditemukan";
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$userNameQuery = "SELECT name, id_user FROM user WHERE username='$username'";
$userNameResult = mysqli_query($connection, $userNameQuery);
$userData = mysqli_fetch_assoc($userNameResult);
$name = isset($userData['name']) ? $userData['name'] : 'Guest';
$id_user = isset($userData['id_user']) ? $userData['id_user'] : 0;
$pdf_url = isset($data['file_ebook']) ? '../' . $data['file_ebook'] : '';  

// Query to fetch product and seller data
$query = "
    SELECT p.*, s.seller_name, s.no_whatsapp
    FROM product_umkm p
    JOIN seller_umkm s ON p.id_seller = s.id_seller
";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../css/detail-umkm.css">
    <link rel="stylesheet" href="../css/popup-user.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <!-- Google Fonts link for Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var loginBtn = document.getElementById("loginBtn");
        var dropdownContent = document.getElementById("dropdownContent");
        var logoutPopup = document.getElementById("logoutPopup");
        var confirmLogoutBtn = document.getElementById("confirmLogoutBtn");
        var cancelLogoutBtn = document.getElementById("cancelLogoutBtn");

        <?php if (isset($_SESSION['username'])): ?>
            loginBtn.classList.add("username-btn");
            loginBtn.style.cursor = "pointer";

            // Toggle dropdown menu
            loginBtn.addEventListener("click", function (event) {
                event.preventDefault();
                dropdownContent.classList.toggle("show");
            });

            // Create logout item
            var logoutItem = document.createElement('a');
            logoutItem.textContent = "Logout";
            logoutItem.href = "#";
            logoutItem.classList.add("cd-popup-trigger");
            dropdownContent.appendChild(logoutItem);

            // Open logout popup
            logoutItem.addEventListener("click", function(event) {
                event.preventDefault();
                logoutPopup.classList.add('is-visible');
            });

            // Confirm logout
            confirmLogoutBtn.addEventListener("click", function(event) {
                event.preventDefault();
                window.location.href = "../logout.php";
            });

            // Cancel logout
            cancelLogoutBtn.addEventListener("click", function(event) {
                event.preventDefault();
                logoutPopup.classList.remove('is-visible');
            });

            // Close popup on outside click
            logoutPopup.addEventListener("click", function(event) {
                if (event.target === logoutPopup) {
                    logoutPopup.classList.remove('is-visible');
                }
            });

        <?php else: ?>
            loginBtn.href = "../login.php"; // Link to login page if not logged in
        <?php endif; ?>

        // Close dropdown if clicking outside
        window.onclick = function (event) {
            if (!event.target.matches('.username-btn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        };
    });
    </script>

</head>
<body>
    <div class="bg-base-body">

        <!-- Logout Confirmation Popup -->
        <div class="cd-popup" role="alert" id="logoutPopup">
            <div class="cd-popup-container">
                <p>Anda yakin ingin Keluar?</p>
                <ul class="cd-buttons">
                    <li><a href="#" class="cd-popup-yes" id="confirmLogoutBtn">Ya</a></li>
                    <li><a href="#" class="cd-popup-close" id="cancelLogoutBtn">Tidak</a></li>
                </ul>
            </div>
        </div>

        <header class="bg-navbar">
            <nav class="navbar">
                <div class="logo-nav">
                    <a href="../homepage.php">
                        <img src="../img/navbar/logo-cipsmart-nav.png" alt="" class="logonav">
                    </a>
                </div>
                
                <div class="search-bar">
                    <form action="catalog-umkm.php" method="GET">
                        <input type="text" name="search" placeholder="Cari Produk" class="input-src">
                        <div class="search-icon">
                            <button type="submit" class="submit-src">
                                <img src="../img/navbar/search-nav-icon.png" alt="Search">
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="navigator">
                    <a href="../homepage.php"><p class="home" style="margin-left:10px;">Beranda</p></a>
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
                            <img src="<?php echo '../' . $data['product_photo_1']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 300px; height: 280px; margin: 30px 30px 30px 30px;">
                        </div>
                    </div> 

                    <div class="detail-2">

                        <h2 style="color: #fff;"><?php echo $data['product_name']; ?></h2>
                        <h1 style="color: #fff;"><?php echo 'Rp' . number_format($data["product_price"], 0, ',', '.'); ?></h1>

                        <div class="linked">
                            <p class="sipnopsis">Deskripsi Produk</p>
                            <p class="detailbook">Foto Produk</p>

                            <a href="https://api.whatsapp.com/send?phone=<?php echo urlencode($data['no_whatsapp']); ?>" class="download-btn" target="_blank">
                                <img src="../img/footer/wa-icon.png" alt="WhatsApp">
                                <span class="rentbutton">Hubungi Penjual</span>
                            </a>
                        </div>

                        <hr class="white-line">

                        <div class="title-1">
                            <h2 class="t1" style="color: #fff;">Deskripsi Produk</h2>
                        </div>
                        <div class="sipnopsis-desc">
                            <p><?php echo $data['product_description']; ?></p>
                        </div>
                        <div class="title-1">
                            <h2 class="t1" style="color: #fff;">Foto Produk</h2>
                        </div>
 
                        <div class="photobook">
                            <img src="<?php echo '../' . $data['product_photo_1']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 170px; height: 130px; margin: 30px 5px 30px 0px;">
                            <img src="<?php echo '../' . $data['product_photo_2']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 170px; height: 130px; margin: 30px 5px 30px 0px;">
                            <img src="<?php echo '../' . $data['product_photo_3']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 170px; height: 130px; margin: 30px 5px 30px 0px;">
                            <img src="<?php echo '../' . $data['product_photo_4']; ?>" alt="<?php echo $data['product_name']; ?>" style="width: 170px; height: 130px; margin: 30px 5px 30px 0px;">
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>

        <?php
        // Mengambil 10 ebook secara acak dari tabel book
        $recommendationQuery = "SELECT * FROM product_umkm ORDER BY RAND() LIMIT 10";
        $recommendationResult = mysqli_query($connection, $recommendationQuery);
        ?>

        <div class="recomend">
            <div class="box-1">
                <!-- Content for the first box -->
            </div>

            <div class="box-2">
                <h1 class="title-rec">Rekomendasi Produk</h1>

                <a href="#" class="other-btn other-btn-1">
                    <img src="../img/detail/prev-recommend.png" alt="" class="other-btn-1">
                </a>

                <div class="frame-container-wrapper">
                    <div class="frame-container">
                        <?php while ($ebook = mysqli_fetch_assoc($recommendationResult)): ?>
                            <a href="detail-umkm.php?id_product=<?php echo $ebook['id_product']; ?>" class="frame-card-link">
                                <div class="frame-card">
                                    <img src="<?php echo '../' . $ebook['product_photo_1']; ?>" alt="<?php echo $ebook['product_name']; ?>" class="img-p">
                                    <h1 class="judul_ebook"><?php echo $ebook['product_name']; ?></h1>
                                    <h1 class="penulis_ebook"><?php echo 'Rp' . number_format($data["product_price"], 0, ',', '.'); ?></h1>
                                    <h1 class="kategori_ebook"><?php echo $ebook['product_category']; ?></h1>
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

        <div class="footer">
            
            <div class="linked">
                
                <div class="logofot">
                    <img src="../img/footer/logo-cipsmart-sidebar.png" alt="">
                </div>

                <div class="perpusfot">
                    <a href="./catalog-book.php">
                        <p class="title-perpusfot">Perpustakaan Digital</p>
                    </a>
                    <a href="./catalog-book.php?corner=Literasi+Imajinatif">
                        <p class="linked-1">
                            Literasi Imajinatif
                        </p>
                    </a>
                    <a href="./catalog-book.php?corner=Social+Connect">
                        <p class="linked-1">
                            Social Connect
                        </p>
                    </a>
                    <a href="./catalog-book.php?corner=Bisnis+Berdaya">
                        <p class="linked-1">
                            Bisnis Berdaya
                        </p>
                    </a>
                    <a href="./catalog-book.php?corner=Kreatif+Kids+Corner">
                        <p class="linked-1">
                            Kreatif Kids Corner
                        </p>
                    </a>
                    <a href="./catalog-book.php?corner=Pena+Inspirasi+Gemilang">
                        <p class="linked-1">
                            Pena Inspirasi Gemilang
                        </p>
                    </a>
                </div>

                <div class="ebookfot">
                    <a href="./catalog-ebook.php">
                        <p class="title-ebookfot">E-Book</p>
                    </a>
                    <a href="./catalog-ebook.php?search=cerpen">
                        <p class="linked-1">
                            Cerita Pendek
                        </p>
                    </a>
                    <a href="./catalog-ebook.php?search=novel">
                        <p class="linked-1">
                            Novel
                        </p>
                    </a>
                    <a href="./catalog-ebook.php?search=umum">
                        <p class="linked-1">
                            Umum
                        </p>
                    </a>
                </div>

                <div class="umkmfot">
                    <a href="./catalog-umkm.php">
                        <p class="title-umkmfot">UMKM Cipaku</p>
                    </a>
                    <a href="./catalog-umkm.php?search=makanan">
                        <p class="linked-1">
                            Makanan & Minuman
                        </p>
                    </a>
                    <a href="./catalog-umkm.php?search=fashion">
                        <p class="linked-1">
                            Fashion & Aksesoris
                        </p>
                    </a>
                    <a href="./catalog-umkm.php?search=kerajinan">
                        <p class="linked-1">
                            Kerajinan Tangan
                        </p>
                    </a>
            
                </div>
                
                <div class="callfot">
                    <a href="./contact-us.php">
                        <p class="title-callfot">Hubungi Kami</p>
                    </a>
                    <p class="linked-1">
                        Jalan Raya, RT.01/RW.03, Cipaku, Bogor Selatan, Kota Bogor, Jawa Barat 16137
                    </p>
                    <a href="https://www.instagram.com/cipsmart.ppkormawa2024" target="_blank">                            
                        <img src="../img/footer/ig-icon.png" alt="" class="iconcs">
                    </a>
                    <a href="https://wa.me/6285732185809" target="_blank">
                        <img src="../img/footer/wa-icon.png" alt="" class="iconcs">
                    </a>
                    <a href="mailto:cipsmartppkormawablmfeb@gmail.com" target="_blank">
                        <img src="../img/footer/gmail-icon.png" alt="" class="iconcs">
                    </a>
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
