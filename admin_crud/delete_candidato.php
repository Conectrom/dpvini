<?php
include('../koneksi.php');

if (isset($_POST['delete_candidato'])) {
    $id_trabalhador = $_POST['delete_candidato'];
    
    $sql_insert_ben = "DELETE FROM tb_trabalhador WHERE id_trab = '$id_trabalhador'";
    // echo "deu certo";
    // echo $id_trabalhador;
    header("Location: ../home_admin.php");

    if (mysqli_query($koneksi, $sql_insert_ben)) {

        echo "Teste";
    } else {
        echo "O diretório do beneficiário '$directory' não existe.<br>";
    }
} else {
    echo "Você não realizou uma operação de delete.";
}
