<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Olá, mundo!</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <style>
        .table-bordered td,
        .table-bordered th {
            border: 1px solid black;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid black;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include('../koneksi.php');

        $id_trabalhador = $_POST['mostrar_candidato'];

        if (isset($_POST['mostrar_candidato'])) {

            $sql = "SELECT * FROM tb_trabalhador WHERE id_usuario = $id_trabalhador";

            if ($resultado = mysqli_query($koneksi, $sql)) {
                while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <table class="table table-bordered" style="background-color: #C6EFCE;">
                        <thead>
                            <!-- Cabeça do documento -->
                            <tr>
                                <th colspan="5" class="text-center"><strong> REGISTRO DE EMPREGADOS </strong></th>
                            </tr>

                            <tr>
                                <td rowspan="3"><img src="../js/img.png" alt="a" style="width: 236px; height: 195px;"></td>
                                <td colspan="3"><strong>Empregador</strong><br>CONECTROM LTDA</td>
                                <td><strong>CNPJ</strong><br>08.484.735/0001-40</td>
                            </tr>

                            <tr>
                                <td><strong>Endereço</strong><br>RUA JACAUNA</td>
                                <td><strong>Nº</strong><br>139</td>
                                <td><strong>Complemento</strong><br></td>
                                <td><strong>Bairro</strong><br>LAGOA SECA</td>
                            </tr>

                            <tr>
                                <td><strong>CIDADE</strong><br>NATAL</td>
                                <td><strong>UF</strong><br>RN</td>
                                <td><strong>CEP</strong><br>59022-360</td>
                                <td><strong>Telefone</strong><br>(84) 3211-6655</td>
                            </tr>
                        </thead>
                    </table>

                    <table class="table table-bordered" style="background-color: #FFC7CE;">
                        <!-- Corpo do documento -->
                        <tr>
                            <td><strong>Código </strong><br><?php echo "X"; ?> </td>

                            <td><strong>Contrato </strong><br><?php echo "X"; ?></td>
                        </tr>
                    </table>

                    <tbody>
                        <div class="d-flex justify-content-center align-items-lg-center py-3 flex-column flex-lg-row">
                            <h2 class="h5 mb-3 mb-lg-0"><a class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Filiação</h2>
                        </div>
                        <table class="table table-bordered" style="background-color: #BFE6FF;">
                            <!-- Corpo do documento -->
                            <tr>
                                <td><strong>Nome do(a) trabalhador (a) </strong><br><?php echo (!empty($row['nome_trab'])) ? $row['nome_trab'] : 'Campo vazio'; ?> </td>

                                <td><strong>Nome do pai </strong><br><?php echo "{$row['pai_trab']}"; ?></td>

                                <td colspan="2"><strong>Nome da mãe </strong><br><?php echo "{$row['mae_trab']}"; ?></td>
                            </tr>

                            <tr>
                                <td><strong>Data de nascimento </strong><br><?php echo date('d/m/Y', strtotime($row['dt_nascimento_trab'])); ?> </td>

                                <td><strong>Raça/cor </strong><br><?php echo "{$row['cor_trab']}"; ?></td>

                                <td><strong>Sexo </strong><br><?php echo "{$row['sexo_trab']}"; ?></td>

                                <td><strong>Nome social </strong><br><?php echo "{$row['nome_social_trab']}"; ?></td>
                            </tr>

                            <tr>
                                <td><strong>Deficiente </strong><br><?php echo "{$row['deficiente_trab']}"; ?> </td>

                                <td><strong>Tipo de deficiência </strong><br><?php echo "{$row['tipo_deficiencia_trab']}"; ?></td>

                                <td><strong>Nacionalidade </strong><br><?php echo "{$row['nacionalidade_trab']}"; ?></td>
                                <td><strong>Chegada ao Brasil </strong><br><?php
                                                                            $chegada_brasil_trab = $row['chegada_brasil_trab'];
                                                                            if ($chegada_brasil_trab !== null) {
                                                                                echo date('d/m/Y', strtotime($chegada_brasil_trab));
                                                                            }
                                                                            ?>
                                </td>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>Naturalidade </strong><br><?php echo "{$row['naturalidade_trab']}"; ?> </td>

                                <td><strong>Estado </strong><br><?php echo "{$row['estado_trab']}"; ?></td>
                    <?php }
            }
        } ?>
                    <?php if (isset($_POST['mostrar_candidato'])) {

                        $sql2 = "SELECT * FROM tb_tp_sangue WHERE tb_trabalhador_id_trab = $id_trabalhador";

                        if ($resultado = mysqli_query($koneksi, $sql2)) {
                            while ($row = mysqli_fetch_assoc($resultado)) {  ?>

                                <td><strong>Tipo sanguíneo </strong><br><?php echo "{$row['tp_sangue']}"; ?></td>
                            </tr>
                        </table>

            <?php }
                        }
                    } ?>

            <?php if (isset($_POST['mostrar_candidato'])) {

                $sql2 = "SELECT * FROM tb_documentos WHERE tb_documentos_id_trab = $id_trabalhador";

                if ($resultado = mysqli_query($koneksi, $sql2)) {
                    while ($row = mysqli_fetch_assoc($resultado)) { ?>


                        <div class="d-flex justify-content-center align-items-lg-center py-3 flex-column flex-lg-row">
                            <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Documentos</h2>
                        </div>

                        <table class="table table-bordered" style="background-color: #BFE6FF;">
                            <!-- Corpo do documento -->
                            <tr>
                                <td><strong>CPF </strong><br><?php echo "{$row['cpf_doc']}"; ?> </td>

                                <td><strong>Cédula de identidade </strong><br><?php echo "{$row['identidade_doc']}"; ?></td>

                                <td><strong>Data de emissão </strong><br><?php echo date('d/m/Y', strtotime($row['dt_emissao_identidade'])); ?> </td>

                                <td><strong>Órgão </strong><br><?php echo "{$row['orgao_identidade']}"; ?></td>

                                <td><strong>Habilitação </strong><br><?php
                                                                        if (!empty($row['habilitacao_doc'])) {
                                                                            echo $row['habilitacao_doc'];
                                                                        } elseif ($row['habilitacao_radio'] == "Não") {
                                                                            echo "Não tem habilitação";
                                                                        } else {
                                                                            echo "vazio";
                                                                        };
                                                                        ?>
                                </td>

                                <td><strong>Categoria </strong><br><?php echo "{$row['habilitacao_categoria']}"; ?></td>

                                <td><strong>Validade </strong><br><?php
                                                                    $chegada_brasil_trab = $row['dt_validade_habilitacao'];
                                                                    if ($chegada_brasil_trab !== null) {
                                                                        echo date('d/m/Y', strtotime($chegada_brasil_trab));
                                                                    }
                                                                    ?> </td>
                            </tr>

                            <tr>
                                <td><strong>CTPS </strong><br><?php echo "{$row['ctps_doc']}"; ?> </td>

                                <td><strong>Série </strong><br><?php echo "{$row['ctps_serie']}"; ?></td>

                                <td><strong>Dígito </strong><br><?php echo "{$row['digito_fgts']}"; ?></td>

                                <td colspan="2"><strong>Carteira reservista </strong><br><?php echo "{$row['reservista']}"; ?></td>

                                <td><strong>Registro profissional </strong><br><?php echo "{$row['registro_prof']}"; ?></td>

                                <td><strong>Órgão </strong><br><?php echo "{$row['registro_prof_orgao']}"; ?></td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>Nome do titular da conta </strong><br><?php echo "{$row['nome_conta_corrente']}"; ?></td>

                                <td colspan="3"><strong>Nº da Conta corrente </strong><br><?php echo "{$row['conta_corrente']}"; ?></td>

                                <td colspan="2"><strong>Agência da conta </strong><br><?php echo "{$row['agencia_conta_corrente']}"; ?></td>

                            </tr>

                            <tr>
                                <td colspan="2"><strong>Nº título de eleitor </strong><br><?php echo "{$row['titulo_eleitor']}"; ?> </td>

                                <td><strong>Zona </strong><br><?php echo "{$row['titulo_zona']}"; ?></td>

                                <td><strong>Seção </strong><br><?php echo "{$row['titulo_secao']}"; ?></td>
                    <?php }
                }
            } ?>
                    <?php if (isset($_POST['mostrar_candidato'])) {

                        $sql3 = "SELECT * FROM tb_grau WHERE tb_grau_id_trab = $id_trabalhador";

                        if ($resultado = mysqli_query($koneksi, $sql3)) {
                            while ($row = mysqli_fetch_assoc($resultado)) { ?>
                                <!-- -->
                                <td colspan="3"><strong>Grau de instrução </strong><br><?php echo "{$row['grau_instrucao']}"; ?></td>
                            </tr>
                <?php }
                        }
                    } ?>
                <?php if (isset($_POST['mostrar_candidato'])) {

                    $sql2 = "SELECT * FROM tb_documentos WHERE tb_documentos_id_trab = $id_trabalhador";

                    if ($resultado = mysqli_query($koneksi, $sql2)) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>


                            <tr>
                                <td colspan="2"><strong>Nº do PIS </strong><br><?php echo "{$row['pis']}"; ?> </td>

                                <td colspan="2"><strong>Data de cadastramento </strong><br><?php echo date('d/m/Y', strtotime($row['data_cadastramento'])); ?> </td>
                    <?php }
                    }
                } ?>
                    <!-- -->
                    <?php if (isset($_POST['mostrar_candidato'])) {

                        $sql4 = "SELECT * FROM tb_estado_civil WHERE tb_estado_civil_id_trab = $id_trabalhador";

                        if ($resultado = mysqli_query($koneksi, $sql4)) {
                            while ($row = mysqli_fetch_assoc($resultado)) { ?>

                                <td colspan="3"><strong>Estado Civil </strong><br><?php echo "{$row['tipo_estado_civil']}"; ?></td>
                            </tr>
                <?php }
                        }
                    } ?>

                <?php if (isset($_POST['mostrar_candidato'])) {

                    $sql2 = "SELECT * FROM tb_documentos WHERE tb_documentos_id_trab = $id_trabalhador";

                    if ($resultado = mysqli_query($koneksi, $sql2)) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>

                            <tr>
                                <td colspan="2"><strong>Nº da conta FGTS </strong><br><?php echo "{$row['conta_fgts']}"; ?> </td>

                                <td colspan="2"><strong>Data de opção </strong><br><?php echo date('d/m/Y', strtotime($row['data_opcao_fgts'])); ?> </td>

                                <td colspan="3"><strong>Banco depositário - FGTS </strong><br><?php echo "{$row['banco_depositario_fgts']}"; ?></td>
                            </tr>
                <?php }
                    }
                } ?>

                <?php if (isset($_POST['mostrar_candidato'])) {

                    $sql2 = "SELECT * FROM tb_endereco WHERE tb_endereco_id_trab = $id_trabalhador";

                    if ($resultado = mysqli_query($koneksi, $sql2)) {
                        while ($row = mysqli_fetch_assoc($resultado)) { ?>
                        </table>
                        <div class="d-flex justify-content-center align-items-lg-center py-3 flex-column flex-lg-row">
                            <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Endereco</h2>
                        </div>
                        <table class="table table-bordered" style="background-color: #BFE6FF;">

                            <tr>
                                <td colspan="2"><strong>Endereço </strong><br><?php echo (!empty($row['logradouro'])) ? $row['logradouro'] : 'Campo vazio'; ?> </td>

                                <td><strong>Número </strong><br><?php echo (!empty($row['numero'])) ? $row['numero'] : 'Campo vazio'; ?></td>
                    <?php }
                    }
                } ?>
                    <?php if (isset($_POST['mostrar_candidato'])) {

                        $sql2 = "SELECT * FROM tb_complemento WHERE tp_complemento_id_trab = $id_trabalhador";

                        if ($resultado = mysqli_query($koneksi, $sql2)) {
                            while ($row = mysqli_fetch_assoc($resultado)) { ?>

                                <td colspan="2"><strong>Complemento </strong><br><?php echo (!empty($row['tp_complemento'])) ? $row['tp_complemento'] : 'Campo vazio'; ?></td>
                    <?php }
                        }
                    } ?>
                    <?php if (isset($_POST['mostrar_candidato'])) {

                        $sql2 = "SELECT * FROM tb_endereco WHERE tb_endereco_id_trab = $id_trabalhador";

                        if ($resultado = mysqli_query($koneksi, $sql2)) {
                            while ($row = mysqli_fetch_assoc($resultado)) { ?>

                                <td colspan="2"><strong>Bairro </strong><br><?php echo (!empty($row['bairro'])) ? $row['bairro'] : 'Campo vazio'; ?></td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>Cidade </strong><br><?php echo (!empty($row['cidade'])) ? $row['cidade'] : 'Campo vazio'; ?> </td>

                                <td><strong>Estado </strong><br><?php echo (!empty($row['uf'])) ? $row['uf'] : 'Campo vazio'; ?></td>

                                <td colspan="2"><strong>CEP </strong><br><?php echo (!empty($row['cep'])) ? $row['cep'] : 'Campo vazio'; ?></td>

                                <td colspan="2"><strong>Telefone </strong><br><?php echo (!empty($row['telefone_fixo'])) ? $row['telefone_fixo'] : 'Campo vazio'; ?></td>
                            </tr>

                            <tr>
                                <td colspan="5"><strong>Endereço eletrônico </strong><br><?php echo (!empty($row['endereco_eletronico'])) ? $row['endereco_eletronico'] : 'Campo vazio'; ?> </td>

                                <td colspan="2"><strong>Celular </strong><br><?php echo (!empty($row['celular'])) ? $row['celular'] : 'Campo vazio'; ?></td>
                            </tr>
                        </table>
            <?php }
                        }
                    } ?>

            <div class="d-flex justify-content-center align-items-lg-center py-3 flex-column flex-lg-row">
                <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Contrato</h2>
            </div>
            <?php if (isset($_POST['mostrar_candidato'])) {

                $sql2 = "SELECT * FROM tb_contrato WHERE tb_contrato_id_trab = $id_trabalhador";

                if ($resultado = mysqli_query($koneksi, $sql2)) {
                    while ($row = mysqli_fetch_assoc($resultado)) { ?>

                        <table class="table table-bordered" style="background-color: #f7ecdc;">
                            <!-- Corpo do documento -->
                            <tr>
                                <td><strong>Data de admissão </strong><br><?php echo date('d/m/Y', strtotime($row['dt_admissao'])); ?> </td>

                                <td><strong>Data de registro </strong><br><?php echo date('d/m/Y', strtotime($row['dt_registro'])); ?> </td>

                                <td colspan="3"><strong>Função </strong><br><?php echo "{$row['funcao']}"; ?></td>

                                <td><strong>CBO </strong><br><?php echo "{$row['cbo']}"; ?></td>
                            </tr>

                            <tr>
                                <td><strong>Salário Inicial R$ </strong><br><?php echo "{$row['salario_inicial']}"; ?> </td>

                                <td><strong>Forma de pagamento </strong><br><?php echo "{$row['forma_pagamento']}"; ?></td>

                                <td><strong>Tipo de pagamento </strong><br><?php echo "{$row['tipo_pagamento']}"; ?></td>

                                <td><strong>Insalubridade </strong><br><?php echo "{$row['insalubrida']}"; ?> </td>

                                <td><strong>Periculosidade </strong><br><?php echo "{$row['periculosidade']}"; ?></td>

                                <td><strong>Comissão </strong><br><?php echo "{$row['comissao']}"; ?></td>
                            </tr>

                            <tr>
                                <td colspan="3"><strong>Categoria </strong><br><?php echo "{$row['categoria']}"; ?> </td>

                                <td colspan="3"><strong>Sindicato </strong><br><?php echo "{$row['sindicato']}"; ?></td>
                            </tr>

                            <tr>
                                <td colspan="3"><strong>Centro de custo </strong><br><?php echo "{$row['localizacao']}"; ?> </td>

                                <td colspan="3"><strong>Localização </strong><br><?php echo "{$row['localizacao']}"; ?></td>
                            </tr>

                            <tr>
                                <td colspan="6"><strong>Horário </strong><br><?php echo "{$row['horario']}"; ?> </td>
                            </tr>
                        </table>
            <?php }
                }
            } ?>



                    </tbody>
                    <tfoot>
                        <?php
                        if (isset($_POST['mostrar_candidato'])) {

                            $sql5 = "SELECT * FROM tb_beneficiarios WHERE tb_beneficiarios_id_usuario = $id_trabalhador";
                        ?>
                            <div class="d-flex justify-content-center align-items-lg-center py-3 flex-column flex-lg-row">
                                <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Beneficiários</h2>
                            </div>
                            <table class="table table-bordered" style="background-color: #BFE6FF;">
                                <?php
                                if ($resultado_beneficiarios = mysqli_query($koneksi, $sql5)) {
                                    while ($row_beneficiario = mysqli_fetch_assoc($resultado_beneficiarios)) {
                                        // Exibir dados dos beneficiários
                                        echo "<tr>";
                                        echo "<td><strong>Nome </strong><br>{$row_beneficiario['nome_ben']}</td>";
                                        echo "<td><strong>CPF </strong><br>{$row_beneficiario['cpf_ben']}</td>";
                                        echo "<td><strong>Parentesco </strong><br>{$row_beneficiario['parentesco_ben']}</td>";
                                        echo "<td><strong>Data Nasc. </strong><br>" . date('d/m/Y', strtotime($row_beneficiario['dt_nascimento_ben'])) . "</td>";

                                        echo "</tr>";
                                    }
                                } else {
                                    // Tratar erro na consulta dos beneficiários
                                }
                                ?>
                            </table>
                        <?php } ?>

                        <!-- Parte final do documento -->
                    </tfoot>

    </div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>