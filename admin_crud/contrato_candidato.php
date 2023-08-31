<?php
// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Verifica se o campo 'trabalhador_id' está presente no formulário
  if (isset($_POST['trabalhador_id'])) {
    $trabalhador_id = $_POST['trabalhador_id'];

    // Verifica se os demais campos foram preenchidos (adapte de acordo com o seu formulário)
    if (isset($_POST['dt_admissao']) && isset($_POST['dt_registro'])) {
      $dt_admissao = $_POST['dt_admissao'];
      $dt_registro = $_POST['dt_registro'];

      $funcao = $_POST['funcao'];
      $cbo = $_POST['cbo'];
      $salario_inicial = $_POST['salario_inicial'];
      $forma_pagamento = $_POST['forma_pagamento'];
      $tipo_pagamento = $_POST['tipo_pagamento'];
      $insalubrida = $_POST['insalubrida'];
      $periculosidade = $_POST['periculosidade'];
      $comissao = $_POST['comissao'];
      $categoria = $_POST['categoria'];
      $sindicato = $_POST['sindicato'];
      $centro_custo = $_POST['centro_custo'];
      $localizacao = $_POST['localizacao'];
      $horario = $_POST['horario'];


      // echo $trabalhador_id;
      // echo $dt_admissao;
      // echo $dt_registro;

      require_once '../koneksi.php'; // Arquivo de conexão com o banco de dados

      // Consulta SQL para inserir os dados na tabela tb_contrato
      $sql = "INSERT INTO tb_contrato (dt_admissao, dt_registro, funcao, cbo, salario_inicial, forma_pagamento, tipo_pagamento, insalubrida, periculosidade, comissao, categoria, sindicato, centro_custo, localizacao, horario, tb_contrato_id_trab) VALUES 
      ('$dt_admissao', '$dt_registro', '$funcao', '$cbo', '$salario_inicial', '$forma_pagamento', '$tipo_pagamento', '$insalubrida', '$periculosidade', '$comissao', '$categoria', '$sindicato', '$centro_custo', '$localizacao', '$horario', '$trabalhador_id')";
      

      // Executa a consulta SQL
      if ($koneksi->query($sql) === TRUE) {
        // Inserção bem-sucedida
        // echo "Dados inseridos com sucesso.";
        header("Location: ../home_admin.php");
      } else {
        // Erro na inserção
        echo "Erro ao inserir os dados: " . $koneksi->error;
      }

      // Fecha a conexão com o banco de dados
      $koneksi->close();
    } else {
      // Campos obrigatórios não foram preenchidos
      echo "Por favor, preencha todos os campos obrigatórios.";
    }
  } else {
    // O campo 'trabalhador_id' não foi enviado
    echo "O ID do trabalhador não foi fornecido.";
  }
} else {
  // O formulário não foi submetido corretamente
  echo "O formulário não foi enviado.";
}
