<?php
include("templates/header.php");
include("../db.php");

$db = new Database();

$query = [];

if (isset($_POST["cari"])) {
    $email = $_POST["email"];
    $nama = $_POST["nama"];

    $query = $db->cari_data_pesanan($email, $nama);
}
?>

<script>
    // Fungsi untuk mengatur atribut 'min' pada input tanggal ke tanggal hari ini
    function setMinDate() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tgl_wedding').setAttribute('min', today);
    }

    window.onload = setMinDate;
</script>

<div class="container mt-2">
    <h1 class="text-center">Cek Pesanan</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Email : </label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email">
        </div>
        <div class="form-group">
            <label for="nama">Nama : </label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
        </div>
        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
    </form>
    <br>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered">
            <caption>List of users</caption>
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
                </tr>
            </thead>
            <tbody>
                <?php if ($query == "0") {
                    echo "<tr><td>Data Tidak Tersedia</td></tr>";
                } else {
                    $no = 1;
                    foreach ($query as $data) { ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $data["nama"]; ?></td>
                            <td><?= $data["email"]; ?></td>
                            <td><?= $data["telepon"]; ?></td>
                            <td><?= $data["alamat"]; ?></td>
                            <td><?= $data["tgl_wedding"]; ?></td>
                            <td><?= $data["created_at"]; ?></td>
                            <td>
                                <?php if ($data['updated_at'] == '') {
                                    echo $data['created_at'];
                                } else {
                                    echo $data['updated_at'];
                                } ?>
                            </td>
                            <td>
                                <?php if($data["status_pesanan"] == "requested"){
                                    echo "Menunggu Konfirmasi";
                                } else {
                                    echo "Pesanan diterima";
                                }?>
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