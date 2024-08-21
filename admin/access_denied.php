<?php
// Mulai session di sini
session_start();

// Hapus session akses ditolak
unset($_SESSION['access_denied']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    <link rel="stylesheet" href="../css/popup.css"> <!-- Tambahkan CSS pop-up di sini -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Akses Ditolak Popup -->
    <div class="cd-popup-role" role="alert">
        <div class="cd-popup-container-role">
            <p>Anda tidak memiliki akses untuk melihat halaman ini.</p>
            <ul class="cd-buttons-role">
                <li><a href="#" class="cd-popup-yes-role" onclick="goBack()">Oke</a></li>
            </ul>            
        </div>
    </div>

    <script>
        // Fungsi untuk kembali ke halaman sebelumnya
        function goBack() {
            window.history.back();
        }

        // Tampilkan pop-up
        document.addEventListener('DOMContentLoaded', function() {
            var popup = document.querySelector('.cd-popup-role');
            popup.classList.add('is-visible');

            // Close popup when clicking outside of it
            popup.addEventListener('click', function (event) {
                if (event.target === popup) {
                    popup.classList.remove('is-visible');
                }
            });
        });
    </script>
</body>
</html>
