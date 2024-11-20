<?php
include("db.php");

session_start();
$db = new Database();

if(isset($_SESSION['username']) || isset($_SESSION['id_users'])){
    // Jika sudah login, arahkan ke halaman admin jika role adalah 'admin'
    if ($_SESSION['status_user'] == 'admin') {
        header("location: admin/index.php");
    } else {
        header("location: landing/beranda.php");
    }
} else {
    if(isset($_POST['login'])){
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        if(!empty(trim($username)) && !empty(trim($password))){
            $query = $db->tampilUsername($username);

            if($query){
                $rows = mysqli_num_rows($query);
            } else {
                $rows = 0;
            }

            if($rows != 0){
                $getData = mysqli_fetch_assoc($query);

                if(password_verify($password, $getData['pass'])){
                    // Set session
                    $_SESSION['username'] = $username;
                    $_SESSION['id_user'] = $getData['id_user'];
                    $_SESSION['status_user'] = $getData['status_user'];

                    // Redirect based on role
                    if ($_SESSION['status_user'] == 'admin') {
                        header("location: admin/index.php");
                    } else {
                        header("location: landing/beranda.php");
                    }
                } else {
                    header("location: login.php?pesan=gagal");
                }
            } else {
                header("location: login.php?pesan=notfound");
            }
        } else {
            header("location: login.php?pesan=empty");
        }
    } else {
        header("location: login.php?pesan=empty");
    } 
}
?>
