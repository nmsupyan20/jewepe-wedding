<?php
include("templates/header.php");
include("../db.php");

$db = new Database();

$query = $db->tampil_data_pesanan();
?>

<div class="container">
    <div class="mt-4">
        <h4 class="">Manajemen Katalog</h4>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tanggal Wedding</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Updated_at</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($query == "0") {
                    echo "<tr><td>Data Tidak Tersedia</td></tr>";
                } else {
                    $no = 1;
                    foreach ($query as $row) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td><?= $row["telepon"]; ?></td>
                    <td><?= $row["alamat"]; ?></td>
                    <td><?= $row["tgl_wedding"]; ?></td>
                    <td><?= $row["created_at"]; ?></td>
                    <td>
                    <?php 
                    if($row['updated_at'] == '') {
                                    echo $row['created_at'];
                                } else {
                                    echo $row['updated_at'];
                                }
                    ?>
                    </td>
                    <td>
                        <div class="bg-primary text-white p-2 rounded">
                        <?php 
                        if($row["status_pesanan"] == "accepted"){
                            echo "Telah Disetujui";
                        } else if($row["status_pesanan"] == "batalkan"){
                            echo "Menunggu Konfirmasi";
                        }
                        ?>
                        </div>
                    </td>
                    <td>
                        <a href="proses.php?aksi=accepted&id=<?= $row["id_pesanan"]; ?>" class="btn btn-secondary">Accepted</a>
                        <a href="proses.php?aksi=batalkan&id=<?= $row["id_pesanan"]; ?>" class="btn btn-warning">Batalkan</a>
                    </td>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("templates/footer.php") ?>