<?php
require_once 'koneksi.php'; // Arquivo de conexão com o banco de dados

// Consulta SQL para selecionar todos os registros da tabela tb_trabalhador
$sql = "SELECT * FROM tb_login";

// Executa a consulta SQL usando o método query do objeto mysqli
$resultado = $koneksi->query($sql);

// Verifica se a consulta retornou algum resultado
if ($resultado && $resultado->num_rows > 0) {
    // Início da tabela HTML com classes do Bootstrap
    echo "<table class='table table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID</th>
                        <th>Nome do(a) trabalhador(a)</th>
                        <th>CPF do(a) trabalhador(a)</th>
                        <th>Nível de permissão</th>
                    </tr>
                </thead>
                <tbody>";

    // Loop para percorrer os resultados da consulta
    while ($row = $resultado->fetch_assoc()) {
        // Verifica se o valor da coluna "level" é "user"
        if ($row['level'] === "user") {
            echo "<tr>
                        <td>{$row['id_usuarios']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['user']}</td>
                        <td style='background-color: #f0c8aa;'>{$row['level']}</td>
                    </tr>";
        } else {
            echo "<tr>
                        <td>{$row['id_usuarios']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['user']}</td>
                        <td>{$row['level']}</td>
                    </tr>";
        }
    }


    // Fim da tabela HTML com classes do Bootstrap
    echo "</tbody>
            </table>";
} else {
    // Mensagem de erro caso a consulta não tenha retornado resultados
    echo "<div class='alert alert-danger'>Nenhum resultado encontrado.</div>";
}

