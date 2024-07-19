<?php
session_start();
include 'koneksi.php';

$showSuccessPopup = false; // Tambahkan variabel untuk menampilkan popup sukses

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrow'])) {
    $id_book = $_POST['id_book'];
    $id_user = $_POST['id_user'];
    $borrower_name = $_POST['borrower_name'];
    $title_book = $_POST['title_book'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];

    $sql_insert = "INSERT INTO book_borrowing (id_book, id_user, name, title_book, borrow_date, return_date) 
            VALUES ('$id_book', '$id_user', '$borrower_name', '$title_book', '$borrow_date', '$return_date')";

    if (mysqli_query($connection, $sql_insert)) {
        $sql_update = "UPDATE book SET status = 'Dipinjam' WHERE id_book = '$id_book'";

        if (mysqli_query($connection, $sql_update)) {
            $showSuccessPopup = true; // Set variabel untuk menampilkan popup sukses
        } else {
            echo "<script>alert('Data insertion failed: " . mysqli_error($connection) . "');</script>";
        }
    } 
}

if (!isset($_GET['id_book'])) {
    header("Location: catalog-book.php");
    exit();
}
$id_book = $_GET['id_book'];
$sql = "SELECT * FROM book WHERE id_book='$id_book'";
$query = mysqli_query($connection, $sql);
$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "Buku tidak ditemukan";
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
    <link rel="icon" href="../img/favicon/android-chrome-192x192.png" type="image/png">
    <?php
    // session_start();
    // include 'koneksi.php';
    if (!isset($_GET['id_book'])) {
        header("Location: catalog-book.php");
        exit();
    }
    $id_book = $_GET['id_book'];
    $sql = "SELECT * FROM book WHERE id_book='$id_book'";
    $query = mysqli_query($connection, $sql);
    $data = mysqli_fetch_assoc($query);
    if (!$data) {
        echo "Buku tidak ditemukan";
        exit;
    }    
    ?>

    <?php
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
    $userNameQuery = "SELECT name FROM user WHERE username='$username'";
    $userNameResult = mysqli_query($connection, $userNameQuery);
    $userData = mysqli_fetch_assoc($userNameResult);
    $name = isset($userData['name']) ? $userData['name'] : 'Guest';
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if ($showSuccessPopup): ?>
                document.querySelector('#successPopupForm').style.display = 'block';
            <?php endif; ?>

            var okBtn = document.querySelector('#successPopupForm .success-ok-btn');
            if (okBtn) {
                okBtn.addEventListener('click', function () {
                    document.getElementById('successPopupForm').style.display = 'none';
                });
            }

            var loginBtn = document.getElementById("loginBtn");
            var dropdownContent = document.getElementById("dropdownContent");
            var borrowForm = document.getElementById("borrowForm");

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

                // Event listener untuk pinjam buku
                var borrowBtn = document.querySelector('.wa');
                if (borrowBtn) {
                    borrowBtn.addEventListener('click', function(event) {
                        event.preventDefault();
                        document.querySelector('.popup-form').style.display = 'block';
                    });
                }
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
                if (event.target.matches('.popup-form .close-btn')) {
                    document.querySelector('.popup-form').style.display = 'none';
                }
            }

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

        <!-- Pop-up form -->
        <div class="popup-form" id="popupForm">
            <span class="close-btn">&times;</span>
            <h2>Pinjam Buku</h2>
            <p><?php echo $data['title_book']; ?></p>
            <form action="detail-book.php?id_book=<?php echo $id_book; ?>" method="POST">
                <input type="hidden" name="id_book" value="<?php echo $id_book; ?>">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                <label for="borrow_date" class="labelborrow">Nama Peminjam</label>
                <input type="text" id="borrower_name" name="borrower_name" placeholder="Nama Peminjam" required>
                <input type="hidden" name="title_book" value="<?php echo $data['title_book']; ?>">
                <label for="borrow_date" class="labelborrow">Tanggal Pinjam</label>
                <input type="date" id="borrow_date" name="borrow_date" required>
                <label for="return_date" class="labelborrow">Tanggal Kembali</label>
                <input type="date" id="return_date" name="return_date" required>
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
                    <select name="corner" class="corner-lib" required>
                        <option value="Literasi Imajinatif">Literasi Imajinatif</option>
                        <option value="Social Connect">Social Connect</option>
                        <option value="Bisnis Berdaya">Bisnis Berdaya</option>
                        <option value="Kreatif Kids Corner">Kreatif Kids Corner</option>
                        <option value="Pena Inspirasi Gemilang">Pena Inspirasi Gemilang</option>
                    </select>
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
                            <p style="color: #fff">
                            Login    
                            </p>    
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
                                <p class="sipnopsis">Sipnopsis Buku</p>
                            </a>
                            <p class="detailbook">Detail Buku</p>

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
                                <?php if (isset($_SESSION['username'])): ?>
                                    <a href="#" class="wa">
                                        <span class="rentbutton">Pinjam Buku</span>
                                    </a>
                                <?php else: ?>
                                    <a href="../login.php" class="wa">
                                        <span class="rentbutton">Login untuk Pinjam</span>
                                    </a>
                                <?php endif; ?>
                                
                            <?php endif; ?>
                        </div>

                        <hr class="white-line">

                        <div class="title-1">
                            <h2 class="t1" style="color: #fff;">Sipnopsis Buku</h2>
                        </div>
                        <div class="sipnopsis-desc">
                            <p><?php echo $data['sipnopsis']; ?></p>
                        </div>
                        <div class="title-1">
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
        // Mengambil 10 buku secara acak dari tabel book
        $recommendationQuery = "SELECT * FROM book ORDER BY RAND() LIMIT 10";
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
                            <a href="detail-book.php?id_book=<?php echo $book['id_book']; ?>" class="frame-card-link">
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

    <!-- Tambahkan Form untuk Pinjam Buku -->
    <form id="borrowForm" method="POST" action="detail-book.php" style="display:none;">
        <input type="hidden" name="id_book" value="<?php echo $data['id_book']; ?>">
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="title_book" value="<?php echo $data['title_book']; ?>">
    </form>

    <script src="../js/carousel.js"></script>

</body>
</html>