<?php
include("templates/header.php");
include("../db.php");

$db = new Database();
$data_katalog = $db->tampil_data_katalog();
$data_settings = $db->get_settings_by_id();
?>

<div class="jumbotron jumbotron-fluid bg-jumbotron">
    <div class="container text-center">
        <h1 class="display-4"><?= $data_settings["judul"]?></h1>
        <p class="lead"><?= $data_settings["subjudul"]?></p>
    </div>
</div>

<div class="section about-us" id="about">
    <div class="container">
        <h2>Tentang Kami</h2>
        <p><?= $data_settings["deskripsi"]?></p>
    </div>
</div>

<div class="section packages" id="packages">
    <div class="container">
        <h2 class="mb-4">Paket Katalog Pernikahan</h2>
        <div class="row">
            <?php if ($data_katalog == "0") { ?>
                <h1 class="text-center">--Tidak Ada Katalog Yang Tersedia</h1>
                <?php
            } else {
                foreach ($data_katalog as $row) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="../files/katalog/<?= $row["gambar"]; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["nama_paket"] ?></h5>
                                <hr>
                                <p class="card-text"><?= $row["nama_paket"] ?></p>
                                <a href="detail.php?id=<?= $row["id_katalog"]; ?>" class="btn btn-primary">Detail Katalog</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</div>


<div class="section contact" id="contact">
    <div class="container">
        <h2>Kontak Kami</h2>
        <div class="row">
            <div class="col-md-3">
                <h5>Instagram</h5>
                <p><a href="https://instagram.com/<?= $data_settings["instagram"]?>" target="_blank">nmsupyan_20</a></p>
            </div>
            <div class="col-md-3">
                <h5>Email</h5>
                <p><a href="mailto:<?= $data_settings["email"]?>">nmsupyan@gmail.com</a></p>
            </div>
            <div class="col-md-3">
                <h5>Telepon</h5>
                <p><?= $data_settings["telepon"]?></p>
            </div>
            <div class="col-md-3">
                <h5>Alamat</h5>
                <p><?= $data_settings["alamat"]?></p>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p>&copy; 2024 Jewepe Wedding Organizer. LSP Gunadarma.</p>
</div>


<?php include("templates/footer.php"); ?>