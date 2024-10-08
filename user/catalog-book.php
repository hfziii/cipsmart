<?php
session_start();
include("koneksi.php");

// Mendapatkan peran pengguna dari sesi
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Daftar peran yang diizinkan untuk mengakses tombol absen
$allowedRoles = [
    'Super Admin',
    'Admin Literasi',
    'Admin Social',
    'Admin Bisnis',
    'Admin Kreatif',
    'Admin Pena'
];

// Fungsi untuk memeriksa apakah peran termasuk dalam daftar yang diizinkan
function isAllowedRole($role, $allowedRoles) {
    return in_array($role, $allowedRoles);
}

// Function to get books from table
function getBooksFromTable($table, $search = '') {
    global $connection;
    if ($search) {
        $sql = "SELECT * FROM $table WHERE title_book LIKE '%$search%' OR author_name LIKE '%$search%' OR category LIKE '%$search%' OR status LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM $table";
    }
    $result = mysqli_query($connection, $sql);
    $books = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
    return $books;
}

$tables = [
    'Literasi Imajinatif' => 'book_literasi_imajinatif',
    'Social Connect' => 'book_social_connect',
    'Bisnis Berdaya' => 'book_bisnis_berdaya',
    'Kreatif Kids Corner' => 'book_kreatif_kids_corner',
    'Pena Inspirasi Gemilang' => 'book_pena_inspirasi_gemilang',
];

$search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';
$corner = isset($_GET['corner']) ? $_GET['corner'] : 'Literasi Imajinatif';
$table_name = $tables[$corner];
$books = getBooksFromTable($table_name, $search);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrow'])) {
    $name_member = mysqli_real_escape_string($connection, $_POST['name_member']);
    $name_corner = mysqli_real_escape_string($connection, $_POST['name_corner']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);

    $query = "INSERT INTO absen (name_member, name_corner, date) VALUES ('$name_member', '$name_corner', '$date')";

    if (mysqli_query($connection, $query)) {
        header("Location: catalog-book.php?success=1");
        exit();
    } else {
        echo "<script>alert('Data insertion failed: " . mysqli_error($connection) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku-Cipsmart</title>
    <link href="../css/catalog-book.css" rel="stylesheet">
    <link href="../css/popup-user.css" rel="stylesheet">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <!-- Google Fonts link for Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            document.querySelector('#successPopupForm').style.display = 'block';

            const newURL = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, newURL);
        }

        var dropdownToggle = document.getElementById("dropdownToggle");
        var dropdownMenu = document.getElementById("dropdownMenu");
        var chevronIcon = document.getElementById("chevronIcon");

        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener("click", function() {
                dropdownMenu.classList.toggle("show");
            });

            if (chevronIcon) {
                chevronIcon.addEventListener("click", function() {
                    dropdownMenu.classList.toggle("show");
                });
            }

            document.querySelectorAll('.dropdown-item').forEach(function(item) {
                item.addEventListener("click", function() {
                    dropdownToggle.textContent = this.textContent;
                    dropdownMenu.classList.remove("show");
                });
            });
        }

        var loginBtn = document.getElementById("loginBtn");
        var dropdownContent = document.getElementById("dropdownContent");

        <?php if (isset($_SESSION['username'])): ?>
            if (loginBtn) {
                loginBtn.classList.add("username-btn");
                loginBtn.style.cursor = "pointer";

                loginBtn.addEventListener("click", function (event) {
                    event.preventDefault();
                    dropdownContent.classList.toggle("show");
                });

                var logoutItem = document.createElement('a');
                logoutItem.textContent = "Logout";
                logoutItem.href = "#";
                logoutItem.classList.add("cd-popup-trigger");
                dropdownContent.appendChild(logoutItem);

                // Open logout popup
                logoutItem.addEventListener("click", function(event) {
                    event.preventDefault();
                    document.getElementById('logoutPopup').classList.add('is-visible');
                });

                // Confirm logout
                document.getElementById("confirmLogoutBtn").addEventListener("click", function(event) {
                    event.preventDefault();
                    window.location.href = "../logout.php";
                });

                // Cancel logout
                document.getElementById("cancelLogoutBtn").addEventListener("click", function(event) {
                    event.preventDefault();
                    document.getElementById('logoutPopup').classList.remove('is-visible');
                });

                // Close popup on outside click
                document.getElementById('logoutPopup').addEventListener("click", function(event) {
                    if (event.target === this) {
                        this.classList.remove('is-visible');
                    }
                });

                var borrowBtn = document.querySelector('.absen-pb');
                if (borrowBtn) {
                    borrowBtn.addEventListener('click', function(event) {
                        event.preventDefault();
                        document.querySelector('.popup-form').style.display = 'block';
                    });
                }
            }
        <?php else: ?>
            if (loginBtn) {
                loginBtn.href = "../login.php";
            }
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

        var closeBtns = document.querySelectorAll('.popup-form .close-btn');
        closeBtns.forEach(function (closeBtn) {
            closeBtn.addEventListener('click', function () {
                closeBtn.parentElement.style.display = 'none';
            });
        });

        var okBtn = document.querySelector('#successPopupForm .success-ok-btn');
        if (okBtn) {
            okBtn.addEventListener('click', function () {
                document.getElementById('successPopupForm').style.display = 'none';
            });
        }
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

        <!-- Pop-up Absen -->
        <div class="popup-form" id="popupForm">
            <span class="close-btn">&times;</span>
            <h2>Absen</h2>
            <p>Pojok Baca</p>
            <form action="catalog-book.php" method="POST">
                <label for="name_member" class="labelborrow">Nama</label>
                <input type="text" class="input_absen" id="name_member" name="name_member" placeholder="Nama" required>

                <label for="name_corner" class="labelborrow">Pojok Baca</label>
                <select name="name_corner" class="input_absen" required>
                    <option value="Literasi Imajinatif">Literasi Imajinatif</option>
                    <option value="Social Connect">Social Connect</option>
                    <option value="Bisnis Berdaya">Bisnis Berdaya</option>
                    <option value="Kreatifitas Kids Corner">Kreatifitas Kids Corner</option>
                    <option value="Pena Inspirasi Gemilang">Pena Inspirasi Gemilang</option>
                </select>

                <label for="date" class="labelborrow">Tanggal</label>
                <input type="date" class="input_absen" id="date" name="date" required>

                <input type="submit" class="submit-btn" name="borrow" value="Absen">
            </form>
        </div>

        <!-- Success Pop-up form -->
        <div class="success-popup-form" id="successPopupForm" style="display:none;">
            <div class="center-image-container">
                <img src="../img/catalog/ep_success-filled.png" alt="Success Image">
            </div>
            <h2>Absen Kamu</h2>
            <h2>Berhasil!</h2>
            <button class="ok-btn success-ok-btn">Oke</button>
        </div>

        <header class="bg-navbar">
            <nav class="navbar">
                <div class="logo-nav">
                    <a href="../homepage.php">
                        <img src="../img/navbar/logo-cipsmart-nav.png" alt="" class="logonav">
                    </a>
                </div>

                <div class="select-container">
                    <form action="catalog-book.php" method="get">
                        <select name="corner" class="corner-lib" onchange="this.form.submit()" required>
                            <option value="Literasi Imajinatif" <?php if ($table_name == 'book_literasi_imajinatif') echo 'selected'; ?>>Literasi Imajinatif</option>
                            <option value="Social Connect" <?php if ($table_name == 'book_social_connect') echo 'selected'; ?>>Social Connect</option>
                            <option value="Bisnis Berdaya" <?php if ($table_name == 'book_bisnis_berdaya') echo 'selected'; ?>>Bisnis Berdaya</option>
                            <option value="Kreatif Kids Corner" <?php if ($table_name == 'book_kreatif_kids_corner') echo 'selected'; ?>>Kreatifitas Kids Corner</option>
                            <option value="Pena Inspirasi Gemilang" <?php if ($table_name == 'book_pena_inspirasi_gemilang') echo 'selected'; ?>>Pena Inspirasi Gemilang</option>
                        </select>
                    </form>
                </div>

                <div class="search-bar">
                    <form action="catalog-book.php" method="get" class="form-search">
                        <input type="hidden" name="corner" value="<?php echo htmlspecialchars($corner); ?>">
                        <input type="text" name="search" placeholder="Cari Buku">
                        <button type="submit" class="submit-src">
                            <img src="../img/navbar/search-nav-icon.png" alt="Search">
                        </button>
                    </form>
                </div>

                <div class="navigator">
                    <a href="../homepage.php"><p class="home">Beranda</p></a>
                    <div class="login user-dropdown">
                        <?php if (!isset($_SESSION['username'])): ?>
                            <a href="../login.php" class="login-btn" id="loginBtn">
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

                    <a href="#" class="<?php echo isAllowedRole($userRole, $allowedRoles) ? 'absen-btn absen-pb' : 'absen-btn-disable'; ?> ">
                        <p>Absen</p>
                    </a>

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

            <div class="catalog">

                <p class="title-catalog">
                    Katalog Buku
                </p>

                <div class="frame-container">
                    <?php if ($books): ?>
                        <?php foreach ($books as $data): ?>
                            <div class="frame-card">
                                <a href="detail-book.php?id_book=<?php echo htmlspecialchars($data['id_book']); ?>&table_name=<?php echo htmlspecialchars($table_name); ?>">
                                    <div class="cardd">
                                        <img class="img-p" src="<?= '../' . $data["photo"] ?>" alt="<?= $data["title_book"] ?>">
                                    </div>
                                </a>
                                <h1 class="name-book" style="font-size: 22px;"><?= $data["title_book"] ?></h1>
                                <h1 class="name-author"><?= $data["author_name"] ?></h1>
                                <h1 class="status"><?= $data["status"] ?></h1>
                                <h1 class="status"><?= $data["category"] ?></h1>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                       <img src="../img/catalog/notfound.png" alt="Not Found" style="max-width: 500px; display: block; margin: 20px 0px 0px 300px;">
                    <?php endif; ?>
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
