<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filosofi Logo</title>
    <link rel="stylesheet" href="../css/logo-filosofi.css">
    <link rel="stylesheet" href="../css/popup-user.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <!-- Google Fonts link for Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">

    <?php
    session_start();
    ?>
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

        <header class="head-homepage">

            <!-- NAVBAR -->
            <div class="nav">
                <nav class="navbar">

                    <div class="navigation">
                        <a href="../homepage.php">
                            <p class="home">Beranda</p>
                        </a>
                        <a href="./aboutppk.php">
                            <p class="ppk">PPK Ormawa</p>
                        </a>
                        <a href="#">
                            <p class="cipaku">Kelurahan Cipaku</p>
                        </a>
                        <a href="./contact-us.php">
                            <p class="contact">Hubungi Kami</p>
                        </a>
                    </div>
                    
                    <div class="login user-dropdown">
                        <?php if (!isset($_SESSION['username'])): ?>
                            <a href="login.php" class="login-btn" id="loginBtn">
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

                </nav>
            </div>
        </header>
        

        <div class="bg-body-item">

            <div class="sidebar">    
                <div class="cipsmart">
                    <a href="./logo-filosofi.php">
                        <img src="../img/homepage/logo-cipsmart-sidebar.png" alt="">
                    </a>
                    <p class="logotext">
                        Filosofi Logo
                    </p>
                </div>

                <div class="ormawa">
                    <a href="./aboutppk.php">
                        <img src="../img/aboutppk/tim-ppk.png" alt="">
                    </a>
                    <p class="ormawateks">
                        Tim PPK Ormawa
                    </p>
                </div>
            </div>

            <div class="title">
                <p class="tittlefilosofi">
                    Logo Cipsmart Filosofinya apa ya?
                </p>
                <p class="sub-title">
                    FILOSOFI LOGO <br> CIPAKU SMART VILLAGE
                </p>
            </div>

            <div class="content">
                <div class="cont-box1">
                    <img src="../img/filosofilogo/lingkaran.png" alt="" class="detail-gambar">
                    <p>Lingkaran adalah simbol dari kesatuan serta kolaborasi antara Mahasiswa, Organisasi, dan Masyarakat</p>
                </div>
                <div class="cont-box2">
                    <img src="../img/filosofilogo/tulisan-blm-feb.png" alt="" class="detail-gambar">
                    <p>Tulisan BLM FEB Universitas Pakuan sebagai lembaga penyelenggara CipSmart</p>                    </div>
                </div>
                <div class="cont-box3">
                    <img src="../img/filosofilogo/lampu.png" alt="" class="detail-gambar">
                    <p>Simbol Lampu pijar mewakili konsep "smart“ mencerminkan inovasi dan kreativitas</p>
                </div>
                <div class="cont-box4">
                    <img src="../img/filosofilogo/5-garis.png" alt="" class="detail-gambar">
                    <p>5 garis melambangkan solusi yang ditawarkan yaitu Pembangunan 5 Pojok Literasi</p>
                </div>
                <div class="cont-box5">
                    <img src="../img/filosofilogo/tulisan-ppk-2024.png" alt="" class="detail-gambar">
                    <p>Tulisan PPK Ormawa 2024 sebagai program Ormawa melalui serangkaian proses implementasi dalam program pengabdian dan pemberdayaan masyarakat</p>
                </div>
                <div class="cont-box6">
                    <img src="../img/filosofilogo/simbol-wifi.png" alt="" class="detail-gambar">
                    <p>Simbol Wifi sebagai fasilitas internet untuk Pojok Baca dan 3 garis lengkung mewakili 3 fitur pada Website Cipsmart (Perpustakaan, E-Cerpen, UMKM)</p>
                </div>
                <div class="cont-box7">
                    <img src="../img/filosofilogo/lengkungan.png" alt="" class="detail-gambar">
                    <p>Garis lengkung yang membentuk huruf U mewakili UMKM sebagai potensi dari masyarakat Kelurahan Cipaku</p>
                </div>
                <div class="cont-box8">
                    <img src="../img/filosofilogo/3-garis-horizontal.png" alt="" class="detail-gambar">
                    <p>3 garis horizontal mewakili 3 tujuan dari CipSmart dalam peningkatan kualitas hidup dan kesejahteraan masyarakat di Kelurahan Cipaku</p>
                </div>
                <div class="cont-box9">
                    <img src="../img/filosofilogo/simbol-buku.png" alt="" class="detail-gambar">
                    <p>Simbol buku mewakili Perpustakaan sebagai salah satu fokus dari program CipSmart</p>
                </div>
                <div class="cont-box10">
                    <img src="../img/filosofilogo/tulisan-cipsmart.png" alt="" class="detail-gambar">
                    <p>Tulisan CIPSMART dan Cipaku Smart Village adalah nama dari program ini</p>
                </div>
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
</body>        