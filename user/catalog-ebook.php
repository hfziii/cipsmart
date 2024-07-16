<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog E-Book Cipsmart</title>
    <link href="../css/catalog-ebook.css" rel="stylesheet">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
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
            logoutItem.href = "../logout.php";
            logoutItem.onclick = function(event) {
                if (!confirm("Anda Yakin Ingin Logout?")) {
                    event.preventDefault();
                }
            };
            dropdownContent.appendChild(logoutItem);
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
                    <input type="text">
                    <div class="search-icon">
                        <a href="#">
                            <img src="../img/navbar/search-nav-icon.png" alt="Search">
                        </a>
                    </div>
                </div>
                <div class="navigator">
                    <a href="../homepage.php"><p class="home">Beranda</p></a>
                    <div class="login user-dropdown">
                        <?php if (!isset($_SESSION['username'])): ?>
                            <a href="login.php" class="login-btn" id="loginBtn">
                            <p style="color: #fff">Login</p>
                            </a>
                        <?php else: ?>
                            <a href="#" class="login-btn username-btn" id="loginBtn"><?php echo $_SESSION['username']; ?></a>
                            <div class="dropdown-content" id="dropdownContent">
                                <a href="../newdashboard.html">Dashboard</a>
                                <!-- The logout link will be added dynamically via JavaScript -->
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>

        <div class="content">
            <div class="sidebar">
                <div class="front-sidebar">
                    <div class="perpus">
                        <a href="../user/catalog-book.php">
                            <img src="../img/catalog/lib-btn.png" alt="">
                        </a>
                        <p class="perpustext">Perpustakaan</p>
                    </div>
                    <div class="ebook">
                        <a href="../user/catalog-ebook.php">
                            <img src="../img/catalog/ebook-btn.png" alt="">
                        </a>
                        <p class="ebooktext">E-Book</p>
                    </div>
                    <div class="umkm">
                        <a href="../user/catalog-umkm.php">
                            <img src="../img/catalog/umkm-btn.png" alt="">
                        </a>
                        <p class="umkmtext">UMKM</p>
                    </div>
                </div>
                <div class="box-bg"></div>
            </div>

            <div class="catalog">
                <p class="title-catalog">Katalog E-Book</p>
                <div class="frame-container">
                    <?php
                    include("koneksi.php");

                    $query = mysqli_query($connection, "SELECT * FROM ebook");
                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                            $imagePath = '../' . $data["sampul_ebook"];
                            echo '<div class="frame-card">
                                <a href="detail-ebook.php?id_ebook=' . htmlspecialchars($data['id_ebook']) . '">
                                    <div class="cardd">
                                        <img class="img-p" src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($data["judul_ebook"]) . '">
                                    </div>
                                </a>
                                <h1 class="name-ebook" style="font-size: 20px;">' . htmlspecialchars($data["judul_ebook"]) . '</h1>
                                <h1 class="name-author">' . htmlspecialchars($data["penulis_ebook"]) . '</h1>
                                <h1 class="status">' . htmlspecialchars($data["kategori_ebook"]) . '</h1>
                            </div>';
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>
            </div>
        </div>

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
                        <p class="linked-1">Literasi Imajinatif</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Social Connect</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Bisnis Berdaya</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Kreatifitas Kids Corner</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Pena Inspirasi Gemilang</p>
                    </a>
                </div>
                <div class="ebookfot">
                    <a href="#">
                        <p class="title-ebookfot">E-Book</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Teks K-13</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Teks Kurikulum Merdeka</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Non Teks</p>
                    </a>
                </div>
                <div class="umkmfot">
                    <a href="#">
                        <p class="title-umkmfot">UMKM Cipaku</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Katalog Produk</p>
                    </a>
                    <a href="#">
                        <p class="linked-1">Penjual UMKM</p>
                    </a>
                </div>
                <div class="callfot">
                    <a href="#">
                        <p class="title-callfot">Hubungi Kami</p>
                    </a>
                    <p class="linked-1">
                        Jalan Raya, RT.01/RW.03, Cipaku, Bogor Selatan, Kota Bogor, Jawa Barat 16137
                    </p>
                    <img src="../img/footer/ig-icon.png" alt="" class="iconcs">
                    <img src="../img/footer/wa-icon.png" alt="" class="iconcs">
                    <img src="../img/footer/gmail-icon.png" alt="" class="iconcs">
                </div>
            </div>
            <div class="copyright">
                <p class="copy">© Cipsmart BLM FEB UNPAK. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
