<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrow'])) {
    $name_member = mysqli_real_escape_string($connection, $_POST['name_member']);
    $name_corner = mysqli_real_escape_string($connection, $_POST['name_corner']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);

    $query = "INSERT INTO absen (name_member, name_corner, date) VALUES ('$name_member', '$name_corner', '$date')";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Data successfully inserted');</script>";
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

            // Event listener untuk absen
            var borrowBtn = document.querySelector('.absen-pb');
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
        }

        var closeBtn = document.querySelector('.popup-form .close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                document.querySelector('.popup-form').style.display = 'none';
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
            <h2>Absen</h2>
            <p>Pojok Baca</p>
            <form action="catalog-book.php" method="POST">
                <label for="name_member" class="labelborrow">Nama</label>
                <input type="text" id="name_member" name="name_member" placeholder="Nama" required>

                <label for="name_corner" class="labelborrow">Pojok Baca</label>
                <select name="name_corner" class="form-control" required>
                    <option value="Literasi Imajinatif">Literasi Imajinatif</option>
                    <option value="Social Connect">Social Connect</option>
                    <option value="Bisnis Berdaya">Bisnis Berdaya</option>
                    <option value="Kreatif Kids Corner">Kreatif Kids Corner</option>
                    <option value="Pena Inspirasi Gemilang">Pena Inspirasi Gemilang</option>
                </select>

                <label for="date" class="labelborrow">Tanggal</label>
                <input type="date" id="date" name="date" required>

                <input type="submit" class="submit-btn" name="borrow" value="Absen">
            </form>
        </div>
        
        <header class="bg-navbar">
            <nav class="navbar">
                <div class="logo-nav">
                    <a href="../homepage.php">
                        <img src="../img/navbar/logo-cipsmart-nav.png" alt="" class="logonav">
                    </a>
                </div>
                <div class="corner-lib">
                    <p class="corner">Literasi Imajinatif</p>
                    <img src="../img/navbar/chevron.png" alt="">
                    <div class="dropdown">
                        <ul>
                        <li><a href="#">Social Connect</a></li>
                            <li><a href="#">Bisnis Berdaya</a></li>
                            <li><a href="#">Kreatifitas Kids Corner</a></li>
                            <li><a href="#">Pena Inspirasi Gemilang</a></li>
                        </ul>
                    </div>
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

                    <div class="absen">
                        <?php if (isset($_SESSION['username'])): ?>
                            <a href="#" class="absen-pb">
                                <span class="absen-btn">Absen</span>
                            </a>
                        <?php else: ?>
                            <a href="#" class="absen-none">
                                <span class="absen-btn-disable">Absen</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>        

        <div class="content">
            <div class="sidebar">
                <div class="front-sidebar">
                    <div class="perpus">
                        <a href="#">
                            <img src="../img/catalog/lib-btn.png" alt="">
                        </a>
                        <p class="perpustext">
                            Perpustakaan
                        </p>
                    </div>
    
                    <div class="ebook">
                        <a href="#">
                            <img src="../img/catalog/ebook-btn.png" alt="">
                        </a>
                        <p class="ebooktext">
                            E-Book
                        </p>
                    </div>
    
                    <div class="umkm">
                        <a href="#">
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
                    <?php
                        include("koneksi.php");

                        $query = mysqli_query($connection, "SELECT * FROM book");
                        if ($query && mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_assoc($query)) {
                                $imagePath = '../' . $data["photo"];
                                echo '<div class="frame-card">
                                    <a href="detail-book.php?id_book=' . $data['id_book'] . '">
                                        <div class="cardd">
                                            <img class="img-p" src="' . $imagePath . '" alt="' . $data["title_book"] . '">
                                        </div>
                                    </a>
                            
                                    <h1 class="name-book">' . $data["title_book"] . '</h1>
                                    <h1 class="name-author">' . $data["author_name"] . '</h1>
                                    <h1 class="status">' . $data["status"] . '</h1>
                                </div>';
                            }
                        } else {
                            echo "0 results";
                        }
                    ?>
                </div>
            </div>
                

        </div>

        <!--  -->
        <div class="footer" >
            
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
