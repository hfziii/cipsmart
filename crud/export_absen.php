<?php
    require '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    include("koneksi.php");

    // Check database connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $filter = isset($_POST['table_name']) ? $_POST['table_name'] : '';

    $queryStr = "SELECT * FROM absen";
    $params = [];
    if (!empty($filter)) {
        $queryStr .= " WHERE name_corner = ?";
        $params[] = $filter;
    }

    $stmt = $connection->prepare($queryStr);
    if (!empty($params)) {
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the column names
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama');
    $sheet->setCellValue('C1', 'Pojok Baca');
    $sheet->setCellValue('D1', 'Tanggal Mengunjungi');

    $row = 2;
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['id_absen']);
        $sheet->setCellValue('B' . $row, $data['name_member']);
        $sheet->setCellValue('C' . $row, $data['name_corner']);
        $sheet->setCellValue('D' . $row, $data['date']);
        $row++;
    }

    // Sanitize filter name for filename
    $sanitized_filter = preg_replace('/[^a-zA-Z0-9-_ ]/', '', $filter);
    $sanitized_filter = str_replace(' ', '_', $sanitized_filter);

    $filename = 'Laporan_Pengunjung_Pojok_Baca';
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
