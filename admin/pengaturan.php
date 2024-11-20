<?php
include("templates/header.php");
include("../db.php");

$db = new Database();

$get_data = $db->get_settings_by_id();
// Proses penyimpanan data saat form disubmit
if (isset($_POST["update"])) {
    $judul = $_POST["judul"];
    $subjudul = $_POST["subjudul"];
    $deskripsi = $_POST["deskripsi"];
    $alamat = $_POST["alamat"];
    $instagram = $_POST["instagram"];
    $gmail = $_POST["gmail"];
    $telepon = $_POST["telepon"];

    // Validasi input (opsional, tambahkan validasi sesuai kebutuhan)
    if (empty($judul) || empty($subjudul) || empty($deskripsi) || empty($alamat) || empty($instagram) || empty($gmail) || empty($telepon)) {
        echo "<script>alert('Data wajib diisi')</script>";
    } else {
        // Perbarui pengaturan di database
        $settings = $db->ubah_data_settings($judul, $subjudul, $deskripsi, $alamat, $instagram, $gmail, $telepon, $get_data["id"]);
        if ($settings) {
            echo "<script>alert('Data settings berhasil diubah'); window.location.href = 'pengaturan.php';</script>";
        } else {
            echo "<script>alert('Data settings gagal diubah'); window.location.href = 'pengaturan.php';</script>";
        }
    }
}
?>

<div class="container">
    <h1 class="text-center">Pengaturan Website</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" class="form-control" name="judul" id="judul" value="<?= $get_data['judul']; ?>">
        </div>
        <div class="form-group">
            <label for="subjudul">Subjudul:</label>
            <input type="text" class="form-control" name="subjudul" id="subjudul" value="<?= $get_data['subjudul']; ?>">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi"><?= $get_data['deskripsi']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $get_data['alamat']; ?>">
        </div>
        <div class="form-group">
            <label for="instagram">Instagram:</label>
            <input type="text" class="form-control" name="instagram" id="instagram" value="<?= $get_data['instagram']; ?>">
        </div>
        <div class="form-group">
            <label for="gmail">Gmail:</label>
            <input type="email" class="form-control" name="gmail" id="gmail" value="<?= $get_data['email']; ?>">
        </div>
        <div class="form-group">
            <label for="telepon">Telepon:</label>
            <input type="text" class="form-control" name="telepon" id="telepon" value="<?= $get_data['telepon']; ?>">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Perbarui</button>
    </form>
</div>

<?php include("templates/footer.php")?>