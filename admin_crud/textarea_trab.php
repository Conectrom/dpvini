<?php
session_start();
// var_dump($_POST);
include('../koneksi.php');

$usuario = $_POST['trabalhador_id'];
$observacao = $_POST['campotexto'];


if (isset($_POST['campotexto'])) {

    $sql = "SELECT * FROM tb_observacao WHERE tb_observacao_id_trab = $usuario";
    $result = $koneksi->query($sql);

    // Verifica se existem resultados
    if ($result->num_rows > 0) {
        $existeObservacao = true;
    } else {
        $existeObservacao = false;
    }

    // Utilize a variável $existeObservacao como desejar
    if ($existeObservacao) {
        // echo "O usuário possui observações na tabela.";

        $sql = "UPDATE tb_observacao SET observacao = '$observacao' WHERE tb_observacao_id_trab = $usuario";

        if ($koneksi->query($sql) === TRUE) {
            // echo "Dados atualizados com sucesso.";
            header("Location: ../home_admin.php");
        } else {
            echo "Erro ao atualizar os dados: " . $koneksi->error;
        }
    } else if (!$existeObservacao) {
        echo "O usuário não possui observações na tabela.";

        $sql = "INSERT INTO tb_observacao (observacao, tb_observacao_id_trab) VALUES 
      ('$observacao', '$usuario')";


        // Executa a consulta SQL
        if ($koneksi->query($sql) === TRUE) {
            // Inserção bem-sucedida
            // echo "Dados inseridos com sucesso.";
            header("Location: ../home_admin.php");
        } else {
            // Erro na inserção
            echo "Erro ao inserir os dados: " . $koneksi->error;
        }
    }
    // Fecha a conexão com o banco de dados
    $koneksi->close();
}
