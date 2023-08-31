<?php
session_start();
include_once('koneksi.php');

$id_usuario_logado = $_SESSION['id_usuarios'];

$id_usuario_logado_escaped = mysqli_real_escape_string($koneksi, $id_usuario_logado);

$sql1 = "SELECT nome_trab, pai_trab, mae_trab, dt_nascimento_trab, cor_trab, sexo_trab, nome_social_trab, deficiente_trab, tipo_deficiencia_trab, nacionalidade_trab, chegada_brasil_trab, naturalidade_trab, estado_trab 
         FROM tb_trabalhador
         WHERE id_usuario = $id_usuario_logado";

$sql2 = "SELECT tp_sangue FROM tb_tp_sangue WHERE tb_trabalhador_id_trab = $id_usuario_logado";

$sql3 = "SELECT cpf_doc, identidade_doc, dt_emissao_identidade, orgao_identidade, habilitacao_doc, habilitacao_categoria, dt_validade_habilitacao, ctps_doc, ctps_serie, digito_fgts, reservista, registro_prof, registro_prof_orgao, conta_corrente, nome_conta_corrente, agencia_conta_corrente, titulo_eleitor, titulo_zona, titulo_secao, pis, data_cadastramento, conta_fgts, data_opcao_fgts, banco_depositario_fgts 
         FROM tb_documentos 
         WHERE tb_documentos_id_trab = $id_usuario_logado";

$sql4 = "SELECT logradouro, numero, complemento, bairro, cidade, uf, cep, endereco_eletronico, celular, telefone_fixo 
         FROM tb_endereco
         WHERE tb_endereco_id_trab = $id_usuario_logado";

$sql5 = "SELECT grau_instrucao FROM tb_grau
        WHERE tb_grau_id_trab = $id_usuario_logado";

$sql6 =  "SELECT tp_complemento FROM tb_complemento
          WHERE tp_complemento_id_trab = $id_usuario_logado";

$sql7 = "SELECT tipo_estado_civil FROM tb_estado_civil
         WHERE tb_estado_civil_id_trab = $id_usuario_logado";

$resultado1 = mysqli_query($koneksi, $sql1);
$resultado2 = mysqli_query($koneksi, $sql2);
$resultado3 = mysqli_query($koneksi, $sql3);
$resultado4 = mysqli_query($koneksi, $sql4);
$resultado5 = mysqli_query($koneksi, $sql5);
$resultado6 = mysqli_query($koneksi, $sql6);
$resultado7 = mysqli_query($koneksi, $sql7);

if (!$resultado1 || !$resultado2 || !$resultado3 || !$resultado4 || !$resultado5 || !$resultado6 || !$resultado7) {
    die('Erro na consulta: ' . mysqli_error($koneksi));
}

$dados_trabalhador = mysqli_fetch_assoc($resultado1);
$dados_trabalhador['tp_sangue'] = mysqli_fetch_assoc($resultado2);
$dados_trabalhador['documentos'] = mysqli_fetch_assoc($resultado3);
$dados_trabalhador['endereco'] = mysqli_fetch_assoc($resultado4);
$dados_trabalhador['grau'] = mysqli_fetch_assoc($resultado5);
$dados_trabalhador['complemento'] = mysqli_fetch_assoc($resultado6);
$dados_trabalhador['estado'] = mysqli_fetch_assoc($resultado7);

$string_json = json_encode($dados_trabalhador);

header('Content-Type: application/json');

echo $string_json;

mysqli_close($koneksi);
