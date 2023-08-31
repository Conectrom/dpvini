<?php
session_start();
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['userID'])) {
        $userID = $_GET['userID'];
        $sql7 = "SELECT dt_admissao, dt_registro, funcao, cbo, salario_inicial, forma_pagamento, tipo_pagamento, insalubrida, periculosidade, comissao, categoria, sindicato, centro_custo, localizacao, horario FROM tb_contrato WHERE tb_contrato_id_trab = $userID";
    } else {
        $userID = $_SESSION['id_usuarios'];
        $sql7 = ""; // Defina a consulta como vazia, pois não deseja executar o $sql7
    }

    $sql1 = "SELECT nome_trab, pai_trab, mae_trab, dt_nascimento_trab, cor_trab, sexo_trab, nome_social_trab, deficiente_trab, tipo_deficiencia_trab, nacionalidade_trab, chegada_brasil_trab, naturalidade_trab, estado_trab FROM tb_trabalhador WHERE id_usuario = $userID";
    $sql2 = "SELECT cpf_doc, identidade_doc, dt_emissao_identidade, orgao_identidade, habilitacao_doc, habilitacao_categoria, habilitacao_radio, dt_validade_habilitacao, ctps_doc, ctps_serie, digito_fgts, reservista, registro_prof, registro_prof_orgao, conta_corrente, nome_conta_corrente, agencia_conta_corrente, titulo_eleitor, titulo_zona, titulo_secao, pis, data_cadastramento, conta_fgts, data_opcao_fgts, banco_depositario_fgts FROM tb_documentos WHERE tb_documentos_id_trab = $userID";
    $sql3 = "SELECT logradouro, numero, complemento, bairro, cidade, uf, cep, endereco_eletronico, celular, telefone_fixo FROM tb_endereco WHERE tb_endereco_id_trab = $userID";
    $sql4 = "SELECT tp_complemento FROM tb_complemento WHERE tp_complemento_id_trab = $userID";
    $sql5 = "SELECT tp_sangue FROM tb_tp_sangue WHERE tb_trabalhador_id_trab = $userID";
    $sql6 = "SELECT grau_instrucao FROM tb_grau WHERE tb_grau_id_trab = $userID";
    $sql8 = "SELECT tipo_estado_civil FROM tb_estado_civil WHERE tb_estado_civil_id_trab = $userID";

    $result1 = $koneksi->query($sql1);
    $result2 = $koneksi->query($sql2);
    $result3 = $koneksi->query($sql3);
    $result4 = $koneksi->query($sql4);
    $result5 = $koneksi->query($sql5);
    $result6 = $koneksi->query($sql6);
    $result8 = $koneksi->query($sql8);

    $userData1 = ($result1->num_rows > 0) ? $result1->fetch_assoc() : array();
    $userData2 = ($result2->num_rows > 0) ? $result2->fetch_assoc() : array();
    $userData3 = ($result3->num_rows > 0) ? $result3->fetch_assoc() : array();
    $userData4 = ($result4->num_rows > 0) ? $result4->fetch_assoc() : array();
    $userData5 = ($result5->num_rows > 0) ? $result5->fetch_assoc() : array();
    $userData6 = ($result6->num_rows > 0) ? $result6->fetch_assoc() : array();
    $userData8 = ($result8->num_rows > 0) ? $result8->fetch_assoc() : array();

    $combinedData = array_merge($userData1, $userData2, $userData3, $userData4, $userData5, $userData6, $userData8);

    if ($sql7 !== "") {
        $result7 = $koneksi->query($sql7);
        $userData7 = ($result7->num_rows > 0) ? $result7->fetch_assoc() : array();
        $combinedData = array_merge($combinedData, $userData7);
    }

    if (json_encode($combinedData) == "[]") {
        echo "null";

    }

    else {
        echo json_encode($combinedData);
    }
    exit();
}
?>
