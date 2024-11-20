<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "db_wedding";

    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (!$this->conn) {
            echo "Koneksi Gagal : " . mysqli_connect_error();
        }
    }

    public function tampilUsername($username)
    {
        $query = "SELECT * FROM tb_user WHERE username='$username'";
        $sql = mysqli_query($this->conn, $query);

        return $sql;
    }

    public function get_katalog_by_id($id_katalog)
    {
        $query = mysqli_query($this->conn, "SELECT id_katalog, gambar, nama_paket, deskripsi, harga, 
        status_publish, created_at, updated_at FROM tb_katalog WHERE id_katalog = '$id_katalog'")
            or die(mysqli_error($this->conn));

        return mysqli_fetch_assoc($query);
    }

    public function get_settings_by_id()
    {
        $query = mysqli_query($this->conn, "SELECT * FROM tb_settings");
        
        return mysqli_fetch_assoc($query);
    }

    public function get_pesanan_stats()
    {
        $stats = [
            'total' => 0,
            'accepted' => 0,
            'requested' => 0
        ];

        $result = mysqli_query($this->conn, "SELECT status_pesanan, COUNT(*) as count FROM tb_pesanan GROUP BY status_pesanan");

        while ($row = mysqli_fetch_assoc($result)) {
            $stats['total'] += $row['count'];
            if ($row['status_pesanan'] == 'accepted') {
                $stats['accepted'] = $row['count'];
            } elseif ($row['status_pesanan'] == 'batalkan') {
                $stats['requested'] = $row['count'];
            }
        }

        return $stats;
    }

    function get_accepted_pesanan()
    {
        $query = "
            SELECT 
                k.nama_paket, 
                k.harga, 
                COUNT(p.id_pesanan) as jumlah, 
                SUM(k.harga) as total_harga 
            FROM 
                tb_pesanan p 
            JOIN 
                tb_katalog k ON p.id_katalog = k.id_katalog 
            WHERE 
                p.status_pesanan = 'accepted' 
            GROUP BY 
                k.nama_paket, k.harga
        ";
        $result = mysqli_query($this->conn, $query);
        $data = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        } else {
            die("Query error: " . mysqli_error($this->conn));
        }

        return $data;
    }

    public function tampil_data_katalog()
    {
        $data = mysqli_query($this->conn, "SELECT id_katalog, gambar, nama_paket, harga, 
        status_publish, id_user, created_at, updated_at FROM tb_katalog");

        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_assoc($data)) {
                    $hasil[] = $row;
                }
            } else {
                $hasil = "0";
            }
        }
        return $hasil;
    }

    public function tampil_data_pesanan()
    {
        $insert = mysqli_query($this->conn, "SELECT * FROM tb_pesanan");

        if ($insert) {
            if (mysqli_num_rows($insert) > 0) {
                while ($row = mysqli_fetch_assoc($insert)) {
                    $hasil[] = $row;
                }
            } else {
                $hasil = "0";
            }
        }
        return $hasil;
    }

    public function cari_data_pesanan($email, $nama)
    {
        $insert = mysqli_query($this->conn, "SELECT * FROM tb_pesanan WHERE email = '$email' OR nama = '$nama'");

        if ($insert) {
            if (mysqli_num_rows($insert) > 0) {
                while ($row = mysqli_fetch_assoc($insert)) {
                    $hasil[] = $row;
                }
            } else {
                $hasil = "0";
            }
        }
        return $hasil;
    }

    public function tambah_data_katalog($gambar, $paket, $deskripsi, $harga, $status_publish, $id_user)
    {
        $datetime = date("Y-m-d H:i:s");

        $insert = mysqli_query($this->conn, "INSERT INTO tb_katalog (gambar, nama_paket, deskripsi, harga,
        status_publish, id_user, created_at) VALUES ('$gambar', '$paket', '$deskripsi', '$harga', 
        '$status_publish', '$id_user', '$datetime')");

        return $insert;
    }

    public function tambah_data_pesanan($id_katalog, $nama, $email, $telepon, $alamat, $tgl_wedding)
    {
        $datetime = date("Y-m-d H:i:s");

        $insert = mysqli_query($this->conn, "INSERT INTO tb_pesanan (id_katalog, nama, email, telepon, alamat, tgl_wedding,
        status_pesanan, created_at) VALUES ('$id_katalog', '$nama', '$email', '$telepon', '$alamat', '$tgl_wedding',
        'requested','$datetime')");

        return $insert;
    }

    public function ubah_data_katalog($gambar, $paket, $deskripsi, $harga, $status_publish, $id_katalog, $id_user)
    {
        $datetime = date("Y-m-d H:i:s");
        if ($gambar == 'not_set') {
            $query = mysqli_query($this->conn, "UPDATE tb_katalog SET nama_paket = '$paket', deskripsi = '$deskripsi', 
            harga = '$harga', status_publish = '$status_publish', id_user = '$id_user', updated_at = '$datetime' 
            WHERE id_katalog = '$id_katalog'") or die(mysqli_error($this->conn));

            return $query;
        } else {
            $query = mysqli_query($this->conn, "UPDATE tb_katalog SET gambar = '$gambar', nama_paket = '$paket',
            deskripsi = '$deskripsi', harga = '$harga', status_publish = '$status_publish', id_user = '$id_user', 
            updated_at = '$datetime' WHERE id_katalog = '$id_katalog'") or die(mysqli_error($this->conn));

            return $query;
        }
    }

    public function ubah_data_settings($judul, $subjudul, $deskripsi, $alamat, $instagram, $gmail, $telepon, $id_settings)
    {
        $query = mysqli_query($this->conn, "UPDATE settings SET 
            judul = '$judul', 
            subjudul = '$subjudul', 
            deskripsi = '$deskripsi', 
            alamat = '$alamat', 
            instagram = '$instagram', 
            gmail = '$gmail', 
            telepon = '$telepon'
            WHERE id = '$id_settings'");

        return mysqli_fetch_assoc($query);
    }

    public function ubah_status_data_pesanan($status_pesanan_baru, $id_pesanan)
    {
        $query = mysqli_query($this->conn, "UPDATE tb_pesanan SET status_pesanan = '$status_pesanan_baru' WHERE id_pesanan = '$id_pesanan'");

        return $query;
    }

    public function hapus_data_katalog($id_katalog)
    {
        $query = mysqli_query($this->conn, "DELETE FROM tb_katalog WHERE id_katalog = '$id_katalog'")
            or die(mysqli_error($this->conn));
        return $query;
    }
}
