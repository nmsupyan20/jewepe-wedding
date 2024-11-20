<?php
include("../db.php");
$db = new Database();

$id_katalog = $_GET["id"];

if (isset($_POST["pesan"])) {
    $nama = strtolower($_POST["nama"]);
    $email = strtolower($_POST["email"]);
    $telepon = $_POST["telepon"];
    $alamat = $_POST["alamat"];
    $tgl_wedding = $_POST["tgl_wedding"];

    // Memasukkan data pesanan ke dalam database
    $query = $db->tambah_data_pesanan($id_katalog, $nama, $email, $telepon, $alamat, $tgl_wedding);

    if($query){
        echo "<script>alert('Pesanan berhasil ditambahkan'); window.location.href = 'cek-pesanan.php';</script>";
    } else {
        echo "<script>alert('Pesanan gagal ditambahkan'); window.location.href = 'cek-pesanan.php';</script>";
    }

}
?>


<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Jewepe Wedding Organizer</title>
</head>
<style>
    body {
        background-color: lightgray;
    }
</style>

<body>
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card" style="width: 25rem; height: 36rem;">
            <div class="card-body">
                <h3 class="text-center">Form Pemesanan</h3>
                <hr>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon :</label>
                        <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="Masukkan Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat :</label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Mohon Isi Alamat" required></textarea>
                    </div>
                    <script>
                        // Mendapatkan tanggal hari ini
                        let today = new Date();

                        // Menambahkan 7 hari (1 minggu) ke tanggal hari ini
                        let maxDate = new Date(today);
                        maxDate.setDate(maxDate.getDate() + 7);

                        // Mengubah format tanggal ke format yang diterima oleh elemen input tanggal (YYYY-MM-DD)
                        let formattedMaxDate = maxDate.toISOString().split('T')[0];

                        // Menetapkan nilai atribut 'min' pada elemen input tanggal
                        window.onload = function() {
                            document.getElementById('tgl_wedding').setAttribute('min', formattedMaxDate);
                        };
                    </script>
                    <div class="form-group">
                        <label for="tgl_wedding">Tanggal Wedding :</label>
                        <input type="date" name="tgl_wedding" id="tgl_wedding" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="pesan">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>