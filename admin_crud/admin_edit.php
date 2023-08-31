<?php
session_start();

include "../koneksi.php";
// $id_usuario = $_POST['trabalhador_id_1']; // ID do usuário
// $id_usuario = $_POST['trabalhador_id_2']; // ID do usuário
// $id_usuario = $_POST['trabalhador_id_3']; // ID do usuário
// $id_usuario = $_POST['trabalhador_id_4']; // ID do usuário
// var_dump($_POST);

if (isset($_POST['edit_filiacao'])) {
      $id_usuario = $_POST['trabalhador_id_1']; // ID do usuário

      $fieldsToUpdate = array(
            'nome_trab' => $_POST['nome_trab'],
            'pai_trab' => $_POST['pai_trab'],
            'mae_trab' => $_POST['mae_trab'],
            'dt_nascimento_trab' => $_POST['dt_nascimento_trab'],
            'cor_trab' => $_POST['cor_trab'],
            'sexo_trab' => $_POST['sexo_trab'],
            'nome_social_trab' => $_POST['nome_social_trab'],
            'deficiente_trab' => $_POST['deficiente_trab'],
            'tipo_deficiencia_trab' => $_POST['tipo_deficiencia_trab'],
            'nacionalidade_trab' => $_POST['nacionalidade_trab'],
            'chegada_brasil_trab' => $_POST['chegada_brasil_trab'],
            'naturalidade_trab' => $_POST['naturalidade_trab'],
            'estado_trab' => $_POST['estado_trab'],
      );

      if (!empty(array_filter($fieldsToUpdate))) {

            $set_clause = "SET ";
            foreach ($fieldsToUpdate as $field => $value) {
                  if (!empty($value)) {
                        $set_clause .= "$field='$value', ";
                  }
            }

            $set_clause = rtrim($set_clause, ', ');

            $sql = "UPDATE tb_trabalhador $set_clause WHERE id_usuario='$id_usuario'";

            if (mysqli_query($koneksi, $sql)) {
                  // echo "Record updated successfully";
                  header("Location: ../home_admin.php");
            } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
            }
      }

      if (isset($_POST['tp_sangue']) && !empty($_POST['tp_sangue'])) {
            $sql2 = "UPDATE tb_tp_sangue SET tp_sangue='{$_POST['tp_sangue']}' WHERE tb_trabalhador_id_trab='$id_usuario'";

            if (mysqli_query($koneksi, $sql2)) {
                  // echo "Record updated successfully";
                  header("Location: ../home_admin.php");
            } else {
                  echo "Error: " . $sql2 . "<br>" . mysqli_error($koneksi);
            }
      }
}

// ----------------------------------------------------------------------------------

if (isset($_POST['edit_documentos'])) {
      $id_usuario = $_POST['trabalhador_id_2']; // ID do usuário

      $fieldsToUpdate = array(
            'cpf_doc' => $_POST['cpf_doc'],
            'identidade_doc' => $_POST['identidade_doc'],
            'dt_emissao_identidade' => $_POST['dt_emissao_identidade'],
            'orgao_identidade' => $_POST['orgao_identidade'],
            'habilitacao_doc' => $_POST['habilitacao_doc'],
            'habilitacao_categoria' => $_POST['habilitacao_categoria'],
            'habilitacao_radio' => $_POST ['habilitacao_radio'],
            'dt_validade_habilitacao' => $_POST['dt_validade_habilitacao'],
            'ctps_doc' => $_POST['ctps_doc'],
            'ctps_serie' => $_POST['ctps_serie'],
            'digito_fgts' => $_POST['digito_fgts'],
            'reservista' => $_POST['reservista'],
            'registro_prof' => $_POST['registro_prof'],
            'registro_prof_orgao' => $_POST['registro_prof_orgao'],
            'conta_corrente' => $_POST['conta_corrente'],
            'nome_conta_corrente' => $_POST['nome_conta_corrente'],
            'agencia_conta_corrente' => $_POST['agencia_conta_corrente'],
            'titulo_eleitor' => $_POST['titulo_eleitor'],
            'titulo_zona' => $_POST['titulo_zona'],
            'titulo_secao' => $_POST['titulo_secao'],
            'pis' => $_POST['pis'],
            'data_cadastramento' => $_POST['data_cadastramento'],
            'conta_fgts' => $_POST['conta_fgts'],
            'data_opcao_fgts' => $_POST['data_opcao_fgts'],
            'banco_depositario_fgts' => $_POST['banco_depositario_fgts'],
      );

      if (!empty(array_filter($fieldsToUpdate))) {

            $set_clause = "SET ";
            foreach ($fieldsToUpdate as $field => $value) {
                  if (!empty($value)) {
                        $set_clause .= "$field='$value', ";
                  }
            }

            $set_clause = rtrim($set_clause, ', ');

            $sql = "UPDATE tb_documentos $set_clause WHERE tb_documentos_id_trab='$id_usuario'";

            if (mysqli_query($koneksi, $sql)) {
                  // echo "Record updated successfully";
                  header("Location: ../home_admin.php");
            } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
            }
      }

      if (isset($_POST['grau_instrucao']) && !empty($_POST['grau_instrucao'])) {
            $sql2 = "UPDATE tb_grau SET grau_instrucao='{$_POST['grau_instrucao']}' WHERE tb_grau_id_trab='$id_usuario'";

            if (mysqli_query($koneksi, $sql2)) {
                  // echo "Record updated successfully";
                  header("Location: ../home_admin.php");
            } else {
                  echo "Error: " . $sql2 . "<br>" . mysqli_error($koneksi);
            }
      }

      if (isset($_POST['tipo_estado_civil']) && !empty($_POST['tipo_estado_civil'])) {
            $sql3 = "UPDATE tb_estado_civil SET tipo_estado_civil='{$_POST['tipo_estado_civil']}' WHERE tb_estado_civil_id_trab='$id_usuario'";

            if (mysqli_query($koneksi, $sql3)) {
                  // echo "Record updated successfully";
                  header("Location: ../home_admin.php");
            } else {
                  echo "Error: " . $sql3 . "<br>" . mysqli_error($koneksi);
            }
      }
}

if (isset($_POST['edit_endereco'])) {
      $id_usuario = $_POST['trabalhador_id_3']; // ID do usuário

      $fieldsToUpdate = array(
            'logradouro' => $_POST['logradouro'],
            'numero' => $_POST['numero'],
            // 'complemento' => $_POST['complemento'],
            'bairro' => $_POST['bairro'],
            'cidade' => $_POST['cidade'],
            'uf' => $_POST['uf'],
            'cep' => $_POST['cep'],
            'endereco_eletronico' => $_POST['endereco_eletronico'],
            'celular' => $_POST['celular'],
            'telefone_fixo' => $_POST['telefone_fixo'],
      );

      if (!empty(array_filter($fieldsToUpdate))) {

            $set_clause = "SET ";
            foreach ($fieldsToUpdate as $field => $value) {
                  if (!empty($value)) {
                        $set_clause .= "$field='$value', ";
                  }
            }

            $set_clause = rtrim($set_clause, ', ');

            $sql = "UPDATE tb_endereco $set_clause WHERE tb_endereco_id_trab='$id_usuario'";

            if (mysqli_query($koneksi, $sql)) {
                  // echo "Record updated successfully";
                  header("Location: ../home_admin.php");
            } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
            }
      }

      if (isset($_POST['tp_complemento']) && !empty($_POST['tp_complemento'])) {
            $sql2 = "UPDATE tb_complemento SET tp_complemento='{$_POST['tp_complemento']}' WHERE tp_complemento_id_trab='$id_usuario'";

            if (mysqli_query($koneksi, $sql2)) {
                  // echo "Record updated successfully";
                  header("Location: ../home_admin.php");
            } else {
                  echo "Error: " . $sql2 . "<br>" . mysqli_error($koneksi);
            }
      }
}

if (isset($_POST['edit_contrato'])) {
      $id_usuario = $_POST['trabalhador_id_4']; // ID do usuário

      $fieldsToUpdate = array(
            'dt_admissao' => $_POST['dt_admissao'],
            'dt_registro' => $_POST['dt_registro'],
            'funcao' => $_POST['funcao'],
            'cbo' => $_POST['cbo'],
            'salario_inicial' => $_POST['salario_inicial'],
            'forma_pagamento' => $_POST['forma_pagamento'],
            'tipo_pagamento' => $_POST['tipo_pagamento'],
            'insalubrida' => $_POST['insalubrida'],
            'periculosidade' => $_POST['periculosidade'],
            'comissao' => $_POST['comissao'],
            'categoria' => $_POST['categoria'],
            'sindicato' => $_POST['sindicato'],
            'centro_custo' => $_POST['centro_custo'],
            'localizacao' => $_POST['localizacao'],
            'horario' => $_POST['horario'],
      );

      if (!empty(array_filter($fieldsToUpdate))) {

            $set_clause = "SET ";
            foreach ($fieldsToUpdate as $field => $value) {
                  if (!empty($value)) {
                        $set_clause .= "$field='$value', ";
                  }
            }

            $set_clause = rtrim($set_clause, ', ');

            $sql = "UPDATE tb_contrato $set_clause WHERE tb_contrato_id_trab='$id_usuario'";

            if (mysqli_query($koneksi, $sql)) {
                  // echo "Record updated successfully";
                  header("Location: ../home_admin.php");
            } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
            }
      }
}
