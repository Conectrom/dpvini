<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo '<script>window.location.href = "./index.php?login_error=true";</script>';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="estilos/estilos.css">

<!-- Início da Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fff;">
    <img class="imagem" src="https://conectrom.com.br/wp-content/uploads/2021/06/conectrom-logo-v2.png">

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">Início<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Sobre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contato</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <p class="mb-0 mr-3">Olá, <?= $_SESSION['nama'] ?> </p>
            <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="location.href='index.php'">Sair</button>
        </form>
    </div>
</nav>