$(document).ready(function () {
    // Função genérica para fazer uma solicitação AJAX e atualizar os campos com os dados retornados
    function fazerRequisicao(url, successCallback) {
        $.ajax({
            url: url,
            type: 'GET', // Especifique o tipo da requisição como GET
            data: {
                _random: Math.random() // Adicione o parâmetro _random com um valor aleatório
            },
            dataType: 'json',
            success: successCallback,
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Ocorreu um erro: ' + textStatus + ': ' + errorThrown);
            }
        });
    }

    fazerRequisicao('verificar_chave.php', function (data) {
        if (data.botao_desabilitado) {
            $('#meu-botao').prop('disabled', true);
            $('#card-1').css('background-color', '#dcf2de');
        } else {
            $('#meu-botao').prop('disabled', false);
            $('#meu-botao-red').prop('disabled', true);
        }
    });

    fazerRequisicao('verificar_chave_doc.php', function (data) {
        if (data.botao_desabilitado2) {
            $('#meu-botao2').prop('disabled', true);
            $('#card-2').css('background-color', '#dcf2de');
        } else {
            $('#meu-botao2').prop('disabled', false);
            $('#meu-botao-red2').prop('disabled', true);
        }
    });

    fazerRequisicao('get_user_data.php', function (data) {
        var nomeTrabInput = $('#nome_trab');
        if (data.nome_trab) {
            nomeTrabInput.val(data.nome_trab).addClass('is-valid');
        } else if (data !== null && data.nome_trab == false) {
            nomeTrabInput.addClass('is-invalid');
            $('#disclaimer').show();
        }

        var paiTrabInput = $('#pai_trab');
        if (data.pai_trab) {
            paiTrabInput.val(data.pai_trab).addClass('is-valid');
        } else if (data !== null && data.pai_trab == false) {
            paiTrabInput.addClass('is-invalid');
            $('#disclaimer').show();
        }

        var maeTrabInput = $('#mae_trab');
        if (data.mae_trab) {
            maeTrabInput.val(data.mae_trab).addClass('is-valid');
        } else if (data !== null && data.mae_trab == false) {
            maeTrabInput.addClass('is-invalid');
            $('#disclaimer').show();
        }

        var dtNascimentoTrabInput = $('#dt_nascimento_trab');
        if (data.dt_nascimento_trab) {
            dtNascimentoTrabInput.val(data.dt_nascimento_trab).addClass('is-valid');
        } else if (data !== null && data.dt_nascimento_trab == false) {
            dtNascimentoTrabInput.addClass('is-invalid');
            $('#disclaimer').show();
        }

        var corTrabInput = $('#cor_trab');
        if (data.cor_trab) {
            corTrabInput.val(data.cor_trab).addClass('is-valid');
        } else if (data !== null && data.cor_trab == false) {
            corTrabInput.addClass('is-invalid');
            $('#disclaimer').show();
        }

        var sexoTrabInput = $('#sexo_trab');
        if (data.sexo_trab) {
            sexoTrabInput.val(data.sexo_trab).addClass('is-valid');
        } else if (data !== null && data.sexo_trab == false) {
            sexoTrabInput.addClass('is-invalid');
            $('#disclaimer').show();
        }

        var nomeSocialTrabInput = $('#nome_social_trab');
        if (data.nome_social_trab) {
            nomeSocialTrabInput.val(data.nome_social_trab).addClass('is-valid');
        } else if (data !== null && data.nome_social_trab == false) {
            nomeSocialTrabInput.addClass('is-valid');
        }

        $(document).ready(function () {
            var tipoDeficienciaTrabInput = $('#tipo_deficiencia_trab');
            var deficiencia1Input = $('#deficiencia-1');
            var deficiencia2Input = $('#deficiencia-2');

            var tipoDeficienciaTrabValue = '<?php echo isset($_POST["tipo_deficiencia_trab"]) ? $_POST["tipo_deficiencia_trab"] : "" ?>';

            verificarValidade();

            $('input[name="deficiencia"], #tipo_deficiencia_trab').change(function () {
                verificarValidade();
            });

            function verificarValidade() {
                if (deficiencia1Input.prop('checked')) {
                    if (tipoDeficienciaTrabInput.val().trim() !== "") {
                        tipoDeficienciaTrabInput.removeClass('is-invalid').addClass('is-valid');
                    } else {
                        tipoDeficienciaTrabInput.removeClass('is-valid').addClass('is-invalid');
                        $('#disclaimer').show();
                    }
                } else if (deficiencia2Input.prop('checked')) {
                    tipoDeficienciaTrabInput.val('').removeClass('is-valid is-invalid');
                }
            }
        });

        var nacionalidadeTrabInput = $('#nacionalidade_trab');
        if (data.nacionalidade_trab) {
            nacionalidadeTrabInput.val(data.nacionalidade_trab).addClass('is-valid');
        } else if (data !== null && data.nacionalidade_trab == false) {
            nacionalidadeTrabInput.addClass('is-invalid');
            $('#disclaimer').show();
        }

        var chegadaBrasilTrabInput = $('#chegada_brasil_trab');
        if (data.chegada_brasil_trab) {
            chegadaBrasilTrabInput.val(data.chegada_brasil_trab).addClass('is-valid');
        } else if (data !== null && data.chegada_brasil_trab == false) {
            chegadaBrasilTrabInput.addClass('is-valid');
        }

        var naturalidadeTrabInput = $('#naturalidade_trab');
        if (data.naturalidade_trab) {
            naturalidadeTrabInput.val(data.naturalidade_trab).addClass('is-valid');
        } else if (data !== null && data.naturalidade_trab == false) {
            naturalidadeTrabInput.addClass('is-valid');
        }

        var estadoTrabInput = $('#estado_trab');
        if (data.estado_trab) {
            estadoTrabInput.val(data.estado_trab).addClass('is-valid');
        } else if (data !== null && data.estado_trab == false) {
            estadoTrabInput.addClass('is-invalid');
            $('#disclaimer').show();
        }

        var tpSangueInput = $('#tp_sangue');
        if (data.tp_sangue && data.tp_sangue.tp_sangue) {
            tpSangueInput.val(data.tp_sangue.tp_sangue).addClass('is-valid');
        } else if (data !== null && data.documentos.tp_sangue == false) {
            tpSangueInput.addClass('is-invalid');
        }


        //
        var deficiente = data.deficiente_trab;
        if (deficiente === 'Sim') {
            $('#deficiencia-1').prop('checked', true);
            $('#especificar-deficiencia').show();
            $('#tipo_deficiencia_trab').val(data.tipo_deficiencia_trab);
        } else {
            $('#deficiencia-2').prop('checked', true);
            $('#especificar-deficiencia').hide();
            $('#tipo_deficiencia_trab').val('');
        }
        //

        var cpfDocInput = $('#cpf_doc');
        if (data.documentos && data.documentos.cpf_doc) {
            cpfDocInput.val(data.documentos.cpf_doc).addClass('is-valid');
        } else if (data !== null && data.documentos.cpf_doc == false) {
            cpfDocInput.addClass('is-invalid');
        }

        var identidadeDocInput = $('#identidade_doc');
        if (data.documentos && data.documentos.identidade_doc) {
            identidadeDocInput.val(data.documentos.identidade_doc).addClass('is-valid');
        } else if (data !== null && data.documentos.identidade_doc == false) {
            identidadeDocInput.addClass('is-invalid');
        }

        var dtEmissaoIdentidadeInput = $('#dt_emissao_identidade');
        if (data.documentos && data.documentos.dt_emissao_identidade) {
            dtEmissaoIdentidadeInput.val(data.documentos.dt_emissao_identidade).addClass('is-valid');
        } else if (data !== null && data.documentos.dt_emissao_identidade == false) {
            dtEmissaoIdentidadeInput.addClass('is-invalid');
        }

        var orgaoIdentidadeInput = $('#orgao_identidade');
        if (data.documentos && data.documentos.orgao_identidade) {
            orgaoIdentidadeInput.val(data.documentos.orgao_identidade).addClass('is-valid');
        } else if (data !== null && data.documentos.orgao_identidade == false) {
            orgaoIdentidadeInput.addClass('is-invalid');
        }

        var habilitacaoDocInput = $('#habilitacao_doc');
        if (data.documentos && data.documentos.habilitacao_doc) {
            habilitacaoDocInput.val(data.documentos.habilitacao_doc).addClass('is-valid');
        } else if (data !== null && data.documentos.habilitacao_doc == false) {
            habilitacaoDocInput.addClass('is-invalid');
        }

        var habilitacaoCategoriaInput = $('#habilitacao_categoria');
        if (data.documentos && data.documentos.habilitacao_categoria) {
            habilitacaoCategoriaInput.val(data.documentos.habilitacao_categoria).addClass('is-valid');
        } else if (data !== null && data.documentos.habilitacao_categoria == false) {
            habilitacaoCategoriaInput.addClass('is-invalid');
        }

        var dtValidadeHabilitacaoInput = $('#dt_validade_habilitacao');
        if (data.documentos && data.documentos.dt_validade_habilitacao) {
            dtValidadeHabilitacaoInput.val(data.documentos.dt_validade_habilitacao).addClass('is-valid');
        } else if (data !== null && data.documentos.dt_validade_habilitacao == false) {
            dtValidadeHabilitacaoInput.addClass('is-invalid');
        }

        var ctpsDocInput = $('#ctps_doc');
        if (data.documentos && data.documentos.ctps_doc) {
            ctpsDocInput.val(data.documentos.ctps_doc).addClass('is-valid');
        } else if (data !== null && data.documentos.ctps_doc == false) {
            ctpsDocInput.addClass('is-invalid');
        }

        var ctpsSerieInput = $('#ctps_serie');
        if (data.documentos && data.documentos.ctps_serie) {
            ctpsSerieInput.val(data.documentos.ctps_serie).addClass('is-valid');
        } else if (data !== null && data.documentos.ctps_serie == false) {
            ctpsSerieInput.addClass('is-invalid');
        }

        var digitoFgtsInput = $('#digito_fgts');
        if (data.documentos && data.documentos.digito_fgts) {
            digitoFgtsInput.val(data.documentos.digito_fgts).addClass('is-valid');
        } else if (data !== null && data.documentos.digito_fgts == false) {
            digitoFgtsInput.addClass('is-invalid');
        }

        var reservistaInput = $('#reservista');
        if (data.documentos && data.documentos.reservista) {
            reservistaInput.val(data.documentos.reservista).addClass('is-valid');
        } else if (data !== null && data.documentos.reservista == false) {
            reservistaInput.addClass('is-valid');
        }

        var registroProfInput = $('#registro_prof');
        if (data.documentos && data.documentos.registro_prof) {
            registroProfInput.val(data.documentos.registro_prof).addClass('is-valid');
        } else if (data !== null && data.documentos.registro_prof == false) {
            registroProfInput.addClass('is-invalid');
        }

        var registroProfOrgaoInput = $('#registro_prof_orgao');
        if (data.documentos && data.documentos.registro_prof_orgao) {
            registroProfOrgaoInput.val(data.documentos.registro_prof_orgao).addClass('is-valid');
        } else if (data !== null && data.documentos.registro_prof_orgao == false) {
            registroProfOrgaoInput.addClass('is-invalid');
        }

        var nomeGrauInput = $('#grau_instrucao');
        if (data.grau && data.grau.grau_instrucao) {
            nomeGrauInput.val(data.grau.grau_instrucao).addClass('is-valid');
        } else if (data !== null && data.grau.grau_instrucao == false) {
            nomeGrauInput.addClass('is-invalid');
        }

        var contaCorrenteInput = $('#conta_corrente');
        if (data.documentos && data.documentos.conta_corrente) {
            contaCorrenteInput.val(data.documentos.conta_corrente).addClass('is-valid');
        } else if (data !== null && data.documentos.conta_corrente == false) {
            contaCorrenteInput.addClass('is-invalid');
        }

        var contaAgenciaCorrenteInput = $('#agencia_conta_corrente');
        if (data.documentos && data.documentos.agencia_conta_corrente) {
            contaAgenciaCorrenteInput.val(data.documentos.agencia_conta_corrente).addClass('is-valid');
        } else if (data !== null && data.documentos.agencia_conta_corrente == false) {
            contaAgenciaCorrenteInput.addClass('is-invalid');
        }

        var contaNomeCorrenteInput = $('#nome_conta_corrente');
        if (data.documentos && data.documentos.nome_conta_corrente) {
            contaNomeCorrenteInput.val(data.documentos.nome_conta_corrente).addClass('is-valid');
        } else if (data !== null && data.documentos.nome_conta_corrente == false) {
            contaNomeCorrenteInput.addClass('is-invalid');
        }

        var tituloEleitorInput = $('#titulo_eleitor');
        if (data.documentos && data.documentos.titulo_eleitor) {
            tituloEleitorInput.val(data.documentos.titulo_eleitor).addClass('is-valid');
        } else if (data !== null && data.documentos.titulo_eleitor == false) {
            tituloEleitorInput.addClass('is-invalid');
        }

        var tituloZonaInput = $('#titulo_zona');
        if (data.documentos && data.documentos.titulo_zona) {
            tituloZonaInput.val(data.documentos.titulo_zona).addClass('is-valid');
        } else if (data !== null && data.documentos.titulo_zona == false) {
            tituloZonaInput.addClass('is-invalid');
        }

        var tituloSecaoInput = $('#titulo_secao');
        if (data.documentos && data.documentos.titulo_secao) {
            tituloSecaoInput.val(data.documentos.titulo_secao).addClass('is-valid');
        } else if (data !== null && data.documentos.titulo_secao == false) {
            tituloSecaoInput.addClass('is-invalid');
        }

        var pisInput = $('#pis');
        if (data.documentos && data.documentos.pis) {
            pisInput.val(data.documentos.pis).addClass('is-valid');
        } else if (data !== null && data.documentos.pis == false) {
            pisInput.addClass('is-invalid');
        }

        var dataCadastramentoInput = $('#data_cadastramento');
        if (data.documentos && data.documentos.data_cadastramento) {
            dataCadastramentoInput.val(data.documentos.data_cadastramento).addClass('is-valid');
        } else if (data !== null && data.documentos.data_cadastramento == false) {
            dataCadastramentoInput.addClass('is-invalid');
        }

        var nomeEstadoInput = $('#tipo_estado_civil');
        if (data.estado && data.estado.tipo_estado_civil) {
            nomeEstadoInput.val(data.estado.tipo_estado_civil).addClass('is-valid');
        } else if (data !== null && data.estado.tipo_estado_civil == false) {
            nomeEstadoInput.addClass('is-invalid');
        }

        var contaFgtsInput = $('#conta_fgts');
        if (data.documentos && data.documentos.conta_fgts) {
            contaFgtsInput.val(data.documentos.conta_fgts).addClass('is-valid');
        } else if (data !== null && data.documentos.conta_fgts == false) {
            contaFgtsInput.addClass('is-invalid');
        }

        var dataOpcaoFgtsInput = $('#data_opcao_fgts');
        if (data.documentos && data.documentos.data_opcao_fgts) {
            dataOpcaoFgtsInput.val(data.documentos.data_opcao_fgts).addClass('is-valid');
        } else if (data !== null && data.documentos.data_opcao_fgts == false) {
            dataOpcaoFgtsInput.addClass('is-invalid');
        }

        var bancoDepositarioFgtsInput = $('#banco_depositario_fgts');
        if (data.documentos && data.documentos.banco_depositario_fgts) {
            bancoDepositarioFgtsInput.val(data.documentos.banco_depositario_fgts).addClass('is-valid');
        } else if (data !== null && data.documentos.banco_depositario_fgts == false) {
            bancoDepositarioFgtsInput.addClass('is-invalid');
        }
        // -
        var possuiHabilitacao = data.documentos.habilitacao_radio; 
        if (possuiHabilitacao === 'Sim') { 
            $('#habilitacao-1').prop('checked', true);
            $('#especificar-habilitacao').show();
            $('#habilitacao_doc').val(data.documentos.habilitacao_doc);
            $('#habilitacao_categoria').val(data.documentos.habilitacao_categoria);
            $('#dt_validade_habilitacao').val(data.documentos.dt_validade_habilitacao);
        } else {
            $('#habilitacao-2').prop('checked', true);
            $('#especificar-habilitacao').hide();
            $('#habilitacao_doc').val('');
            $('#habilitacao_categoria').val('');
            $('#dt_validade_habilitacao').val('');
        }

        var logradouroInput = $('#logradouro');
        if (data.endereco && data.endereco.logradouro) {
            logradouroInput.val(data.endereco.logradouro).addClass('is-valid');
        } else if (data !== null && data.endereco.logradouro == false) {
            logradouroInput.addClass('is-invalid');
        }

        var numeroInput = $('#numero');
        if (data.endereco && data.endereco.numero) {
            numeroInput.val(data.endereco.numero).addClass('is-valid');
        } else if (data !== null && data.endereco.numero == false) {
            numeroInput.addClass('is-invalid');
        }

        var complementoInput = $('#complemento');
        if (data.complemento && data.complemento.tp_complemento) {
            complementoInput.val(data.complemento.tp_complemento).addClass('is-valid');
        } else if (data !== null && data.complemento.tp_complemento == false) {
            complementoInput.addClass('is-valid');
        }

        var bairroInput = $('#bairro');
        if (data.endereco && data.endereco.bairro) {
            bairroInput.val(data.endereco.bairro).addClass('is-valid');
        } else if (data !== null && data.endereco.bairro == false) {
            bairroInput.addClass('is-invalid');
        }

        var cidadeInput = $('#cidade');
        if (data.endereco && data.endereco.cidade) {
            cidadeInput.val(data.endereco.cidade).addClass('is-valid');
        } else if (data !== null && data.endereco.cidade == false) {
            cidadeInput.addClass('is-invalid');
        }

        var ufInput = $('#uf');
        if (data.endereco && data.endereco.uf) {
            ufInput.val(data.endereco.uf).addClass('is-valid');
        } else if (data !== null && data.endereco.uf == false) {
            ufInput.addClass('is-invalid');
        }

        var cepInput = $('#cep');
        if (data.endereco && data.endereco.cep) {
            cepInput.val(data.endereco.cep).addClass('is-valid');
        } else if (data !== null && data.endereco.cep == false) {
            cepInput.addClass('is-invalid');
        }

        var enderecoEletronicoInput = $('#endereco_eletronico');
        if (data.endereco && data.endereco.endereco_eletronico) {
            enderecoEletronicoInput.val(data.endereco.endereco_eletronico).addClass('is-valid');
        } else if (data !== null && data.endereco.endereco_eletronico == false) {
            enderecoEletronicoInput.addClass('is-invalid');
        }

        var celularInput = $('#celular');
        if (data.endereco && data.endereco.celular) {
            celularInput.val(data.endereco.celular).addClass('is-valid');
        } else if (data !== null && data.endereco.celular == false) {
            celularInput.addClass('is-invalid');
        }

        var telefoneFixoInput = $('#telefone_fixo');
        if (data.endereco && data.endereco.telefone_fixo) {
            telefoneFixoInput.val(data.endereco.telefone_fixo).addClass('is-valid');
        } else if (data !== null && data.endereco.telefone_fixo == false) {
            telefoneFixoInput.addClass('is-invalid');
        }

    });
});