<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Cipsmart</title>
    <link rel="stylesheet" href="../css/aboutppk.css">
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
                        <a href="./profile_kelurahan.php">
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
                <p class="titleppk">
                    Yuk, Kenalan Dengan
                </p>
                <p class="sub-title">
                    TIM PPK ORMAWA <br> BLM FEB Universitas Pakuan
                </p>
            </div>

            <div class="anggota">
                <div class="box1">
                    <div class="pa-agus">
                        <img src="../img/aboutppk/prof-agus-new.png" alt="" class="detail-gambar">
                        <h1>Assoc. Prof. Dr. Agus Setyo Pranowo, S.E.M.M</h1>
                        <p>Dosen Pendamping</p>
                    </div>
                </div>
                <div class="box2">
                    <div class="salwa">
                        <img src="../img/aboutppk/salwa-new.png" alt="" class="detail-gambar">
                        <h1>Salwa Salsabil</h1>
                        <p>Ketua Pelaksana</p>
                    </div>
                    <div class="angga">
                        <img src="../img/aboutppk/angga-new.png" alt="" class="detail-gambar">  
                        <h1>Angga Budi Pratama</h1>
                        <p>Ketua Ormawa</p>
                    </div>
                    <div class="rifki">
                        <img src="../img/aboutppk/rifki-new.png" alt="" class="detail-gambar">
                        <h1>Rifki Rizqullah</h1>
                        <p>Sekretaris Umum</p>
                    </div>
                    </div>
                <div class="box3">
                    <div class="intan">
                        <img src="../img/aboutppk/intan-new.png" alt="" class="detail-gambar">
                        <h1>Intania Permata P.N.</h1>
                        <p>Bendahara Umum I</p>
                    </div>
                    <div class="nono">
                        <img src="../img/aboutppk/nono-new.png" alt="" class="detail-gambar">
                        <h1>Noviana Solehatunnisa</h1>
                        <p>Bendahara Umum II</p>
                    </div>
                    <div>
                        <img src="../img/aboutppk/alifff-new.png" alt="" class="detail-gambar">
                        <h1>Alifia Putri Salimah</h1>
                        <p>Kepala  Divisi Pendidikan dan Pelatihan</p>
                    </div>
                </div>     
                <div class="box4">
                    <div class="fizi">
                        <img src="../img/aboutppk/fizi-new.png" alt="" class="detail-gambar">
                        <h1>Muhammad Hafizi</h1>
                        <p>Kepala Divisi  Web dan Sosial Digital</p>
                    </div>
                    <div class="septian">
                        <img src="../img/aboutppk/septian-new.png" alt="" class="detail-gambar">
                        <h1>M. Rizki Septian Ramdani</h1>
                        <p>Kepala Divisi Komunitas dan Kemitraan</p>
                    </div>    
                    <div>    
                        <img src="../img/aboutppk/ojetz-new.png" alt="" class="detail-gambar">
                        <h1>Hauzan Muqsith</h1>
                        <p>Anggota Divisi Komunitas dan Kemitraan</p>
                    </div>
                </div>               
                <div class="box5">
                    <div>
                        <img src="../img/aboutppk/daffa-new.png" alt="" class="detail-gambar">
                        <h1>M Daffa Zakyanto</h1>
                        <p>Anggota Divisi Pendidikan dan Pelatihan</p>
                    </div>
                    <div>
                        <img src="../img/aboutppk/haifan-new.png" alt="" class="detail-gambar">
                        <h1>Haifan Sakhi</h1>
                        <p>Anggota Divisi Pendidikan dan Pelatihan</p>
                    </div>
                    <div>
                        <img src="../img/aboutppk/milzam-new.png" alt="" class="detail-gambar">
                        <h1>M. Rifqi Milzam Januar</h1>
                        <p>Anggota Divisi Web dan Sosial Digital</p>
                    </div>
                </div>
                <div class="box6">
                    <div>
                        <img src="../img/aboutppk/syauqi-new.png" alt="" class="detail-gambar">
                        <h1>Syauqi Abyan Hafiz</h1>
                        <p>Anggota Divisi Web dan Sosial Digital</p>
                    </div>
                    <div>
                        <img src="../img/aboutppk/fatur-new.png" alt="" class="detail-gambar">
                        <h1>Syaifa Turrohman</h1>
                        <p>Anggota Divisi Web dan Sosial Digital</p>
                    </div>
                    <div>
                        <img src="../img/aboutppk/bambang-new.png" alt="" class="detail-gambar">
                        <h1>Bambang Sugiharto</h1>
                        <p>Anggota Divisi Web dan Sosial Digital</p>
                    </div>
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