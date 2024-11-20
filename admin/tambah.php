<?php
include("templates/header.php");
?>

<div class="container-fluid mt-4">
    <form action="proses.php?aksi=tambah" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col-7 mr-4">
                <div class="form-group">
                    <label for="idKatalog">ID Katalog : </label>
                    <input type="number" class="form-control" id="idKatalog" name="idKatalog" placeholder="Field ini terisi otomatis" disabled>
                </div>
                <div class="form-group">
                    <label for="paket">Nama Paket : </label>
                    <input type="text" class="form-control" id="paket" name="paket" placeholder="Masukkan Nama Paket">
                </div>
                <div class="form-group">
                    <label for="harga">Harga : </label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi : </label>
                    <textarea class="form-control editor" id="deskripsi" name="deskripsi"></textarea>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="status">Status Publish: </label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="publish">
                        <label class="form-check-label">
                            Publish
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status" value="draft">
                        <label class="form-check-label" for="draft">
                            Draft
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga">Gambar : </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar" aria-describedby="nama-gambar">
                            <label class="custom-file-label" for="nama-gambar">Choose file</label>
                        </div>
                    </div>
                    <small>Max Size 5 Mb, ext. png, jpg, jpeg</small>
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
            <button type="submit" class="btn btn-primary w-25" id="buat-katalog" name="buat-katalog">Buat Katalog</button>
        </div>
    </form>
</div>

<?php
include("templates/footer.php");
?>