<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Kelurahan</title>
    <link rel="stylesheet" href="../css/profile_kelurahan.css">
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

        <header class="head-homepage">

            <!-- NAVBAR -->
            <div class="nav">
                <nav class="navbar">
                    <div class="logo-navbar">
                        <a href="../homepage.php">
                            <img src="../img/contact-us/logo-navbar.png" alt="">
                        </a>
                        <h1>Cipsmart ada dimana?</h1>
                        <p>KELURAHAN CIPAKU, KOTA BOGOR</p>
                    </div>
    
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
            </div>
        </header>


        <div class="content">

            <?php
                include("koneksi.php");

                $query = mysqli_query($connection, "SELECT * FROM profile_kelurahan");
                while ($data = mysqli_fetch_array ($query)) {
            ?>

            <div class="container">

                <div class="container-1">
                    <div class="items">
                        <h1>Luas Wilayah</h1>
                        <p><?php echo $data['luas_wilayah']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Jumlah Penduduk</h1>
                        <p><?php echo $data['jumlah_penduduk']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Anak-anak (0-12 th)</h1>
                        <p><?php echo $data['anak_anak']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Tamat SD-SMP</h1>
                        <p><?php echo $data['tamat_sd_smp']; ?></p>
                    </div>
                </div>

                <div class="container-2">
                    <div class="items">
                        <h1>Jumlah RW</h1>
                        <p><?php echo $data['jumlah_rw']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Laki-laki</h1>
                        <p><?php echo $data['laki_laki']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Remaja (13-19 th)</h1>
                        <p><?php echo $data['remaja']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Tamat SMA</h1>
                        <p><?php echo $data['tamat_sma']; ?></p>
                    </div>
                </div>

                <div class="container-3">
                    <div class="items">
                        <h1>Jumlah RT</h1>
                        <p><?php echo $data['jumlah_rt']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Perempuan</h1>
                        <p><?php echo $data['perempuan']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Dewasa (>20 th)</h1>
                        <p><?php echo $data['dewasa']; ?></p>
                    </div>
                    <div class="items">
                        <h1>Tamat Sarjana</h1>
                        <p><?php echo $data['tamat_sarjana']; ?></p>
                    </div>
                </div>

            </div>

            <div class="maps">
                <img src="../img/profil-kelurahan/maps.png" alt="">
            </div>

            <div class="contact">
                <h1>Hubungi Kelurahan</h1>
                <img src="../img/profil-kelurahan/instagram.png" alt="">
                <img src="../img/profil-kelurahan/whatsapp.png" alt="">
                <img src="../img/profil-kelurahan/email.png" alt="">
            </div>

            <div class="profile-desc">
                <p><?php echo $data['deskripsi']; ?></p>
            </div>

            <?php 
                }
            ?>

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