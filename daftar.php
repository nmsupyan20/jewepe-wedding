<?php 
include("db.php");

$db = new Database();

if(isset($_POST["daftar"])){
    $email = $_POST["email"];
    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $raw_password = $_POST["password"];

    $password = password_hash($raw_password, PASSWORD_DEFAULT);

    $queryUsername = $db->tampilUsername($username);

    if(mysqli_num_rows($queryUsername) > 0){
        header("Location: login.php?pesan=usernameSudahTerdaftar");
        exit;
    } else {
        $query = $db->tambah_data_user($email, $username, $nama, $password);
    
        if($query){
            header("Location: login.php?pesan=daftarBerhasil");
        } else {
            header("Location: login.php?pesan=daftarGagal");
        }
    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style-login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Daftar Akun</title>
    <style>
        body{
            background-color: lightgray;
        }
    </style>
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card" style="width: 25rem; height: 28rem;">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="username">Username : </label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="nama">Nama : </label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password : </label>
                        <input type="password" class="form-control" name="password" id="password" minlength="8" placeholder="Masukkan Password" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="daftar">Buat Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>