<?php 
include("templates/header.php"); 
include("../db.php");

$db = new Database();

$id_katalog = $_GET["id"];
if (!empty($id_katalog)) {
    $data = $db->get_katalog_by_id($id_katalog);
    if (empty($data)) {
        echo "<script>alert('Id katalog tidak ditemukan'); document.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('Anda belum memilih katalog'); document.location.href = 'index.php';</script>";
}

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <img src="../files/katalog/<?= $data["gambar"]; ?>" class="img-fluid" alt="<?= $data["nama_paket"]; ?>">
        </div>
        <div class="col-md-9">
            <h2 class="mb-3"><?= $data["nama_paket"]; ?></h2>
            <p><strong>Deskripsi:</strong></p>
            <p><?= $data["deskripsi"]; ?></p>
            <p><strong>Harga:</strong> <?= "Rp " . number_format($data["harga"], 0, ',', '.'); ?></p>
            <a href="pesan.php?id=<?= $data["id_katalog"]; ?>" class="btn btn-primary">Pesan Sekarang</a>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>