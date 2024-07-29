<?php
include("koneksi.php");

$response = ['success' => false, 'message' => '', 'books' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_borrow = isset($_POST['id_borrow']) ? (int)$_POST['id_borrow'] : 0;
    $table_name = isset($_POST['table_name']) ? $_POST['table_name'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if ($id_borrow && $table_name && $status) {
        $table_name = mysqli_real_escape_string($connection, $table_name);

        // Update status in borrowing table
        $update_sql = "UPDATE $table_name SET status = ? WHERE id_borrow = ?";
        $stmt = mysqli_prepare($connection, $update_sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'si', $status, $id_borrow);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($result && $status == 'Kembali') {
                // Get the book ID from borrowing table
                $query = "SELECT id_book FROM $table_name WHERE id_borrow = $id_borrow";
                $result = mysqli_query($connection, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $book = mysqli_fetch_assoc($result);
                    $id_book = $book['id_book'];

                    // Update status in book table
                    $update_book_sql = "UPDATE book SET status = 'Tersedia' WHERE id_book = ?";
                    $stmt = mysqli_prepare($connection, $update_book_sql);
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'i', $id_book);
                        $result = mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);

                        if ($result) {
                            $response['success'] = true;
                        } else {
                            $response['message'] = 'Failed to update book status: ' . mysqli_error($connection);
                        }
                    } else {
                        $response['message'] = 'Failed to prepare statement for updating book status: ' . mysqli_error($connection);
                    }
                } else {
                    $response['message'] = 'Failed to get book ID: ' . mysqli_error($connection);
                }
            } elseif ($result) {
                $response['success'] = true;
            } else {
                $response['message'] = 'Failed to update borrowing status: ' . mysqli_error($connection);
            }

            if ($response['success']) {
                // Fetch updated books
                $books = getBooksFromTable($table_name);
                $response['books'] = $books;
            }
        } else {
            $response['message'] = 'Failed to prepare statement for updating borrowing status: ' . mysqli_error($connection);
        }
    } else {
        $response['message'] = 'Invalid request parameters';
    }
} else {
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);

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
