<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username, email, and password from the form
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 0) {
        // Username does not exist, insert the new user
        $insert_query = "INSERT INTO user (name, username, email, password) VALUES ('$name', '$username', '$email', '$hashed_password')";
        if (mysqli_query($connection, $insert_query)) {
            echo "<script>alert('Registrasi Berhasil! Silahkan Login'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($connection) . "'); window.location.href='login.php';</script>";
        }
    } else {
        // Username already exists
        echo "<script>alert('Username telah dipakai!'); window.location.href='login.php';</script>";
    }
}
?>
