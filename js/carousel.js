// BOX REKOMENDASI (BUKU, EBOOK, UMKM)
document.addEventListener('DOMContentLoaded', function() {
    const frameContainer = document.querySelector('.frame-container');
    const frameCards = document.querySelectorAll('.frame-card');
    const prevBtn = document.querySelector('.other-btn-1');
    const nextBtn = document.querySelector('.other-btn-2');

    // Menghitung lebar dari satu frame-card
    const cardWidth = frameCards[0].offsetWidth;

    // Menghitung jumlah total frame-card
    const numCards = frameCards.length;

    // Menghitung jumlah frame-card yang terlihat dalam satu tampilan
    const visibleCards = 4; // Mengatur agar 5 card yang terlihat

    // Menghitung jumlah frame-card yang akan digeser per klik tombol
    const shiftAmount = cardWidth;

    // Inisialisasi variabel untuk menghitung posisi saat ini
    let currentPosition = 0;

    // Fungsi untuk menggeser frame-card ke kiri
    function shiftLeft() {
        if (currentPosition < 0) {
            currentPosition += shiftAmount;
            frameContainer.style.transform = `translateX(${currentPosition}px)`;
        }
    }

    // Fungsi untuk menggeser frame-card ke kanan
    function shiftRight() {
        // Hitung posisi maksimum untuk menggeser ke kanan agar card terakhir bisa terlihat
        const maxPosition = -(cardWidth * (numCards - visibleCards));
        if (currentPosition > maxPosition) {
            currentPosition -= shiftAmount;
            frameContainer.style.transform = `translateX(${currentPosition}px)`;
        }
    }

    // Event listener untuk tombol previous
    prevBtn.addEventListener('click', function() {
        shiftLeft();
    });

    // Event listener untuk tombol next
    nextBtn.addEventListener('click', function() {
        shiftRight();
    });
});
