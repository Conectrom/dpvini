<?php
session_start();
include_once('koneksi.php');

if (isset($_POST['user'], $_POST['password'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['user']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $password_hash = sha1($password);

    $sql = "SELECT * FROM tb_login WHERE user='$user' AND password='$password_hash'";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) == 1) {
        // Autenticação bem-sucedida, redirecionar para a página
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row['user'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['id_usuarios'] = $row['id_usuarios'];
        if ($row['level'] == "Admin") {
            header("Location: home_admin.php");
            exit;
        } else if ($row['level'] == "user") {
            header("Location: home_user.php");
            exit;
        }
    } else {
        header("Location: index.php?login_error=true");
        exit;
    }
}
