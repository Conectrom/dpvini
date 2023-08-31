<?php
session_start();
include_once('koneksi.php');

// Obtém o ID do usuário logado
$id_usuario_logado = $_SESSION['id_usuarios'];
// Consulta SQL para verificar se o ID do usuário logado está na tabela de trabalhadores
$id_usuario_logado_escaped = mysqli_real_escape_string($koneksi, $id_usuario_logado);
$sql = "SELECT COUNT(*) FROM tb_trabalhador
        JOIN tb_login ON tb_trabalhador.id_usuario = tb_login.id_usuarios
        WHERE tb_trabalhador.id_usuario = '$id_usuario_logado_escaped'";
$resultado = mysqli_query($koneksi, $sql);

// Verifica se houve erro na consulta SQL
if (!$resultado) {
  die('Erro na consulta: ' . mysqli_error($koneksi));
}

// Obtém o número de linhas do resultado
$num_linhas = mysqli_fetch_array($resultado)[0];

// Cria um objeto JSON com o estado do botão
$objeto_json = array('botao_desabilitado' => ($num_linhas == 1));

// Converte o objeto JSON para uma string
$string_json = json_encode($objeto_json);

// Define o cabeçalho HTTP para indicar que o conteúdo é JSON
header('Content-Type: application/json');

// Imprime a string JSON
echo $string_json;

// Fecha a conexão com o banco de dados
mysqli_close($koneksi);
