<?php
session_start();

include "../koneksi.php";

$id_usuario = $_SESSION['id_usuarios'];

function clear($input, $koneksi)
{
    if (!$koneksi || !$koneksi->ping()) {
        return $var = null;
    }

    $var = mysqli_real_escape_string($koneksi, $input);
    $var = htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
    return $var;
}

$filtro_text = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/i";
$filtro_text2 = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+[0-9]*[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/i";
$filtro_instrucao = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+[\-]*$/i";
$filtro_date = "/^\d{4}\-\d{2}\-\d{2}$/";
$filtro_sangue = "/^(A|B|AB|O)[\+-]$/";
$filtro_num = "/^[0-9]+[\-.(]*[0-9]+$/i";
$filtro_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$filtro_celular = "/^\(*\d{2}\)*\s(\d){4,5}-+\d{4}$/";
$filtro_agencia = "/^[a-zA-Z0-9.\- ]+$/";
$filtro_complemento = "/^[\wÀ-ÖØ-öø-ÿ\s,.]+$/i";


if (isset($_POST['save_filiacao']) || isset($_POST['edit_filiacao'])) {

    $save_filiacao = array(
        'nome_trab' => clear($_POST['nome_trab'], $koneksi),
        'pai_trab' => clear($_POST['pai_trab'], $koneksi),
        'mae_trab' => clear($_POST['mae_trab'], $koneksi),
        'dt_nascimento_trab' => clear($_POST['dt_nascimento_trab'], $koneksi),
        'cor_trab' => clear($_POST['cor_trab'], $koneksi),
        'sexo_trab' => clear($_POST['sexo_trab'], $koneksi),
        'nome_social_trab' => clear($_POST['nome_social_trab'], $koneksi),
        'deficiente_trab' => clear($_POST['deficiencia'], $koneksi),
        'tipo_deficiencia_trab' => clear($_POST['tipo_deficiencia_trab'], $koneksi),
        'nacionalidade_trab' => clear($_POST['nacionalidade_trab'], $koneksi),
        'chegada_brasil_trab' => clear($_POST['chegada_brasil_trab'], $koneksi),
        'naturalidade_trab' => clear($_POST['naturalidade_trab'], $koneksi),
        'estado_trab' => clear($_POST['estado_trab'], $koneksi)
    );

    $_SESSION['sexo_trab'] = $save_filiacao['sexo_trab'];

    foreach ($save_filiacao as $chave => $valor) {
        $_SESSION[$chave] = $valor;
    }

    foreach ($save_filiacao as $chave => $valor) {
        if ($chave != 'dt_nascimento_trab' && $chave != 'chegada_brasil_trab' && $chave != 'tipo_deficiencia_trab') {

            if ($chave == "naturalidade_trab") {
                if (empty($chave)) {
                    $teste[$chave] = 1;
                } else {
                    $teste[$chave] = preg_match($filtro_text, $valor);
                }
            } else {
                $teste[$chave] = preg_match($filtro_text, $valor);
            }
        } else if ($chave == 'tipo_deficiencia_trab') {
            if ($save_filiacao['deficiente_trab'] == 'Não') {
                $teste[$chave] = 1;
            } else {
                $teste[$chave] = preg_match($filtro_text, $valor);
            }
        } else {
            $teste[$chave] = preg_match($filtro_date, $valor);
        }
    }

    if (empty($save_filiacao['nome_social_trab'])) {
        $teste['nome_social_trab'] = 1;
    }

    if (empty($save_filiacao['naturalidade_trab'])) {
        $teste['naturalidade_trab'] = 1;
        $save_filiacao['naturalidade_trab'] = null;
    }

    if (empty($save_filiacao['chegada_brasil_trab'])) {
        $teste['chegada_brasil_trab'] = 1;
    }

    $tp_sangue = clear($_POST['tp_sangue'], $koneksi);
    $teste_sangue = preg_match($filtro_sangue, $tp_sangue);

    if (isset($_POST['save_filiacao'])) {

        $save_filiacao_string = implode(", ", array_keys($save_filiacao));

        foreach ($save_filiacao as $chave => $valor) {
            if ($valor === null || $valor === '') {
                $valores[] = 'NULL';
            } else {
                $valores[] = "'" . mysqli_real_escape_string($koneksi, $valor) . "'";
            }
        }
        $valores_para_sql = implode(", ", $valores);

        if (in_array(0, $teste) || in_array(false, $teste)) {
            foreach ($teste as $chave => $valor) {
                if ($valor == 0 || $valor == false) {
                    $mensagem[] = str_replace("_trab", "", $chave);
                }
            }
            $sql_filiacao1 = false;
            $stmt_filiacao1 = false;
        } else {
            $sql_filiacao1 = "INSERT INTO tb_trabalhador ($save_filiacao_string, id_usuario) VALUES ($valores_para_sql, $id_usuario)";
            $stmt_filiacao1 = mysqli_prepare($koneksi, $sql_filiacao1);
        }

        if ($stmt_filiacao1) {
            if ($teste_sangue) {
                $sql_sangue = "INSERT INTO tb_tp_sangue (tp_sangue, tb_trabalhador_id_trab) VALUES ('$tp_sangue', '$id_usuario')";
                $stmt_sangue = mysqli_prepare($koneksi, $sql_sangue);
            } else {
                $mensagem[] = "Sangue";
            }
        } else {
            echo '<script>window.location.href = "../home_user.php?insert_error";</script>';
        }

        if (empty($mensagem)) {
            $insert_filiacao1 = mysqli_stmt_execute($stmt_filiacao1);
            $insert_sangue = mysqli_stmt_execute($stmt_sangue);
            $directory = "../user_upload/";

            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            if (isset($_SESSION['nama'])) {
                $name = $_SESSION['nama'];
                $userDirectory = $directory . $name . "/";

                if (!file_exists($userDirectory)) {
                    mkdir($userDirectory, 0777, true);
                }
            }
        } else {
            echo '<script>window.location.href = "../home_user.php?insert_error";</script>';
        }

        if (isset($mensagem) && !empty($mensagem)) {
            $_SESSION['mensagem'] = $mensagem;
        } else {
            $_SESSION['mensagem'] = array();
            echo '<script>window.location.href = "../home_user.php?insert_sucess";</script>';
            foreach ($save_filiacao as $chave => $valor) {
                unset($_SESSION[$chave]);
            }
        }

        mysqli_close($koneksi);
    }
} else if (isset($_POST['save_filiacao2']) || isset($_POST['edit_filiacao2'])) {
    // tb_documentos
    $save_filiacao2_text = array(
        'dt_emissao_identidade' => clear($_POST['dt_emissao_identidade'], $koneksi),
        'habilitacao_categoria' => clear($_POST['habilitacao_categoria'], $koneksi),
        'orgao_identidade' => clear($_POST['orgao_identidade'], $koneksi),
        'dt_validade_habilitacao' => clear($_POST['data_cadastramento'], $koneksi),
        'registro_prof_orgao' => clear($_POST['registro_prof_orgao'], $koneksi),
        'nome_conta_corrente' => clear($_POST['nome_conta_corrente'], $koneksi),
        'conta_corrente' => clear($_POST['conta_corrente'], $koneksi),
        'agencia_conta_corrente' => clear($_POST['agencia_conta_corrente'], $koneksi),
        'data_cadastramento' => clear($_POST['data_cadastramento'], $koneksi),
        'data_opcao_fgts' => clear($_POST['data_opcao_fgts'], $koneksi),
        'banco_depositario_fgts' => clear($_POST['banco_depositario_fgts'], $koneksi),
        'habilitacao_radio' => clear($_POST['habilitacao'], $koneksi)
    );

    $save_filiacao2_num = array(
        'cpf_doc' => clear($_POST['cpf_doc'], $koneksi),
        'identidade_doc' => clear($_POST['identidade_doc'], $koneksi),
        'habilitacao_doc' => clear($_POST['habilitacao_doc'], $koneksi),
        'ctps_doc' => clear($_POST['ctps_doc'], $koneksi),
        'ctps_serie' => clear($_POST['ctps_serie'], $koneksi),
        'reservista' => clear($_POST['reservista'], $koneksi),
        'registro_prof' => clear($_POST['registro_prof'], $koneksi),
        'titulo_eleitor' => clear($_POST['titulo_eleitor'], $koneksi),
        'titulo_zona' => clear($_POST['titulo_zona'], $koneksi),
        'titulo_secao' => clear($_POST['titulo_secao'], $koneksi),
        'pis' => clear($_POST['pis'], $koneksi),
        'conta_fgts' => clear($_POST['conta_fgts'], $koneksi)
    );

    foreach ($save_filiacao2_text as $chave => $valor) {
        $_SESSION[$chave] = $valor;
    }

    foreach ($save_filiacao2_num as $chave => $valor) {
        $_SESSION[$chave] = $valor;
    }

    $save_filiacao_string2_text = implode(", ", array_keys($save_filiacao2_text));
    $valores_para_sql2_text = "'" . implode("', '", $save_filiacao2_text) . "'";

    $save_filiacao_string2_num = implode(", ", array_keys($save_filiacao2_num));
    $valores_para_sql2_num = "'" . implode("', '", $save_filiacao2_num) . "'";

    $grau_instrucao = clear($_POST['grau_instrucao'], $koneksi);
    $agencia_conta_corrente = clear($_POST['agencia_conta_corrente'], $koneksi);
    $tipo_estado_civil = clear($_POST['tipo_estado_civil'], $koneksi);
    $conta_corrente = clear($_POST['conta_corrente'], $koneksi);
    $teste_instrucao = preg_match($filtro_instrucao, $grau_instrucao);
    $teste_filiacao2['agencia_conta_corrente'] = preg_match($filtro_agencia, $agencia_conta_corrente);
    $teste_filiacao2['conta_corrente'] = preg_match($filtro_agencia, $conta_corrente);
    $teste_estado_civil = preg_match($filtro_text, $tipo_estado_civil);

    // foreach ($save_filiacao2_num as $chave => $valor) {
    //     if ($chave == 'habilitacao_doc') {
    //         $teste_filiacao2[$chave] = preg_match($filtro_num, $valor);
    //     } else {
    //         $teste_filiacao2[$chave] = preg_match($filtro_num, $valor);
    //     }
    // }

    if (empty($save_filiacao2_num['conta_fgts'])) {
        $teste_filiacao2['conta_fgts'] = 1;
    }

    if (empty($save_filiacao2_num['banco_depositario_fgts'])) {
        $teste_filiacao2['banco_depositario_fgts'] = 1;
    }

    if (empty($save_filiacao2_num['registro_prof'])) {
        $teste_filiacao2['registro_prof'] = 1;
    }

    if (empty($save_filiacao2_num['reservista']) && $_SESSION['sexo_trab'] == "Feminino") {
        $teste_filiacao2['reservista'] = 1;
    }

    if (isset($_POST['save_filiacao2'])) {
        if (in_array(0, $teste_filiacao2) || in_array(false, $teste_filiacao2)) {
            foreach ($teste_filiacao2 as $chave => $valor) {
                if ($valor == 0 || $valor == false) {
                    $mensagem[] = str_replace("_", " ", $chave);
                }
            }
            $sql_filiacao2 = false;
            $stmt_filiacao2 = false;
        } else {
            $sql_filiacao2 = "INSERT INTO tb_documentos ($save_filiacao_string2_text, $save_filiacao_string2_num, tb_documentos_id_trab)
            VALUES ($valores_para_sql2_text, $valores_para_sql2_num, $id_usuario)";
            $stmt_filiacao2 = mysqli_prepare($koneksi, $sql_filiacao2);
        }
    }

    // tb_endereco
    $save_filiacao3_text = array(
        'logradouro' => clear($_POST['logradouro'], $koneksi),
        'bairro' => clear($_POST['bairro'], $koneksi),
        'cidade' => clear($_POST['cidade'], $koneksi),
        'uf' => clear($_POST['uf'], $koneksi),
        'endereco_eletronico' => clear($_POST['endereco_eletronico'], $koneksi)
    );

    $save_filiacao3_num = array(
        'numero' => clear($_POST['numero'], $koneksi),
        'telefone_fixo' => clear($_POST['telefone_fixo'], $koneksi),
        'celular' => clear($_POST['celular'], $koneksi),
        'complemento' => clear($_POST['complemento'], $koneksi),
        'cep' => clear($_POST['cep'], $koneksi)
    );

    foreach ($save_filiacao3_text as $chave => $valor) {
        $_SESSION[$chave] = $valor;
    }

    foreach ($save_filiacao3_num as $chave => $valor) {
        $_SESSION[$chave] = $valor;
    }

    $complemento = $save_filiacao3_num['complemento'];

    foreach ($save_filiacao3_text as $chave => $valor) {

        if (empty($chave)) {
            $mensagem[] = str_replace("tp_", " ", $chave);
        } else {
            if ($chave != "endereco_eletronico" && $chave != "logradouro") {
                $teste_filiacao_3[$chave] = preg_match($filtro_text, $valor);
            } else if ($chave == "endereço_eletronico") {
                $teste_filiacao_3[$chave] = preg_match($filtro_email, $valor);
            } else if ($chave == "logradouro") {
                $teste_filiacao_3[$chave] = preg_match($filtro_text2, $valor);
            }
        }
    }

    foreach ($save_filiacao3_num as $chave => $valor) {

        if (empty($chave)) {
            $mensagem[] = str_replace("_", " ", $chave);
        } else {
            if ($chave != "telefone_fixo" && $chave != "celular" && $chave != "complemento") {
                $teste_filiacao_3[$chave] = preg_match($filtro_num, $valor);
            } else if ($chave == "complemento") {
                $teste_filiacao_3[$chave] = preg_match($filtro_complemento, $valor);
            } else {
                $teste_filiacao_3[$chave] = preg_match($filtro_celular, $valor);
            }
        }
    }

    if (empty($complemento)) {
        $teste_filiacao_3['complemento'] = 1;
    }

    if (isset($_POST['save_filiacao2'])) {

        $save_filiacao_string3_text = implode(", ", array_keys($save_filiacao3_text));
        $valores_para_sql3_text = "'" . implode("', '", $save_filiacao3_text) . "'";
        $save_filiacao_string3_num = implode(", ", array_keys($save_filiacao3_num));
        $valores_para_sql3_num = "'" . implode("', '", $save_filiacao3_num) . "'";

        if (in_array(0, $teste_filiacao_3) || in_array(false, $teste_filiacao_3)) {
            foreach ($teste_filiacao_3 as $chave => $valor) {
                if ($valor == 0 || $valor == false) {
                    $mensagem[] = str_replace("tp_", " ", $chave);
                }
            }
            $sql_filiacao3 = false;
            $stmt_filiacao3 = false;
        } else {
            $sql_filiacao3 = "INSERT INTO tb_endereco ($save_filiacao_string3_text, $save_filiacao_string3_num, tb_endereco_id_trab) VALUES ($valores_para_sql3_text, $valores_para_sql3_num, $id_usuario)";
            $stmt_filiacao3 = mysqli_prepare($koneksi, $sql_filiacao3);
        }

        if (empty($mensagem)) {

            if ($teste_filiacao_3['complemento']) {
                $sql_complemento = "INSERT INTO tb_complemento (tp_complemento, tp_complemento_id_trab) VALUES ('$complemento', '$id_usuario')";
                $stmt_complemento = mysqli_prepare($koneksi, $sql_complemento);
            }
            if ($teste_instrucao && !empty($grau_instrucao)) {
                $sql_instrucao = "INSERT INTO tb_grau (grau_instrucao, tb_grau_id_trab) VALUES ('$grau_instrucao', '$id_usuario')";
                $stmt_instrucao = mysqli_prepare($koneksi, $sql_instrucao);
            } else {
                $mensagem[] = "Grau de Instrução";
            }
            if ($teste_estado_civil && !empty($tipo_estado_civil)) {
                $sql_estado_civil = "INSERT INTO tb_estado_civil (tipo_estado_civil, tb_estado_civil_id_trab) VALUES ('$tipo_estado_civil', '$id_usuario')";
                $stmt_estado_civil = mysqli_prepare($koneksi, $sql_estado_civil);
            } else {
                $mensagem[] = "Estado Civil";
            }
        } else {
            $stmt_complemento = false;
            $stmt_instrucao = false;
            $stmt_estado_civil = false;
        }

        if ($stmt_filiacao2 && $stmt_filiacao3 && $stmt_complemento && $stmt_instrucao && $stmt_estado_civil) {
            $insert_filiacao2 = mysqli_stmt_execute($stmt_filiacao2);
            $insert_filiacao3 = mysqli_stmt_execute($stmt_filiacao3);
            $insert_complemento = mysqli_stmt_execute($stmt_complemento);
            $insert_instrucao = mysqli_stmt_execute($stmt_instrucao);
            $insert_estado_civil = mysqli_stmt_execute($stmt_estado_civil);
        } else {
            echo '<script>window.location.href = "../home_user.php?insert_error";</script>';
        }

        if (isset($mensagem) && !empty($mensagem)) {
            $_SESSION['mensagem'] = $mensagem;
        } else {
            $_SESSION['mensagem'] = array();
            echo '<script>window.location.href = "../home_user.php?insert_sucess";</script>';
        }

        mysqli_close($koneksi);
    }
}
