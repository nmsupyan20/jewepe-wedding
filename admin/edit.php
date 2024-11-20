<?php
include("templates/header.php");
include("../db.php");
$db = new database();
$id_katalog = $_GET['id'];
if (!empty($id_katalog)) {
    $data = $db->get_katalog_by_id($id_katalog);
    if (empty($data)) {
        echo "<script>alert('Id katalog tidak ditemukan'); document.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('Anda belum memilih katalog'); document.location.href = 'index.php';</script>";
}
?>

<div class="container-fluid mt-4">
    <form action="proses.php?aksi=ubah" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col-7 mr-4">
                <div class="form-group">
                    <label for="idKatalog">ID Katalog : </label>
                    <input type="number" class="form-control" id="idKatalog" name="idKatalog" placeholder="Field ini terisi otomatis" value="<?= $data["id_katalog"]; ?>" disabled>
                    <input type="hidden" name="idKatalog" value="<?= $data["id_katalog"]; ?>">
                </div>
                <div class="form-group">
                    <label for="paket">Nama Paket : </label>
                    <input type="text" class="form-control" id="paket" name="paket" value="<?= $data["nama_paket"]; ?>" placeholder="Masukkan Nama Paket">
                </div>
                <div class="form-group">
                    <label for="harga">Harga : </label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= $data["harga"]; ?>" placeholder="Masukkan Harga">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi : </label>
                    <textarea class="form-control editor" id="deskripsi" name="deskripsi"><?= $data["deskripsi"]; ?>"</textarea>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="status">Status Publish: </label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="publish" <?= ($data['status_publish'] == 'publish') ? 'checked' : ''; ?>>
                        <label class="form-check-label">
                            Publish
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="draft" <?= ($data['status_publish'] == 'draft') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="draft">
                            Draft
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga">Gambar : </label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar" aria-describedby="nama-gambar">
                            <label class="custom-file-label" for="nama-gambar">Choose file</label>
                        </div>
                    </div>
                    <small class="">Max Size 5 Mb, ext. png, jpg, jpeg</small>
                </div>
                <div class="mb-3">
                    <label for="preview" class="form-label">Preview Gambar</label>
                    <div>
                        <?php
                        if ($data['gambar'] != "") { ?>
                            <a href="../files/katalog/<?= $data['gambar'] ?>" target="_blank">
                                <img src="../files/katalog/<?= $data['gambar'] ?>" class="img-thumbnail rounded" style="max-width: 130px;">
                            </a>
                        <?php } else {
                            echo "<i class='text-danger'>File Not Set!</i>";
                        }
                        ?>
                    </div>
                </div>
                <script>
                    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                        let fileName = document.getElementById("gambar").files[0].name;
                        let nextSibling = e.target.nextElementSibling;
                        nextSibling.innerText = fileName;
                    });
                </script>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary w-25" id="buat-katalog" name="buat-katalog">Ubah Katalog</button>
        </div>
    </form>
</div>

<?php
include("templates/footer.php");
?>