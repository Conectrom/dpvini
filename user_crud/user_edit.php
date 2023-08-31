<?php

include_once '../user_crud/user_inserir.php';
if (!$koneksi) {
      include("../koneksi.php");
}

if (isset($_POST['edit_filiacao'])) {
      // Primeiro botão (edit_filiacao) foi acionado, faça o update na tabela tb_trabalhador

      foreach ($save_filiacao as $chave => $valor) {
            if ($chave == 'chegada_brasil_trab') {
                  if ($valor === '') {
                        $edit_filiacao_string[] = $chave . " = NULL";
                  } else {
                        $edit_filiacao_string[] = $chave . " = '" . date('Y-m-d', strtotime(clear($valor, $koneksi))) . "'";
                  }
            } else if ($chave != 'dt_nascimento_trab') {
                  $edit_filiacao_string[] = $chave . " = '" . clear($valor, $koneksi) . "'";
            } else {
                  $edit_filiacao_string[] = $chave . " = '" . date('Y-m-d', strtotime(clear($valor, $koneksi))) . "'";
            }
      }

      $edit_filiacao_string2 = implode(", ", $edit_filiacao_string);

      if (in_array(0, $teste) || in_array(false, $teste)) {
            foreach ($teste as $chave => $valor) {
                  if ($valor == 0 || $valor == false) {
                        $mensagem[] = str_replace("_trab", "", $chave);
                  }
            }
            $sql_edit1 = false;
            $stmt_edit1 = false;
            $sql_edit_sangue = false;
            $stmt_edit_sangue = false;
      } else {
            $sql_edit1 = "UPDATE tb_trabalhador SET $edit_filiacao_string2 WHERE id_usuario='$id_usuario'";
            $stmt_edit1 = mysqli_prepare($koneksi, $sql_edit1);
            $sql_edit_sangue = "UPDATE tb_tp_sangue SET tp_sangue='$tp_sangue' WHERE tb_trabalhador_id_trab='$id_usuario'";
            $stmt_edit_sangue = mysqli_prepare($koneksi, $sql_edit_sangue);
      }

      if (!$stmt_edit_sangue) {
            $mensagem[] = "Sangue";
      }

      if ($stmt_edit1 || $stmt_edit_sangue) {
            $edit_filiacao1 = mysqli_stmt_execute($stmt_edit1);
            $edit_sangue = mysqli_stmt_execute($stmt_edit_sangue);
      } else {
            echo '<script>window.location.href = "../home_user.php?insert_error";</script>';
      }

      if (isset($mensagem) && !empty($mensagem)) {
            $_SESSION['mensagem'] = $mensagem;
      } else {
            $_SESSION['mensagem'] = array();
            echo '<script>window.location.href = "../home_user.php?insert_sucess";</script>';
      }
} else if (isset($_POST['edit_filiacao2'])) {
      // Segundo botão (edit_filiacao2) foi acionado, faça o update em outra tabela

      foreach ($save_filiacao2_text as $chave => $valor) {
            if ($chave == 'dt_validade_habilitacao') {
                  if ($valor === '') {
                        $edit_filiacao2_string2[] = $chave . " = NULL";
                  } else {
                        $edit_filiacao2_string2[] = $chave . " = '" . date('Y-m-d', strtotime(clear($valor, $koneksi))) . "'";
                  }
            } else if ($chave != 'dt_emissao_identidade' && $chave != 'data_cadastramento' && $chave != 'data_opcao_fgts') {
                  $edit_filiacao2_string2[] = $chave . " = '" . clear($valor, $koneksi) . "'";
            } else {
                  $edit_filiacao2_string2[] = $chave . " = '" . date('Y-m-d', strtotime(clear($valor, $koneksi))) . "'";
            }
      }
      $edit_filiacao2_string_docs_t = implode(", ", $edit_filiacao2_string2);

      foreach ($save_filiacao2_num as $chave => $valor) {
            $edit_filiacao2_string3[] = $chave . "='" . clear($valor, $koneksi) . "'";
      }
      $edit_filiacao2_string_doc_n = implode(", ", $edit_filiacao2_string3);

      if (in_array(0, $teste_filiacao2) || in_array(false, $teste_filiacao2)) {
            foreach ($teste_filiacao2 as $chave => $valor) {
                  if ($valor == 0 || $valor == false) {
                        $mensagem[] = str_replace("_", " ", $chave);
                  }
            }
            $sql_edit2 = false;
            $stmt_edit2 = false;
      } else {
            $sql_edit2 = "UPDATE tb_documentos SET $edit_filiacao2_string_docs_t, $edit_filiacao2_string_doc_n WHERE tb_documentos_id_trab='$id_usuario'";
            $stmt_edit2 = mysqli_prepare($koneksi, $sql_edit2);
      }

      foreach ($save_filiacao3_text as $chave => $valor) {
            $edit_filiacao2_string4[] = $chave . "='" . clear($valor, $koneksi) . "'";
      }
      $edit_filiacao3_string_doc_t = implode(", ", $edit_filiacao2_string4);

      foreach ($save_filiacao3_num as $chave => $valor) {
            $edit_filiacao2_string5[] = $chave . "='" . clear($valor, $koneksi) . "'";
      }
      $edit_filiacao3_string_doc_n = implode(", ", $edit_filiacao2_string5);

      if (in_array(0, $teste_filiacao_3) || in_array(false, $teste_filiacao_3)) {
            foreach ($teste_filiacao_3 as $chave => $valor) {
                  if ($valor == 0 || $valor == false) {
                        $mensagem[] = str_replace("tp_", " ", $chave);
                  }
            }
            $sql_edit3 = false;
            $stmt_edit3 = false;
      } else {
            $sql_edit3 = "UPDATE tb_endereco SET $edit_filiacao3_string_doc_t, $edit_filiacao3_string_doc_n WHERE tb_endereco_id_trab='$id_usuario'";
            $stmt_edit3 = mysqli_prepare($koneksi, $sql_edit3);
      }

      if (empty($mensagem)) {

            if ($teste_filiacao_3['complemento']) {
                  $sql_complemento_edit = "UPDATE tb_complemento SET tp_complemento='$complemento' WHERE tp_complemento_id_trab='$id_usuario'";
                  $stmt_complemento_edit = mysqli_prepare($koneksi, $sql_complemento_edit);
            }
            if ($teste_instrucao && !empty($grau_instrucao)) {
                  $sql_instrucao_edit = "UPDATE tb_grau SET grau_instrucao='$grau_instrucao' WHERE tb_grau_id_trab='$id_usuario'";
                  $stmt_instrucao_edit = mysqli_prepare($koneksi, $sql_instrucao_edit);
            } else {
                  $mensagem[] = "Grau de Instrução";
            }
            if ($teste_estado_civil && !empty($tipo_estado_civil)) {
                  $sql_estado_civil_edit = "UPDATE tb_estado_civil SET tipo_estado_civil='$tipo_estado_civil' WHERE tb_estado_civil_id_trab='$id_usuario'";
                  $stmt_estado_civil_edit = mysqli_prepare($koneksi, $sql_estado_civil_edit);
            } else {
                  $mensagem[] = "Estado Civil";
            }
      } else {
            $stmt_complemento_edit = false;
            $stmt_instrucao_edit = false;
            $stmt_estado_civil_edit = false;
            // echo "erro 1";
      }

      if ($stmt_edit2 && $stmt_edit3 && $stmt_complemento_edit && $stmt_instrucao_edit && $stmt_estado_civil_edit) {
            $insert_filiacao2 = mysqli_stmt_execute($stmt_edit2);
            $insert_filiacao3 = mysqli_stmt_execute($stmt_edit3);
            $insert_complemento = mysqli_stmt_execute($stmt_complemento_edit);
            $insert_instrucao = mysqli_stmt_execute($stmt_instrucao_edit);
            $insert_estado_civil = mysqli_stmt_execute($stmt_estado_civil_edit);
            echo '<script>window.location.href = "../home_user.php";</script>';
      } else {
            echo '<script>window.location.href = "../home_user.php?insert_error";</script>';
            // echo "Erro 2";
      }

      if (isset($mensagem) && !empty($mensagem)) {
            $_SESSION['mensagem'] = $mensagem;
      } else {
            $_SESSION['mensagem'] = array();
            echo '<script>window.location.href = "../home_user.php";</script>';
            // echo "Erro 3";
      }

      mysqli_close($koneksi);
}
