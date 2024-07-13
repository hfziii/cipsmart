<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Cipsmart</title>
    <link rel="stylesheet" href="./css/homepage.css">
    <link rel="icon" href="img/favicon/android-chrome-192x192.png" type="image/png">

    <?php
    session_start();
    ?>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        var loginBtn = document.getElementById("loginBtn");
        var dropdownContent = document.getElementById("dropdownContent");

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
            logoutItem.href = "logout.php";
            logoutItem.onclick = function(event) {
                if (!confirm("Anda Yakin Ingin Logout?")) {
                    event.preventDefault();
                }
            };
            dropdownContent.appendChild(logoutItem);
        <?php else: ?>
            loginBtn.href = "./login.php"; // Link ke halaman login.php jika belum login
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
        }
    });
    </script>
</head>
<body>
    <div class="bg-base-body">

        <header class="head-homepage">

            <!-- NAVBAR -->
            <div class="nav">
                <nav class="navbar">
    
                    <div class="navigation">
                        <a href="homepage.php">
                            <p class="home">Beranda</p>
                        </a>
                        <a href="#ppk">
                            <p class="ppk">PPK Ormawa</p>
                        </a>
                        <a href="#cipaku">
                            <p class="cipaku">Kelurahan Cipaku</p>
                        </a>
                        <a href="#">
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
                                <a href="newdashboard.html">Dashboard</a>
                                <!-- The logout link will be added dynamically via JavaScript -->
                            </div>
                        <?php endif; ?>
                    </div>
    
                </nav>
            </div>

            <div class="bg-body-item">

                <div class="sidebar">
    
                    <div class="cipsmart">
                        <a href="#">
                            <img src="./img/homepage/logo-cipsmart-sidebar.png" alt="">
                        </a>
                    </div>
    
                    <div class="perpus">
                        <a href="./user/catalog-book.php">
                            <img src="./img/homepage/btn-perpus.png" alt="">
                        </a>
                        <p class="perpustext">
                            Perpustakaan
                        </p>
                    </div>
    
                    <div class="ebook">
                        <a href="#">
                            <img src="./img/homepage/btn-ebook.png" alt="">
                        </a>
                        <p class="ebooktext">
                            E-Book
                        </p>
                    </div>
    
                    <div class="umkm">
                        <a href="#">
                            <img src="./img/homepage/btn-umkm.png" alt="">
                        </a>
                        <p class="umkmtext">
                            UMKM
                        </p>
                    </div>
    
                </div>
    
                <div class="content" id="content">
                    <div class="corner">
                        <a href="./catalog-book.html">
                            <p class="cornerteks-1">Literasi Imajinatif</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-1">
                        </a>

                        <a href="#">
                            <p class="cornerteks-2">Social Connect</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-2">
                        </a>
                        
                        <a href="#">
                            <p class="cornerteks-3">Bisnis Berdaya</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-3">
                        </a>

                        <a href="#">
                            <p class="cornerteks-4">Kreatifitas Kids Corner</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-4">
                        </a>
                        
                        <a href="#">
                            <p class="cornerteks-5">Pena Inspirasi Gemilang</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-5">
                        </a>
                    </div>
                    <img class="isometric-village" src="./img/homepage/isometric-village-with-mountain-hill.png" alt="Isometric Village">
                </div>

            </div>

        </header>

        <div class="profilecipsmart" id="ppk">
            <div class="desc1">
                <p class="titlecipsmart">
                    PPK ORMAWA <br> CIPSMART
                </p>
                <p class="tekscipsmart">
                    PPK Ormawa atau Program Penguatan Kapasitas Organisasi Kemahasiswaan adalah program penguatan kapasitas 
                    ormawa melalui serangkaian proses pembinaan Ormawa oleh Perguruan Tinggi yang diimplementasikan dalam 
                    program pengabdian dan pemberdayaan masyarakat. 
                    <br><br>
                    Cipaku Smart Village (Cipsmart) yaitu Program PPK Ormawa dari BLM Fakultas Ekonomi dan Bisnis, Universitas Pakuan.  
                    Cipsmart dilaksanakan di Kelurahan Cipaku, Bogor Selatan, Kota Bogor, Jawa Barat. 
                </p>

                <a href="#">
                    <button type="button" class="btn-detail">
                        Selengkapnya
                    </button>
                </a>

            </div>
            <disc class="logopc">
                <img class="logocipsmart" src="./img/homepage/logo-cipsmart-profile.png" alt="">
            </disc>
        </div>

        <div class="profilecipaku" id="cipaku">

            <div class="logocipaku">
                <img class="logocipaku" src="./img/homepage/cipaku-profile.png" alt="">
            </div>
            <div class="desc2">
                <p class="titlecipaku">
                    KELURAHAN <br> CIPAKU 
                </p>
                <p class="tekscipaku">
                    Kelurahan Cipaku merupakan salah satu kelurahan yang terletak di Kecamatan Bogor Selatan, Kota Bogor dengan luas wilayah 
                    Desa Kelurahan Cipaku Kecamatan Bogor ± 174 hektar. Berdasarkan data penduduk, Kelurahan Cipaku memiliki 12.310 penduduk (laki-laki 6.181 jiwa dan
                    perempuan 6.129 jiwa) Kelurahan Cipaku di Kecamatan Bogor Selatan, Kota Bogor.
                </p>
                
                <a href="#">
                    <button type="button" class="btn-detail detail-cipaku">
                        Selengkapnya
                    </button>
                </a>
            </div>

        </div>

        <div class="documentation">
            <div class="titledocmitloc">
                <p class="title-doc">
                    DOKUMENTASI <br> CIPSMART
                </p>
            </div>
            <div class="pic-doc">
                <img src="./img/homepage/doc-1.png" alt="" class="pic-doc-1">
                <img src="./img/homepage/btn-next-left.png" alt="" class="back">
                <img src="./img/homepage/doc-2.png" alt="" class="pic-doc-2">
                <img src="./img/homepage/btn-next-right.png" alt="" class="next">
                <img src="./img/homepage/doc-3.png" alt="" class="pic-doc-3">
            </div>
        </div>

        <div class="mitra">
            <div class="titledocmitloc">
                <p class="title-mit">
                    MITRA <br> CIPSMART
                </p>
            </div>
            <div class="boxmit">
                <img src="./img/homepage/logo-unpak.png" alt="" class="mit1">
                <img src="./img/homepage/logo-feb.png" alt="" class="mit2">
                <img src="./img/homepage/logo-blm.png" alt="" class="mit3">
                <img src="./img/homepage/logo-ppk.png" alt="" class="mit4">
                <img src="./img/homepage/logo-kampusmerdeka.png" alt="" class="mit5">
            </div>
        </div>

        <div class="loc">
            <div class="titledocmitloc">
                <p class="title-mit">
                   LOKASI <br> CIPSMART
                </p>
            </div>
            <div class="maps">
                <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15852.3577824387!2d106.80638953872949!3d-6.63581333760736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69cf52f34c319b%3A0xae1d2f8be813f88c!2sCipaku%2C%20Bogor%20Selatan%2C%20Bogor%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1718070868534!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="footer">
            
            <div class="linked">
                
                <div class="logofot">
                    <img src="./img/footer/logo-cipsmart-sidebar.png" alt="">
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
</body>
</html>