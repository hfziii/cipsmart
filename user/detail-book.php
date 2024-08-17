<?php
session_start();
include "koneksi.php";

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

$showSuccessPopup = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrow'])) {
    $id_book = $_POST['id_book'];
    $id_user = $_POST['id_user'];
    $borrower_name = $_POST['borrower_name'];
    $title_book = $_POST['title_book'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];
    $table_name = $_POST['table_name'];

    // Define the borrowing table name based on the book table name
    $borrowing_table = str_replace('book_', 'borrowing_', $table_name);

    // Insert into the corresponding borrowing table
    $sql_insert = "INSERT INTO $borrowing_table (id_book, id_user, name, title_book, borrow_date, return_date) 
            VALUES ('$id_book', '$id_user', '$borrower_name', '$title_book', '$borrow_date', '$return_date')";

    if (mysqli_query($connection, $sql_insert)) {
        // Update book status
        $sql_update = "UPDATE $table_name SET status = 'Dipinjam' WHERE id_book = '$id_book'";

        if (mysqli_query($connection, $sql_update)) {
            // Redirect with success parameter
            header("Location: detail-book.php?id_book=$id_book&table_name=$table_name&success=true");
            exit();
        } else {
            echo "<script>alert('Data update failed: " . mysqli_error($connection) . "');</script>";
        }
    } else {
        echo "<script>alert('Data insertion failed: " . mysqli_error($connection) . "');</script>";
    }
}

function input($data) {
    if (!isset($data)) {
        return "";
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getBookById($id_book, $table_name) {
    global $connection;
    $sql = "SELECT * FROM $table_name WHERE id_book = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id_book);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

$tables = [
    'book_literasi_imajinatif' => 'Literasi Imajinatif',
    'book_social_connect' => 'Social Connect',
    'book_pena_inspirasi_gemilang' => 'Pena Inspirasi Gemilang',
    'book_kreatif_kids_corner' => 'Kreatif Kids Corner',
    'book_bisnis_berdaya' => 'Bisnis Berdaya',
];

$data = [];
$table_name = "";

if (isset($_GET['id_book']) && isset($_GET['table_name'])) {
    $id_book = input($_GET['id_book']);
    $table_name = input($_GET['table_name']);
    
    if (!array_key_exists($table_name, $tables)) {
        echo "Invalid table_name.";
        exit();
    }

    $data = getBookById($id_book, $table_name);
    if (!$data) {
        echo "Data buku tidak ditemukan.";
        exit();
    }
} else {
    echo "ID Book atau Table Name tidak ditemukan!";
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$userNameQuery = "SELECT name, id_user FROM user WHERE username='$username'";
$userNameResult = mysqli_query($connection, $userNameQuery);
$userData = mysqli_fetch_assoc($userNameResult);
$name = isset($userData['name']) ? $userData['name'] : 'Guest';
$id_user = isset($userData['id_user']) ? $userData['id_user'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <link rel="stylesheet" href="../css/detail-book.css">
    <link rel="stylesheet" href="../css/popup-user.css">
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <!-- Google Fonts link for Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
   
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Show success popup if success parameter is in the URL
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            document.querySelector('#successPopupForm').style.display = 'block';
        }

        var okBtn = document.querySelector('#successPopupForm .success-ok-btn');
        if (okBtn) {
            okBtn.addEventListener('click', function () {
                document.getElementById('successPopupForm').style.display = 'none';
            });
        }

        var loginBtn = document.getElementById("loginBtn");
        var dropdownContent = document.getElementById("dropdownContent");

        <?php if (isset($_SESSION['username'])): ?>
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

            var borrowBtn = document.querySelector('.wa');
            if (borrowBtn) {
                borrowBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.querySelector('.popup-form').style.display = 'block';
                });
            }
        <?php else: ?>
            loginBtn.href = "../login.php";
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

        <!-- Pop-up Pinjam Buku -->
        <div class="popup-form" id="popupForm">
            <span class="close-btn">&times;</span>
            <h2>Pinjam Buku</h2>
            <p><?php echo $data['title_book']; ?></p>
            <form action="detail-book.php?id_book=<?php echo $id_book; ?>" method="POST">
                <input type="hidden" name="id_book" value="<?php echo $id_book; ?>">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                <input type="hidden" name="table_name" value="<?php echo $table_name; ?>">
                <label for="borrow_date" class="labelborrow">Nama Peminjam</label>
                <input type="text" class="input_borrow" id="borrower_name" name="borrower_name" placeholder="Nama Peminjam" required>

                <input type="hidden" name="title_book" value="<?php echo $data['title_book']; ?>">

                <label for="borrow_date" class="labelborrow">Tanggal Pinjam</label>
                <input type="date" class="input_borrow" id="borrow_date" name="borrow_date" required>

                <label for="return_date" class="labelborrow">Tanggal Kembali</label>
                <input type="date" class="input_borrow" id="return_date" name="return_date" required>

                <input type="submit" class="submit-btn" name="borrow" value="Pinjam">
            </form>
        </div>
        
        <!-- Success Pop-up form -->
        <div class="success-popup-form" id="successPopupForm" style="display:none;">
            <div class="center-image-container">
                <img src="../img/catalog/ep_success-filled.png" alt="Success Image">
            </div>
            <h2>Peminjaman Buku</h2>
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
                            <option value="Kreatif Kids Corner" <?php if ($table_name == 'book_kreatif_kids_corner') echo 'selected'; ?>>Kreatif Kids Corner</option>
                            <option value="Pena Inspirasi Gemilang" <?php if ($table_name == 'book_pena_inspirasi_gemilang') echo 'selected'; ?>>Pena Inspirasi Gemilang</option>
                        </select>
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
                            <img src="<?php echo '../' . $data['photo']; ?>" alt="<?php echo $data['title_book']; ?>" style="width: 200px; height: 280px; margin: 10px 0px 0px 30px">
                        </div>
                    </div> 

                    <div class="detail-2">
                        <h2 style="color: #fff;"><?php echo $data['author_name']; ?></h2>
                        <h1 style="color: #fff;"><?php echo $data['title_book']; ?></h1>

                        <div class="linked">
                            <a href="#sipnopsis">
                                <p class="sipnopsis">Sinopsis Buku</p>
                            </a>
                            <a href="#detail">
                                <p class="detailbook">Detail Buku</p>
                            </a>

                            <?php if ($data['status'] == 'Tersedia') : ?>
                                <div class="sb">
                                <p class="stasusbook" style="align-text: center; color:#fff;"><?php echo $data['status']; ?></p>
                                </div>
                            <?php else : ?>
                                <div class="sb-none">
                                    <p class="stasusbook" style="align-text: center; center; color: yellow;"><?php echo $data['status']; ?></p>
                                </div>
                            <?php endif; ?>

                            <!-- ------------------------------------------------------ -->
                            <?php if ($data['status'] == 'Tersedia') : ?>
                                <?php if (isset($_SESSION['username']) && isAllowedRole($userRole, $allowedRoles)): ?>
                                    <a href="#" class="wa">
                                        <span class="rentbutton">Pinjam Buku</span>
                                    </a>
                                <?php elseif (!isset($_SESSION['username'])): ?>
                                    <a href="../login.php" class="wa">
                                        <span class="rentbutton">Login untuk Pinjam</span>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>

                        <hr class="white-line">

                        <div class="title-1" id="sipnopsis">
                            <h2 class="t1" style="color: #fff;">Sinopsis Buku</h2>
                        </div>
                        <div class="sipnopsis-desc">
                            <p><?php echo $data['sipnopsis']; ?></p>
                        </div>
                        <div class="title-1" id="detail">
                            <h2 class="t1" style="color: #fff;">Detail Buku</h2>
                        </div>
                        <div class="book-desc">
                            <div class="bd1">
                                <p class="desc-1">Penerbit <br><p><?php echo $data['publisher_name']; ?></p></p>
                                <p class="desc-2">Tahun Terbit <br><p><?php echo $data['year_publish']; ?></p></p>
                            </div>
                            <div class="bd-2">
                                <p class="desc-3">ISBN <br><p><?php echo $data['isbn']; ?></p></p>
                                <p class="desc-4">Total Halaman <br><p><?php echo $data['total_page']; ?></p></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php
        // Mengambil 10 buku secara acak dari tabel $table_name
        $recommendationQuery = "SELECT * FROM $table_name ORDER BY RAND() LIMIT 10";
        $recommendationResult = mysqli_query($connection, $recommendationQuery);
        ?>

        <div class="recomend">
            <div class="box-1">
                <!-- Content for the first box -->
            </div>

            <div class="box-2">
                <h1 class="title-rec">Rekomendasi Buku</h1>

                <a href="#" class="other-btn other-btn-1">
                    <img src="../img/detail/prev-recommend.png" alt="" class="other-btn-1">
                </a>

                <div class="frame-container-wrapper">
                    <div class="frame-container">
                        <?php while ($book = mysqli_fetch_assoc($recommendationResult)): ?>
                            <a href="detail-book.php?id_book=<?php echo $book['id_book']; ?>&table_name=<?php echo $table_name; ?>" class="frame-card-link">
                                <div class="frame-card">
                                    <img src="<?php echo '../' . $book['photo']; ?>" alt="<?php echo $book['title_book']; ?>" class="img-p">
                                    <h1 class="name-book"><?php echo $book['title_book']; ?></h1>
                                    <h1 class="name-author"><?php echo $book['author_name']; ?></h1>
                                    <h1 class="status"><?php echo $book['status']; ?></h1>
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

    <!-- Tambahkan Form untuk Pinjam Buku -->
    <form id="borrowForm" method="POST" action="detail-book.php?id_book=<?php echo $id_book; ?>&table_name=<?php echo $table_name; ?>" style="display:none;">
        <input type="hidden" name="id_book" value="<?php echo $data['id_book']; ?>">
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="title_book" value="<?php echo $data['title_book']; ?>">
        <input type="hidden" name="table_name" value="<?php echo $table_name; ?>">
    </form>

    <script src="../js/carousel.js"></script>

</body>
</html>