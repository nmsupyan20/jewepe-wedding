<?php

session_start();

if (!$_SESSION["username"] && !$_SESSION["status_user"] == "admin" && !$_SESSION["id_user"]) {
    header("Location: /wedding/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/wedding/admin/index.php">Jewepe Wedding Organizer</a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active mr-3">
                    <a class="nav-link" href="/wedding/admin/index.php">Manajemen Katalog</a>
                </li>
                <li class="nav-item active mr-3">
                    <a class="nav-link" href="manajemen-pesanan.php">Manajemen Pesanan</a>
                </li>
                <li class="nav-item active mr-3">
                    <a class="nav-link" href="laporan.php">Laporan</a>
                </li>
                <li class="nav-item dropdown mr-3">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Akun
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="pengaturan.php">Pengaturan</a>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>