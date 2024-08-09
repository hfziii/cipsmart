<?php
    require '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    include("koneksi.php");

    // Check database connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Mengambil nama tabel dari parameter GET
    $table_name = isset($_GET['table_name']) ? $_GET['table_name'] : 'borrowing_literasi_imajinatif';

    // Mengambil data dari tabel yang dipilih
    $queryStr = "SELECT id_borrow, id_book, title_book, name, borrow_date, return_date, status FROM $table_name";
    $result = mysqli_query($connection, $queryStr);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the column names
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Id Buku');
    $sheet->setCellValue('C1', 'Judul Buku');
    $sheet->setCellValue('D1', 'Nama Peminjam');
    $sheet->setCellValue('E1', 'Tanggal Pinjam');
    $sheet->setCellValue('F1', 'Tanggal Kembali');
    $sheet->setCellValue('G1', 'Status Buku');

    $row = 2;
    while ($data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $data['id_borrow']);
        $sheet->setCellValue('B' . $row, $data['id_book']);
        $sheet->setCellValue('C' . $row, $data['title_book']);
        $sheet->setCellValue('D' . $row, $data['name']);
        $sheet->setCellValue('E' . $row, $data['borrow_date']);
        $sheet->setCellValue('F' . $row, $data['return_date']);
        $sheet->setCellValue('G' . $row, $data['status']);
        $row++;
    }

    // Sanitize filter name for filename
    $sanitized_filter = preg_replace('/[^a-zA-Z0-9-_ ]/', '', $table_name);
    $sanitized_filter = str_replace(' ', '_', $sanitized_filter);

    $filename = 'Laporan_Peminjaman_Buku_Pojok_Baca';
    if (!empty($sanitized_filter)) {
        $filename .= '_'.$sanitized_filter;
    }
    $filename .= '.xlsx';

    // Ensure all output is clean before sending headers
    ob_clean();

    // Set the headers to download the file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'.urlencode($filename).'"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    exit();
?>
