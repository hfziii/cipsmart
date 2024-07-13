<?php
session_start();
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Query to check if the user exists in 'user' table
    $query_user = "SELECT * FROM user WHERE username = '$username'";
    $result_user = mysqli_query($connection, $query_user);

    if ($result_user) {
        if (mysqli_num_rows($result_user) == 1) {
            $row_user = mysqli_fetch_assoc($result_user);

            // Verify the password using password_verify
            if (password_verify($password, $row_user['password'])) {
                // Password is correct, start a session
                $_SESSION['username'] = $username;
                header("Location: homepage.php");
                exit();
            } else {
                // Password is incorrect
                echo "<script>alert('Password anda salah!'); window.location.href='login.php';</script>";
            }
        } else {
            // Username doesn't exist in 'user' table
            // Check in 'admin' table
            $query_admin = "SELECT * FROM admin WHERE username = '$username'";
            $result_admin = mysqli_query($connection, $query_admin);

            if ($result_admin) {
                if (mysqli_num_rows($result_admin) == 1) {
                    $row_admin = mysqli_fetch_assoc($result_admin);

                    // Verify the password without hashing for admin
                    if ($password == $row_admin['password']) {
                        // Password is correct, start a session
                        $_SESSION['username'] = $username;
                        header("Location: dashbook.php");
                        exit();
                    } else {
                        // Password is incorrect
                        echo "<script>alert('Password admin salah!'); window.location.href='login.php';</script>";
                    }
                } else {
                    // Username doesn't exist in 'admin' table as well
                    echo "<script>alert('Username admin tidak tersedia!'); window.location.href='login.php';</script>";
                }
            } else {
                // Query failed
                echo "<script>alert('Query admin failed: " . mysqli_error($connection) . "'); window.location.href='login.php';</script>";
            }
        }
    } else {
        // Query failed
        echo "<script>alert('Query user failed: " . mysqli_error($connection) . "'); window.location.href='login.php';</script>";
    }
}
?>