<?php
include('includes/headbar.php');
?>

<html>

<head>
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="./styletest.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.botao-editar').click(function() {
                var userID = $(this).data('id');

                // Faça uma requisição AJAX GET para obter os dados do usuário
                $.ajax({
                    url: 'get_user_data.php',
                    type: 'GET',
                    data: {
                        userID: userID,
                        _random: Math.random() //novo parametro para ver se os dados param de ficar em cookies ou localstorage
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Preencha os inputs do modal com os dados do usuário
                        $('#nome_trab').val(data.nome_trab);
                        $('#pai_trab').val(data.pai_trab);
                        $('#mae_trab').val(data.mae_trab);

                        $('#dt_nascimento_trab').val(data.dt_nascimento_trab);
                        $('#cor_trab').val(data.cor_trab);
                        $('#sexo_trab').val(data.sexo_trab);
                        $('#nome_social_trab').val(data.nome_social_trab);
                        $('#deficiente_trab').val(data.deficiente_trab);
                        $('#tipo_deficiencia_trab').val(data.tipo_deficiencia_trab);
                        $('#nacionalidade_trab').val(data.nacionalidade_trab);
                        $('#chegada_brasil_trab').val(data.chegada_brasil_trab);
                        $('#naturalidade_trab').val(data.naturalidade_trab);
                        $('#estado_trab').val(data.estado_trab);
                        $('#tp_sangue').val(data.tp_sangue); //

                        $('#cpf_doc').val(data.cpf_doc);
                        $('#identidade_doc').val(data.identidade_doc);
                        $('#dt_emissao_identidade').val(data.dt_emissao_identidade);
                        $('#orgao_identidade').val(data.orgao_identidade);
                        $('#habilitacao_radio').val(data.habilitacao_radio).trigger('change');
                        $('#habilitacao_doc').val(data.habilitacao_doc);
                        $('#habilitacao_categoria').val(data.habilitacao_categoria);
                        $('#dt_validade_habilitacao').val(data.dt_validade_habilitacao);
                        $('#ctps_doc').val(data.ctps_doc);
                        $('#ctps_serie').val(data.ctps_serie);
                        $('#digito_fgts').val(data.digito_fgts);
                        $('#reservista').val(data.reservista);
                        $('#registro_prof').val(data.registro_prof);
                        $('#registro_prof_orgao').val(data.registro_prof);
                        $('#conta_corrente').val(data.conta_corrente);
                        $('#nome_conta_corrente').val(data.nome_conta_corrente);
                        $('#agencia_conta_corrente').val(data.agencia_conta_corrente);
                        $('#titulo_eleitor').val(data.titulo_eleitor);
                        $('#titulo_zona').val(data.titulo_zona);
                        $('#titulo_secao').val(data.titulo_secao);
                        $('#grau_instrucao').val(data.grau_instrucao);
                        $('#pis').val(data.pis);
                        $('#data_cadastramento').val(data.data_cadastramento);
                        $('#tipo_estado_civil').val(data.tipo_estado_civil); //
                        $('#conta_fgts').val(data.conta_fgts);
                        $('#data_opcao_fgts').val(data.data_opcao_fgts);
                        $('#banco_depositario_fgts').val(data.banco_depositario_fgts);

                        $('#logradouro').val(data.logradouro);
                        $('#numero').val(data.numero);
                        $('#tp_complemento').val(data.tp_complemento);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.cidade);
                        $('#uf').val(data.uf);
                        $('#cep').val(data.cep);
                        $('#endereco_eletronico').val(data.endereco_eletronico);
                        $('#telefone_fixo').val(data.telefone_fixo);
                        $('#celular').val(data.celular);

                        $('#dt_admissao').val(data.dt_admissao);
                        $('#dt_registro').val(data.dt_registro);
                        $('#funcao').val(data.funcao);
                        $('#cbo').val(data.cbo);
                        $('#salario_inicial').val(data.salario_inicial);
                        $('#forma_pagamento').val(data.forma_pagamento);
                        $('#tipo_pagamento').val(data.tipo_pagamento);
                        $('#insalubrida').val(data.insalubrida);
                        $('#periculosidade').val(data.periculosidade);
                        $('#comissao').val(data.comissao);
                        $('#categoria').val(data.categoria);
                        $('#sindicato').val(data.sindicato);
                        $('#centro_custo').val(data.centro_custo);
                        $('#localizacao').val(data.localizacao);
                        $('#horario').val(data.horario);

                        // Preencha os outros inputs do modal com os dados restantes

                        // Abra o modal
                        $('.modaleditar').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <div class="container mt-5">
        <!-- Conteúdo da página aqui -->
        <div class="container-fluid">

            <div class="container row d-flex justify-content-center" style="flex-direction: column; align-items: center;">

                <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                    <h2 class="h5 mb-3 mb-lg-1"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Adicionar novo usuário</h2>
                </div>

                <div class="col-lg-15"> <!--Especifica a largura de tudo -->
                    <!-- ------------------------------------------------------------------------ -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="admin_crud/inserir.php" method="POST">
                                <h3 class="h6 mb-4">Dados cadastrais</h3>
                                <div class="mb-3">
                                    <label class="form-label">Nome do(a) trabalhador(a)</label>
                                    <input type="text" name="ad_nome_trab" class="form-control" placeholder="Ex: Vinícius Aquino">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CPF do(a) trabalhador(a)</label>
                                    <input type="text" name="ad_cpf_trab" class="form-control" placeholder="Ex: 000.000.000-00" oninput="formatarCPF(this)">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Senha</label>
                                    <input type="text" name="ad_senha_trab" class="form-control" placeholder="Ex: Conectrom@2023">
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="user" name="ad_level" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Usuário comum
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Admin" name="ad_level" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Usuário administrador
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="save_filiacao" class="btn btn-primary">Criar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- ---------------------------------------------------------------------- -->
                    <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                        <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a> Listagem do usuários presentes</h2>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php include "admin_crud/login_view.php" ?>
                        </div>
                    </div>

                    <!-- Listagem dos candidados --------------------------------------------- -->

                    <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                        <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a> Listagem dos candidados presentes</h2>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php include "admin_crud/trabalhador_view.php" ?>
                        </div>
                    </div>
                    <!-- ---------------------------------------------------------------------- -->

                </div>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade modaluser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginErrorModalLabel">
                        Insira os dados do usuário
                        <i class="fasfa-times-circle"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="admin_crud/contrato_candidato.php">
                        <h3 class="h6 mb-4">Contrato</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="hidden" id="" class="trabalhador_id" name="trabalhador_id" value="">
                                    <label class="form-label">Data de admissão</label>
                                    <input id="" type="date" name="dt_admissao" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Data de registro</label>
                                    <input id="" type="date" name="dt_registro" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                        <!-- -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Função</label>
                                    <input id="" type="text" name="funcao" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">CBO</label>
                                    <input id="" type="text" name="cbo" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                        <!-- -->

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Salário Inicial R$</label>
                                    <input id="" type="text" name="salario_inicial" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Forma de pagamento</label>
                                    <input id="" type="text" name="forma_pagamento" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Tipo de pagamento</label>
                                    <input id="" type="text" name="tipo_pagamento" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                        <!-- -->

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Insalubrida</label>
                                    <input id="" type="text" name="insalubrida" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Periculosidade</label>
                                    <input id="" type="text" name="periculosidade" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Comissão</label>
                                    <input id="" type="text" name="comissao" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                        <!-- -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Categoria</label>
                                    <input id="" type="text" name="categoria" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Sindicato</label>
                                    <input id="" type="text" name="sindicato" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                        <!-- -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Centro de custo</label>
                                    <input id="" type="text" name="centro_custo" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Localização</label>
                                    <input id="" type="text" name="localizacao" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>

                        <!-- -->

                        <div class="mb-3">
                            <label class="form-label">Horário</label>
                            <input id="" type="text" name="horario" class="form-control" value="" required>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->

    <div class="modal fade modalcontrato" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginErrorModalLabel">
                        Ficha de registros
                        <i class="fasfa-times-circle"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="h6 mb-4">Vinícius Aquino</h3>
                    <div class="container">
                        <table class="table table-bordered">
                            <thead>
                                <!-- Cabeça do documento -->
                                <tr>
                                    <th colspan="5" class="text-center"><strong> REGISTRO DE EMPREGADOS </strong></th>
                                </tr>

                                <tr>
                                    <td rowspan="3"><img src="js/img.png" alt="a" style="width: 150px; height: 150px;"></td>
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

                        <tbody>
                            <table class="table table-bordered">
                                <!-- Corpo do documento -->
                                <tr>
                                    <td>Código</td>
                                    <td>Contrato</td>
                                    <td colspan="5">Nome do(a) trabalhador(a)</td>
                                </tr>

                                <tr>
                                    <td style="width: 20px;">Nome do pai</td>
                                    <td rowspan="2">Nome da mãe</td>
                                </tr>

                        </tbody>
                        <tfoot>
                            <!-- Parte final do documento -->
                        </tfoot>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal da textarea -->
    <div class="modal fade modalinfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginErrorModalLabel">
                        Insira os dados do usuário
                        <i class="fasfa-times-circle"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="admin_crud/textarea_trab.php">
                        <h3 class="h6 mb-4">Observações</h3>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="hidden" id="" class="trabalhador_id" name="trabalhador_id" value="">
                            </div>
                        </div>

                        <!-- -->

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Informe as observações abaixo</label>
                            <textarea class="form-control" name="campotexto" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Fim do modal -->

    <!-- -----------DOCUMENTO----------- -->

    <?php include('admin_crud/home_admin_edit.php'); ?>

    <script>
        $('button').click(function() {
            $('a[href="#home"]').tab('show');
        });
    </script>

    <!-- ---------------------- -->

    <script>
        $(document).ready(function() {
            $('.modaluser, .modaleditar, .modalinfo').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botão que acionou o modal
                var id_trab = button.data('id'); // Extrai o valor do atributo data-id

                // Atualiza o valor do campo de input
                $(this).find('.trabalhador_id, .trabalhador_id_1, .trabalhador_id_2, .trabalhador_id_3, .trabalhador_id_4').val(id_trab);
            });
        });
    </script>


    <!-- aaaaaaaaaaaaaaaa ------------>

    <script>
        function formatarCPF(input) {
            // Remove todos os caracteres que não sejam dígitos
            var cpf = input.value.replace(/\D/g, '');

            // Aplica a formatação de acordo com a quantidade de caracteres digitados
            if (cpf.length > 9) {
                cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            } else if (cpf.length > 6) {
                cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3');
            } else if (cpf.length > 3) {
                cpf = cpf.replace(/(\d{3})(\d{3})/, '$1.$2');
            }

            // Atualiza o valor do input com o CPF formatado
            input.value = cpf;
        }
    </script>


    </body>

</html>