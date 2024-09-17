<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya</title>
</head>
<body>
    <h1>Selamat datang, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p>Ini adalah halaman akun Anda.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
