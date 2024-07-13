
// KONFIRMASI HAPUS DATA
function confirmDelete(id_book) {
    if (confirm("Anda yakin ingin Hapus Data ini?")) {
        window.location.href = "dashbook.php?id_book=" + id_book;
    }
}