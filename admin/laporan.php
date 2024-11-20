<?php

include("templates/header.php");
include("../db.php");

$db = new Database();
// Mendapatkan statistik pesanan
$stats = $db->get_pesanan_stats();

// Mendapatkan detail pesanan
$accepted_pesanan = $db->get_accepted_pesanan();
?>

<div class="container">
    <h1 class="text-center mt-4">Laporan Pesanan</h1>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan</h5>
                    <p class="card-text"><?= $stats['total']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Accepted</h5>
                    <p class="card-text"><?= $stats['accepted']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Requested</h5>
                    <p class="card-text"><?= $stats['requested']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Harga Awal</th>
                    <th scope="col">Jumlah Pesanan</th>
                    <th scope="col">Harga Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($accepted_pesanan)) {
                    echo "<tr><td colspan='5'>Data Tidak Tersedia</td></tr>";
                } else {
                    $no = 1;
                    $total_harga_semua = 0;
                    foreach ($accepted_pesanan as $row) {
                        $total_harga_semua += $row['total_harga'];
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= strtolower($row["nama_paket"]); ?></td>
                            <td><?= number_format($row["harga"], 0, ',', '.'); ?></td>
                            <td><?= $row["jumlah"]; ?></td>
                            <td><?= number_format($row["total_harga"], 0, ',', '.'); ?></td>
                        </tr>
                    <?php }
                    ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                        <td><strong><?= number_format($total_harga_semua, 0, ',', '.'); ?></strong></td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("templates/footer.php"); ?>