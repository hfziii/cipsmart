<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Cipsmart</title>
    <link rel="stylesheet" href="./css/homepage.css">
    <link rel="stylesheet" href="./css/popup-user.css">
    <link rel="icon" href="img/favicon/android-chrome-192x192.png" type="image/png">
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
                window.location.href = "logout.php";
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
            loginBtn.href = "./login.php"; // Link to login page if not logged in
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
                        <a href="homepage.php">
                            <p class="home">Beranda</p>
                        </a>
                        <a href="#ppk">
                            <p class="ppk">PPK Ormawa</p>
                        </a>
                        <a href="#cipaku">
                            <p class="cipaku">Kelurahan Cipaku</p>
                        </a>
                        <a href="./user/contact-us.php">
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
                                <a href="./admin/dashboard.php">Dashboard</a>
                                <!-- The logout link will be added dynamically via JavaScript -->
                            </div>
                        <?php endif; ?>
                    </div>
    
                </nav>
            </div>

            <div class="bg-body-item">

                <div class="sidebar">
    
                    <div class="cipsmart">
                        <a href="./user/logo-filosofi.php">
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
                        <a href="./user/catalog-ebook.php">
                            <img src="./img/homepage/btn-ebook.png" alt="">
                        </a>
                        <p class="ebooktext">
                            E-Book
                        </p>
                    </div>
    
                    <div class="umkm">
                        <a href="./user/catalog-umkm.php">
                            <img src="./img/homepage/btn-umkm.png" alt="">
                        </a>
                        <p class="umkmtext">
                            UMKM
                        </p>
                    </div>
    
                </div>
    
                <div class="content" id="content">
                    <div class="corner">
                        <a href="./user/catalog-book.php?corner=Literasi+Imajinatif">
                            <p class="cornerteks-1">Literasi Imajinatif</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-1">
                        </a>

                        <a href="./user/catalog-book.php?corner=Social+Connect">
                            <p class="cornerteks-2">Social Connect</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-2">
                        </a>
                        
                        <a href="./user/catalog-book.php?corner=Bisnis+Berdaya">
                            <p class="cornerteks-3">Bisnis Berdaya</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-3">
                        </a>

                        <a href="./user/catalog-book.php?corner=Kreatif+Kids+Corner">
                            <p class="cornerteks-4">Kreatifitas Kids Corner</p>
                            <img src="./img/homepage/pin2.png" alt="" class="corner-4">
                        </a>
                        
                        <a href="./user/catalog-book.php?corner=Pena+Inspirasi+Gemilang">
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

                <a href="./user/aboutppk.php">
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
                
                <a href="./user/profile_kelurahan.php">
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
            <div class="carousel-container">
                <img src="./img/homepage/btn-next-left.png" alt="Previous" class="back">
                <div class="carousel">
                    <img src="./img/homepage/pic-5.png" alt="" class="small">
                    <img src="./img/homepage/pic-1.png" alt="" class="middle">
                    <img src="./img/homepage/pic-2.png" alt="" class="small">
                    <img src="./img/homepage/pic-3.png" alt="" class="small">
                    <img src="./img/homepage/pic-6.png" alt="" class="small">
                </div>
                <img src="./img/homepage/btn-next-right.png" alt="Next" class="next">
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
                    <a href="./user/catalog-book.php">
                        <p class="title-perpusfot">Perpustakaan Digital</p>
                    </a>
                    <a href="./user/catalog-book.php?corner=Literasi+Imajinatif">
                        <p class="linked-1">
                            Literasi Imajinatif
                        </p>
                    </a>
                    <a href="./user/catalog-book.php?corner=Social+Connect">
                        <p class="linked-1">
                            Social Connect
                        </p>
                    </a>
                    <a href="./user/catalog-book.php?corner=Bisnis+Berdaya">
                        <p class="linked-1">
                            Bisnis Berdaya
                        </p>
                    </a>
                    <a href="./user/catalog-book.php?corner=Kreatif+Kids+Corner">
                        <p class="linked-1">
                            Kreatif Kids Corner
                        </p>
                    </a>
                    <a href="./user/catalog-book.php?corner=Pena+Inspirasi+Gemilang">
                        <p class="linked-1">
                            Pena Inspirasi Gemilang
                        </p>
                    </a>
                </div>

                <div class="ebookfot">
                    <a href="./user/catalog-ebook.php">
                        <p class="title-ebookfot">E-Book</p>
                    </a>
                    <a href="./user/catalog-ebook.php?search=cerpen">
                        <p class="linked-1">
                            Cerita Pendek
                        </p>
                    </a>
                    <a href="./user/catalog-ebook.php?search=novel">
                        <p class="linked-1">
                            Novel
                        </p>
                    </a>
                    <a href="./user/catalog-ebook.php?search=umum">
                        <p class="linked-1">
                            Umum
                        </p>
                    </a>
                </div>

                <div class="umkmfot">
                    <a href="./user/catalog-umkm.php">
                        <p class="title-umkmfot">UMKM Cipaku</p>
                    </a>
                    <a href="./user/catalog-umkm.php?search=makanan">
                        <p class="linked-1">
                            Makanan & Minuman
                        </p>
                    </a>
                    <a href="./user/catalog-umkm.php?search=fashion">
                        <p class="linked-1">
                            Fashion & Aksesoris
                        </p>
                    </a>
                    <a href="./user/catalog-umkm.php?search=kerajinan">
                        <p class="linked-1">
                            Kerajinan Tangan
                        </p>
                    </a>
            
                </div>
                
                <div class="callfot">
                    <a href="./user/contact-us.php">
                        <p class="title-callfot">Hubungi Kami</p>
                    </a>
                    <p class="linked-1">
                        Jalan Raya, RT.01/RW.03, Cipaku, Bogor Selatan, Kota Bogor, Jawa Barat 16137
                    </p>
                    <a href="https://www.instagram.com/cipsmart.ppkormawa2024" target="_blank">                            
                        <img src="./img/footer/ig-icon.png" alt="" class="iconcs">
                    </a>
                    <a href="https://wa.me/6285732185809" target="_blank">
                        <img src="./img/footer/wa-icon.png" alt="" class="iconcs">
                    </a>
                    <a href="mailto:cipsmartppkormawablmfeb@gmail.com" target="_blank">
                        <img src="./img/footer/gmail-icon.png" alt="" class="iconcs">
                    </a>
                </div>

            </div>

            <div class="copyright">
                <p class="copy">© Cipsmart BLM FEB UNPAK. All rights reserved.</p>
            </div>
        
        </div>

    </div>

    <script>
    let currentIndex = 2; // Start with the middle image
    const images = document.querySelectorAll('.carousel img');
    const totalImages = images.length;
    const visibleImages = 5; // The number of images to keep in the carousel view

    function updateCarousel() {
        images.forEach((img, index) => {
            img.classList.remove('middle', 'small');
            if (index === currentIndex) {
                img.classList.add('middle');
            } else {
                img.classList.add('small');
            }
        });

        // Update the transform to shift the images left or right
        const shiftPercentage = (100 / visibleImages) * (2 - currentIndex);
        document.querySelector('.carousel').style.transform = `translateX(${shiftPercentage}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalImages;
        updateCarousel();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalImages) % totalImages;
        updateCarousel();
    }

    document.querySelector('.back').addEventListener('click', prevSlide);
    document.querySelector('.next').addEventListener('click', nextSlide);

    // Automatically move to the next slide every 3 seconds
    setInterval(nextSlide, 3000);

    updateCarousel();
    </script>

</body>
</html>