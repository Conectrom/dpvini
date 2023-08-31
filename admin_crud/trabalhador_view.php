<?php
require_once 'koneksi.php'; // Arquivo de conexão com o banco de dados

// Consulta SQL para selecionar todos os registros da tabela tb_trabalhador
$sql = "SELECT * FROM tb_trabalhador";

// Executa a consulta SQL usando o método query do objeto mysqli
$resultado = $koneksi->query($sql);

// Verifica se a consulta retornou algum resultado
if ($resultado && $resultado->num_rows > 0) {
  // Início da tabela HTML com classes do Bootstrap
  echo "<table class='table table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sexo</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>";

  // Loop para percorrer os resultados da consulta
  while ($row = $resultado->fetch_assoc()) {
    // Imprime os dados em uma linha da tabela HTML
    if ($row['envio_trab'] === "1") {
      $status = "Encerrado";
    }
    else {
      $status = "Aberto";
    }
    echo "<tr" . ($status == "Encerrado" ? " style='background-color: #dcf2de;'" : "") . ">";
    echo "<td>{$row['id_trab']}</td>";
    echo "<td>{$row['nome_trab']}</td>";
    echo "<td>{$row['sexo_trab']}</td>";
    echo "<td><p class='font-weight-bold'>$status</p></td>
        <td style='padding: 10px 0;'>
            <div class='btn-group'>
                <form method='POST'>
                    <button id='botao' type='submit' name='mostrar_candidato' class='btn btn-primary' href='admin_crud/user_data.php' value='{$row['id_usuario']}' formaction='admin_crud/user_data.php'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                            <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                            <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                        </svg> Mostrar
                    </button>
                </form>
                <form method='POST'>
                    <button id='botao' type='submit' name='arquivo_candidato' class='btn btn-info' href='admin_crud/user_data.php' value='{$row['id_usuario']}' formaction='admin_crud/arquivos_candidato.php'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-download' viewBox='0 0 16 16'>
                            <path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>
                            <path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>
                        </svg> Baixar
                    </button>
                </form>
                <button id='botao' type='submit' name='view' class='btn btn-success' data-toggle='modal' data-target='.modaluser' data-id='{$row['id_usuario']}'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                    </svg> Contrato
                </button>
                <button id='botao' type='submit' name='view' class='btn btn-dark' data-toggle='modal' data-target='.modalinfo' data-id='{$row['id_usuario']}'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-info-circle' viewBox='0 0 16 16'>
                        <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
                        <path d='m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z'/>
                    </svg> Info
                </button>
            </div>
            <div class='btn-group'>
            <button class='btn btn-secondary botao-editar' data-toggle='modal' data-target='.modaleditar' data-id='{$row['id_usuario']}'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
          </svg> Editar</button>
                <form method='POST'>
                    <button id='botao' type='submit' name='delete_candidato' class='btn btn-danger' href='admin_crud/user_data.php' value='{$row['id_trab']}' formaction='admin_crud/delete_candidato.php'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-x' viewBox='0 0 16 16'>
                            <path d='M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146z'/>
                            <path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/>
                        </svg> Deletar
                    </button>
                </form>
                <form method='POST'>
                    <button id='botao' type='submit' name='user_liberar' class='btn btn-warning' href='admin_crud/user_data.php' value='{$row['id_usuario']}' formaction='user_crud/user_finalizar.php'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-repeat' viewBox='0 0 16 16'>
                            <path d='M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z'/>
                        </svg> Habilitar/Desabilitar
                    </button>
                </form>
            </td>
        </div>
    </tr>";
    
  }

  // Fim da tabela HTML com classes do Bootstrap
  echo "</tbody>
            </table>";
} else {
  // Mensagem de erro caso a consulta não tenha retornado resultados
  echo "<div class='alert alert-danger'>Nenhum resultado encontrado.</div>";
}
