<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_borrow = $_POST['id_borrow'];
    $table_name = $_POST['table_name'];
    $status = $_POST['status'];

    // Update status pinjaman
    if (updateBorrowStatus($id_borrow, $table_name, $status)) {
        $books = getBooksFromTable($table_name);
        echo json_encode(['success' => true, 'books' => $books]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status.']);
    }
}

function updateBorrowStatus($id_borrow, $table_name, $status) {
    global $connection;
    
    $table_name = mysqli_real_escape_string($connection, $table_name);
    $status = mysqli_real_escape_string($connection, $status);
    
    // Update status peminjaman
    $sql = "UPDATE $table_name SET status = ? WHERE id_borrow = ?";
    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'si', $status, $id_borrow);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        if ($result && $status == 'Tersedia') {
            // Get the id_book from the borrowing table
            $sql = "SELECT id_book FROM $table_name WHERE id_borrow = ?";
            $stmt = mysqli_prepare($connection, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'i', $id_borrow);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_book);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
                
                // Update status book in the book table
                $sql = "UPDATE book SET status = 'Tersedia' WHERE id_book = ?";
                $stmt = mysqli_prepare($connection, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'i', $id_book);
                    $result = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    return $result;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        return $result;
    } else {
        return false;
    }
}

function getBooksFromTable($table) {
    global $connection;
    $table = mysqli_real_escape_string($connection, $table);
    $sql = "SELECT id_borrow, id_book, name, title_book, borrow_date, return_date, status FROM $table";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }
    $books = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
    return $books;
}
?>
