<?php
include('../koneksi.php');
var_dump($_POST);

if (isset($_POST['mostrar_candidato'])) {
    $id_trabalhador = $_POST['mostrar_candidato'];

    $sql = "SELECT * FROM tb_trabalhador WHERE id_usuario = $id_trabalhador";

    echo "deu certo";
    echo $id_trabalhador;

    if ($resultado = mysqli_query($koneksi, $sql)) {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<li>{$row['nome_trab']}</li>";
        }
        echo "</ul>";
    } else {
        echo "Ocorreu um erro na consulta SQL: " . mysqli_error($koneksi);
    }
} else {
    echo "Você não realizou uma operação de mostrar candidato.";
}
