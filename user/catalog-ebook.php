<?php
session_start();
include("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog E-Book Cipsmart</title>
    <link href="../css/catalog-ebook.css" rel="stylesheet">
    <link href="../css/popup-user.css" rel="stylesheet">
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

                <div class="select-container">
                    <form action="catalog-ebook.php" method="get">
                        <select name="category" class="category-ebook" onchange="this.form.submit()" required>
                            <option value="">Semua E-Book</option>
                            <?php
                            // Fetch distinct categories from the database
                            $categoryQuery = mysqli_query($connection, "SELECT DISTINCT kategori_ebook FROM ebook ORDER BY kategori_ebook ASC");
                            $selectedCategory = isset($_GET['category']) ? mysqli_real_escape_string($connection, $_GET['category']) : '';

                            if ($categoryQuery) {
                                while ($row = mysqli_fetch_assoc($categoryQuery)) {
                                    $category = htmlspecialchars($row['kategori_ebook']);
                                    $selected = ($category == $selectedCategory) ? 'selected' : '';
                                    echo "<option value=\"$category\" $selected>" . ucfirst($category) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </form>
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
                            <a href="login.php" class="login-btn" id="loginBtn">
                            <p style="color: #fff">Login</p>
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
                        $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';
                        $category = isset($_GET['category']) ? mysqli_real_escape_string($connection, $_GET['category']) : '';

                        $queryStr = "SELECT * FROM ebook";
                        $conditions = [];

                        if ($search) {
                            $conditions[] = "(judul_ebook LIKE '%$search%' OR penulis_ebook LIKE '%$search%' OR kategori_ebook LIKE '%$search%')";
                        }

                        if ($category) {
                            $conditions[] = "kategori_ebook = '$category'";
                        }

                        if (!empty($conditions)) {
                            $queryStr .= " WHERE " . implode(" AND ", $conditions);
                        }

                        $query = mysqli_query($connection, $queryStr);

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
                            echo 
                            '<div style="text-align: center;">
                                    <img src="../img/catalog/notfound.png" alt="Not Found" style="max-width: 500px; display: block; margin: 20px 0px 0px 300px;">
                            </div>';
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
</html>
