<?php 
session_start();

if(isset($_SESSION["username"]) && isset($_SESSION["id_user"]) && isset($_SESSION["status_user"]) == "admin"){
    header("Location: admin/index.php");
    exit();
} else if(isset($_SESSION["username"]) && isset($_SESSION["id_user"]) && isset($_SESSION["status_user"]) == "pemesan"){
    header("Location: landing/beranda.php");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style-login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Login</title>
    <style>
        body {
            background-color: lightgray;
        }
    </style>
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h3 class="text-center mb-1">Login</h3>
                <?php
                if (isset($_GET["pesan"])) {
                    if ($_GET["pesan"] == "gagal") {
                        echo '<i class="text-danger">Login Gagal! Username atau Password Salah!</i>';
                    } else if ($_GET["pesan"] == "empty") {
                        echo '<i class="text-danger">Username dan Password tidak boleh kosong</i>';
                    } else if ($_GET['pesan'] == 'notfound') {
                        echo '<i class="text-danger">Username tidak tersedia</i>';
                    } else if ($_GET['pesan'] == 'notlogin') {
                        echo '<i class="text-danger">Anda harus login terlebih dahulu</i>';
                    } else if ($_GET['pesan'] == 'logout') {
                        echo '<i class="text-danger">Anda telah berhasil logout</i>';
                    } else if ($_GET['pesan'] == 'usernameSudahTerdaftar') {
                        echo '<i class="text-danger">Username telah ada di basis data</i>';
                    } else if ($_GET['pesan'] == 'daftarBerhasil') {
                        echo '<i class="text-danger">Anda telah berhasil membuat akun</i>';
                    } else if ($_GET['pesan'] == 'daftarGagal') {
                        echo '<i class="text-danger">Anda gagal membuat akun</i>';
                    } else if($_GET["pesan"] == 'loginDulu'){
                        echo '<i class="text-danger">Anda harus login terlebih dahulu</i>';
                    }
                }
                ?>
                <form action="validasi_login.php" method="post">
                    <div class="form-group">
                        <label for="username">Username : </label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password : </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
                    </div>
                    <div class="d-flex justify-content-center mb-2">
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="daftar.php" class="link-primary">Belum punya akun? daftar di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>