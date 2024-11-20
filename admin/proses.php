<?php

include("../db.php");

$db = new Database();

session_start();
$id_users = $_SESSION['id_user'];
$aksi = $_GET['aksi'];

if ($aksi == "tambah") {
    // Cek Apakah File sudah di insert?
    if ($_FILES['gambar']['name'] != '') {
        $tmp = explode('.', $_FILES['gambar']['name']); // memecah nama file dan extension
        $ext = end($tmp); // mengambil extension
        $filename = $tmp[0]; // ambil nama file gambar
        $allowed_ext = array("jpg", "png", "jpeg"); // extension yang dibolehkan

        if (in_array($ext, $allowed_ext)) {

            if ($_FILES['gambar']['size'] <= 5120000) {
                $nama_gambar = $filename . "_" . rand() . "." . $ext; // rename nama gambar
                $path = "../files/katalog/" . $nama_gambar; // buat path gambar
                $uploaded = move_uploaded_file($_FILES['gambar']['tmp_name'], $path); // upload file

                if ($uploaded) {
                    $insertData = $db->tambah_data_katalog(
                        $nama_gambar,
                        $_POST['paket'],
                        $_POST['deskripsi'],
                        $_POST['harga'],
                        $_POST['status'],
                        $id_users
                    );

                    if ($insertData) {
                        echo "<script>alert('Data Berhasil ditambahkan'); window.location.href = 'index.php';</script>";
                    } else {
                        echo "<script>alert('Data Gagal ditambahkan'); window.location.href = 'index.php';</script>";
                    }
                } else {
                    echo "<script>alert('Data Gagal diunggah'); window.location.href = 'tambah.php';</script>";
                }
            } else {
                echo "<script>alert('Ukuran Gambar Lebih dari 5 MB'); window.location.href = 'tambah.php';</script>";
            }
        } else {
            echo "<script>alert('Extension file tidak diizinkan'); window.location.href = 'tambah.php';</script>";
        }
    } else {
        echo "<script>alert('Silahkan Pilih File Gambar'); window.location.href = 'tambah.php';</script>";
    }
} else if ($aksi == "ubah") {
    // Lakukan Operasi Update Data
    $id_katalog = $_POST['idKatalog'];
    if (!empty($id_katalog)) {
        if ($_FILES['gambar']['name'] != "") {
            $data = $db->get_katalog_by_id($id_katalog);
            $tmp = explode('.', $_FILES['gambar']['name']); // memecah nama file dan extension
            $ext = end($tmp); // mengambil extension
            $filename = $tmp[0]; // ambil nama file gambar
            $allowed_ext = array("jpg", "png", "jpeg"); // extension yang dibolehkan

            if (in_array($ext, $allowed_ext)) {

                if ($_FILES['gambar']['size'] <= 5120000) {
                    $nama_gambar = $filename . "_" . rand() . "." . $ext; // rename nama gambar
                    $path = "../files/katalog/" . $nama_gambar; // buat path gambar
                    $uploaded = move_uploaded_file($_FILES['gambar']['tmp_name'], $path); // upload file

                    if ($uploaded) {
                        $updateData = $db->ubah_data_katalog(
                            $nama_gambar,
                            $_POST['paket'],
                            $_POST['deskripsi'],
                            $_POST["harga"],
                            $_POST['status'],
                            $_POST['idKatalog'],
                            $id_users
                        );

                        if ($updateData) {
                            echo "<script>alert('Data Berhasil di Edit'); window.location.href = 'index.php';</script>";
                        } else {
                            echo "<script>alert('Data Gagal di Edit'); window.location.href = 'index.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Data Gagal di Upload'); window.location.href = 'edit.php?id=" . $id_katalog . "';</script>";
                    }
                } else {
                    echo "<script>alert('Ukuran Gambar Lebih dari 5 MB'); window.location.href = 'edit.php?id=" . $id_katalog . "';</script>";
                }
            } else {
                echo "<script>alert('Extension file tidak diizinkan'); window.location.href = 'edit.php?id=" . $id_katalog . "';</script>";
            }
        } else {
            $updateData = $db->ubah_data_katalog(
                'not_set',
                $_POST['paket'],
                $_POST['deskripsi'],
                $_POST["harga"],
                $_POST['status'],
                $_POST['idKatalog'],
                $id_users
            );

            if ($updateData) {
                echo "<script>alert('Data Berhasil di Edit'); window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Data Gagal di Edit'); window.location.href = 'index.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Anda belum memilih katalog'); window.location.href = 'index.php';</script>";
    }
} else if ($aksi == "hapus") {
    // Lakukan Operasi Hapus Data
    $id_katalog = $_GET['id'];
    if (!empty($id_katalog)) {
        $data = $db->get_katalog_by_id($id_katalog);

        if (file_exists('../files/katalog/' . $data['gambar']) && $data['gambar'])
            unlink('../files/katalog' . $data['gambar']);

        $deleteData = $db->hapus_data_katalog($id_katalog);
        if ($deleteData) {
            echo "<script>alert('Data Berhasil di Hapus'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Data Gagal di Hapus'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Anda belum memilih katalog'); window.location.href = 'index.php';</script>";
    }
} else if ($aksi == "accepted") {
    $id_pesanan = $_GET['id'];
    $status_pesanan_baru = "accepted";

    $update_pesanan = $db->ubah_status_data_pesanan($status_pesanan_baru, $id_pesanan);

    if ($update_pesanan) {
        echo "<script>alert('Pesanan telah disetujui'); window.location.href = 'manajemen-pesanan.php';</script>";
    } else {
        echo "<script>alert('ID pesanan tidak ditemukan'); window.location.href = 'manajemen-pesanan.php';</script>";
    }
} else if ($aksi == "batalkan") {
    $id_pesanan = $_GET['id'];
    $status_pesanan_baru = "batalkan";

    $update_pesanan = $db->ubah_status_data_pesanan($status_pesanan_baru, $id_pesanan);

    if ($update_pesanan) {
        echo "<script>alert('Pesanan telah dibatalkan'); window.location.href = 'manajemen-pesanan.php';</script>";
    } else {
        echo "<script>alert('ID pesanan tidak ditemukan'); window.location.href = 'manajemen-pesanan.php';</script>";
    }
} else {
    // Kembali Ke index.php
    echo "
    <script>
        alert('Anda tidak memiliki akses untuk melakukan operasi');
        window.location.href = 'index.php';
    </script>
    ";
}
