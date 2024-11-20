<?php
include("templates/header.php");
include "../db.php";
$db = new database();
$data_katalog = $db->tampil_data_katalog();
?>

<div class="container">
    <div class="d-flex justify-content-between mt-4">
        <h4 class="">Manajemen Katalog</h4>
        <a href="/wedding/admin/tambah.php" class="btn btn-primary">Tambah Katalog</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">ID User</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Updated_at</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($data_katalog == "0") {
                    echo "<tr><td>Data Tidak Tersedia</td></tr>";
                } else {
                    $no = 1;
                    foreach ($data_katalog as $row) {
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row["nama_paket"]; ?></td>
                            <td>
                                <img src="../files/katalog/<?= $row["gambar"]; ?>" alt="" style="max-width: 50px; max-height: 50px;">
                            </td>
                            <td><?= $row["harga"]; ?></td>
                            <td><?= $row["status_publish"]; ?></td>
                            <td><?= $row["id_user"]; ?></td>
                            <td><?= $row["created_at"]; ?></td>
                            <td>
                                <?php
                                if ($row['updated_at'] == '') {
                                    echo $row['created_at'];
                                } else {
                                    echo $row['updated_at'];
                                }
                                ?>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $row["id_katalog"]; ?>" class="btn btn-warning">Ubah</a>
                                <a href="proses.php?aksi=hapus&id=<?= $row["id_katalog"]; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin ingin Menghapus?');">Hapus</a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include("templates/footer.php");
?>