<?php
include_once('includes/headbar.php');

include('koneksi.php');
$id_usuario = $_SESSION['id_usuarios'];
$query = "SELECT * FROM tb_trabalhador WHERE id_usuario = $id_usuario";
$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);

	if ($row['envio_trab'] === '1') {
		echo '<script>window.location.href = "./home_final.php";</script>';
		exit();
	}
}

// if (!isset($_SESSION['salvar'])) {
// 	$_SESSION['salvar'] = false;
// }
?>

<title>Adicionar Candidato</title>

<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="estilos/estilos.css">
	<script>
		window.addEventListener('DOMContentLoaded', function() {
			var divElement = document.getElementById('disclaimer');
			divElement.style.display = 'none';
		});
	</script>
	<script type="text/javascript" src="js/card.js" defer></script>

	<div class="container-fluid">

		<div class="container">

			<div class="d-flex justify-content-center align-items-lg-center py-3 flex-column flex-lg-row">
				<h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Ficha de registros</h2>
			</div>

			<div class="row d-flex justify-content-center">

				<div class="col-lg-10"> <!--Especifica a largura de tudo -->

					<!-- -->
					<div id="disclaimer" class="alert alert-danger" role="alert">
						<h4 class="alert-heading">Ops! Algo está incompleto!</h4>
						<p>Detectamos que alguns dados foram preenchidos de forma incorreta ou estão em falta. Para garantir a eficiência e precisão das informações registradas, é fundamental corrigir esses dados antes de prosseguir com o envio.</p>
						<hr>
						<p class="mb-0">Certifique-se de verificar cuidadosamente cada campo preenchido, observando se todas as informações estão corretas e completas.</p>
					</div>

					<?php
					if (!empty($_SESSION['mensagem'])) {
						$mensagem = $_SESSION['mensagem'];

						// Define the messages for specific values
						$specificMessages = array(
							'agencia conta corrente' => 'Digite o número da agência da conta corrente.',
							'conta corrente' => 'Digite o número da conta corrente.',
							'cpf doc' => 'Digite o número do CPF (Cadastro de Pessoa Física).',
							'identidade doc' => 'Digite o número da identidade.',
							'habilitacao doc' => 'Digite o número da habilitação.',
							'ctps doc' => 'Digite o número da Carteira de Trabalho (CTPS).',
							'ctps serie' => 'Digite o número da série da Carteira de Trabalho (CTPS).',
							'digito fgts' => 'Digite o dígito do FGTS (Fundo de Garantia do Tempo de Serviço).',
							'reservista' => 'Digite o número da reservista.',
							'titulo eleitor' => 'Digite o número do título de eleitor.',
							'titulo zona' => 'Digite o número da zona eleitoral.',
							'titulo secao' => 'Digite o número da seção eleitoral.',
							'pis' => 'Digite o número do PIS (Programa de Integração Social).',
							'logradouro' => 'Digite o nome do logradouro.',
							'bairro' => 'Digite o nome do bairro.',
							'cidade' => 'Digite o nome da cidade.',
							'uf' => 'Digite a sigla do estado (UF).',
							'numero' => 'Digite o número referente ao endereço.',
							'telefone_fixo' => 'Digite o número do telefone fixo. Ex: 84 0000-0000',
							'celular' => 'Digite o número do celular. Ex: (84) 00000-0000',
							'cep' => 'Digite o CEP (Código de Endereçamento Postal).'
							// Add more descriptions for other specific values if needed
						);
					?>

						<div id="la" class="alert alert-danger" role="alert">
							<h4 class="alert-heading">Ops! Algo está incompleto!</h4>
							Verifique os seguintes itens:
							<ul>
								<?php
								for ($i = 0; $i < count($mensagem); $i++) {
									$item = $mensagem[$i];
								?>
									<li>
										<?php echo ucfirst($item); ?>
										<?php
										// Check if the specific message exists for the current item in the array
										if (isset($specificMessages[$item])) {
											echo ' - ' . $specificMessages[$item];
										}
										?>
									</li>
								<?php
								}
								?>
							</ul>
							<hr>
							<p class="mb-0">Certifique-se de verificar cuidadosamente cada campo preenchido, observando se todas as informações estão corretas e completas.</p>
						</div>

					<?php
					}
					?>


					<!-- ------------------------------------------------------------------------ -->
					<div id="card-1" class="card mb-4">
						<div class="card-body">
							<form action="user_crud/user_inserir.php" method="POST">
								<h3 class="h6 mb-4">Filiação</h3>
								<div class="mb-3">
									<label class="form-label">Nome do(a) trabalhador(a)</label>
									<input id="nome_trab" type="text" name="nome_trab" class="form-control" value="<?php if (isset($_SESSION['nome_trab'])) {
																														echo $_SESSION['nome_trab'];
																													} else if (isset($_SESSION['nama'])) {
																														echo $_SESSION['nama'];
																													} else {
																														echo "";
																													} ?>" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Nome do pai</label>
									<input id="pai_trab" type="text" name="pai_trab" class="form-control" value="<?php if (isset($_SESSION['pai_trab'])) {
																														echo $_SESSION['pai_trab'];
																													} ?>" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Nome da mãe</label>
									<input id="mae_trab" type="text" name="mae_trab" class="form-control" value="<?php if (isset($_SESSION['mae_trab'])) {
																														echo $_SESSION['mae_trab'];
																													} ?>" required>
								</div>
						</div>

						<!-- ------------------------------------------------------------------------ -->

						<div class="card-body">
							<h3 class="h6 mb-4">Nascimento</h3>
							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Data de nascimento</label>
										<input id="dt_nascimento_trab" type="date" name="dt_nascimento_trab" class="form-control" value="<?php if (isset($_SESSION['dt_nascimento_trab'])) {
																																				echo $_SESSION['dt_nascimento_trab'];
																																			} ?>" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Etnia</label>
										<input id="cor_trab" type="text" name="cor_trab" class="form-control" value="<?php if (isset($_SESSION['cor_trab'])) {
																															echo $_SESSION['cor_trab'];
																														} ?>" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Sexo</label>
										<select id="sexo_trab" name="sexo_trab" class="select2 form-control select2-hidden-accessible" data-select2-placeholder="Select state" data-select2-id="select2-data-4-680y" tabindex="-1" aria-hidden="true" required>
											<option data-select2-id="select2-data-6-cshs"></option>
											<option value="Masculino">Masculino</option>
											<option value="Feminino">Feminino</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Nome social<span style="color: red;"> (Não obrigatório)</span></label>
										<input id="nome_social_trab" type="text" name="nome_social_trab" class="form-control" value="<?php if (isset($_SESSION['nome_social_trab'])) {
																																			echo $_SESSION['nome_social_trab'];
																																		} ?>">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Possui alguma deficiência?</label>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="deficiencia" value="Sim" id="deficiencia-1">
											<label class="form-check-label" for="deficiencia-1">
												Sim
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="deficiencia" value="Não" id="deficiencia-2">
											<label class="form-check-label" for="deficiencia-2">
												Não
											</label>
										</div>
										<div id="especificar-deficiencia" style="display: none;">
											<label class="form-label">Tipo de deficiência</label>
											<input id="tipo_deficiencia_trab" type="text" name="tipo_deficiencia_trab" class="form-control" value="<?php if (isset($_SESSION['tipo_deficiencia_trab'])) {
																																						echo $_SESSION['tipo_deficiencia_trab'];
																																					} ?>">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Nacionalidade</label>
										<input id="nacionalidade_trab" type="text" name="nacionalidade_trab" class="form-control" value="<?php if (isset($_SESSION['nacionalidade_trab'])) {
																																				echo $_SESSION['nacionalidade_trab'];
																																			} ?>" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Chegada ao Brasil<span style="color: red;"> (Não obrigatório se não houver)</span></label>
										<input id="chegada_brasil_trab" type="date" name="chegada_brasil_trab" class="form-control" value="<?php if (isset($_SESSION['chegada_brasil_trab'])) {
																																				echo $_SESSION['chegada_brasil_trab'];
																																			} ?>">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Naturalidade<span style="color: red;"> (Não obrigatório se não houver)</span></label>
										<input id="naturalidade_trab" type="text" name="naturalidade_trab" class="form-control" value="<?php if (isset($_SESSION['naturalidade_trab'])) {
																																			echo $_SESSION['naturalidade_trab'];
																																		} ?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Estado</label>
										<input id="estado_trab" type="text" name="estado_trab" class="form-control" value="<?php if (isset($_SESSION['estado_trab'])) {
																																echo $_SESSION['estado_trab'];
																															} ?>" required>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Tipo sanguíneo</label>
										<select id="tp_sangue" name="tp_sangue" class="select2 form-control select2-hidden-accessible" data-select2-placeholder="Select state" data-select2-id="select2-data-4-680y" tabindex="-1" aria-hidden="true" required>
											<option data-select2-id="select2-data-6-cshs"></option>
											<option value="A+">A+</option>
											<option value="A-">A-</option>
											<option value="B+">B+</option>
											<option value="B-">B-</option>
											<option value="AB+">AB+</option>
											<option value="AB-">AB-</option>
											<option value="O+">O+</option>
											<option value="O-">O-</option>
										</select>
									</div>
								</div>
							</div>

							<div class="mb-3">
								<button id="meu-botao" type="submit" name="save_filiacao" class="btn btn-primary" formaction="user_crud/user_inserir.php">Salvar</button>
								<button id="meu-botao-red" type="submit" name="edit_filiacao" class="btn btn-danger" formaction="user_crud/user_edit.php">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
									</svg>
									Editar
								</button>
							</div>
							</form>
						</div>
					</div>
					<!-- ----------------------------------------------->

					<!-- --------------------------------------------------------------------------- -->
					<div id="card-2" class="documentos card mb-4">
						<div class="card-body">
							<form action="user_crud/user_inserir_doc.php" method="POST">
								<h3 class="h6 mb-4">Documentos</h3>
								<p class="text-danger">* Preencher apenas com números nos campos de números</p>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">CPF</label>
											<input id="cpf_doc" type="text" name="cpf_doc" class="form-control" value="<?php if (isset($_SESSION['cpf_doc'])) {
																															echo $_SESSION['cpf_doc'];
																														} ?>" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
										</div>
									</div>


									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">RG</label>
											<input id="identidade_doc" type="text" name="identidade_doc" class="form-control" value="<?php if (isset($_SESSION['identidade_doc'])) {
																																			echo $_SESSION['identidade_doc'];
																																		} ?>" maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Data de emissão</label>
											<input id="dt_emissao_identidade" type="date" name="dt_emissao_identidade" class="form-control" value="<?php if (isset($_SESSION['dt_emissao_identidade'])) {
																																						echo $_SESSION['dt_emissao_identidade'];
																																					} ?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Órgão do RG</label>
											<input id="orgao_identidade" type="text" name="orgao_identidade" class="form-control" value="<?php if (isset($_SESSION['orgao_identidade'])) {
																																				echo $_SESSION['orgao_identidade'];
																																			} ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Possui habilitação?<span style="color: red;"> (Não obrigatório)</span></label>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="habilitacao" value="Sim" id="habilitacao-1">
												<label class="form-check-label" for="habilitacao-1">
													Sim
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="habilitacao" value="Não" id="habilitacao-2">
												<label class="form-check-label" for="habilitacao-2">
													Não
												</label>
											</div>
										</div>
									</div>
								</div>
								<div id="especificar-habilitacao" style="display: none;">
									<div class="row">
										<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label">Nº da Habilitação</label>
												<input id="habilitacao_doc" type="text" name="habilitacao_doc" class="form-control" value="<?php if (isset($_SESSION['habilitacao_doc'])) {
																																				echo $_SESSION['habilitacao_doc'];
																																			} ?>" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label">Categoria da Habilitação</label>
												<input id="habilitacao_categoria" type="text" name="habilitacao_categoria" class="form-control" value="<?php if (isset($_SESSION['habilitacao_categoria'])) {
																																							echo $_SESSION['habilitacao_categoria'];
																																						} ?>" maxlength="2" pattern="^[a-z]{2}\i$" title="Digite exatamente 2 letras (maiúsculas ou minúsculas)">
											</div>
										</div>

										<div class="col-lg-4">
											<div class="mb-3">
												<label class="form-label">Validade da Habilitação</label>
												<input id="dt_validade_habilitacao" type="date" name="dt_validade_habilitacao" class="form-control" value="<?php if (isset($_SESSION['dt_validade_habilitacao'])) {
																																								echo $_SESSION['dt_validade_habilitacao'];
																																							} ?>">
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">CTPS</label>
											<input id="ctps_doc" type="text" name="ctps_doc" class="form-control" value="<?php if (isset($_SESSION['ctps_doc'])) {
																																echo $_SESSION['ctps_doc'];
																															} ?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Série</label>
											<input id="ctps_serie" type="text" name="ctps_serie" class="form-control" value="<?php if (isset($_SESSION['ctps_serie'])) {
																																	echo $_SESSION['ctps_serie'];
																																} ?>"maxlength="4" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11);">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Carteira reservista</label>
											<input id="reservista" type="text" name="reservista" class="form-control" value="<?php if (isset($_SESSION['reservista'])) {
																																	echo $_SESSION['reservista'];
																																} ?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Registro profissional</label>
											<input id="registro_prof" type="text" name="registro_prof" class="form-control" value="<?php if (isset($_SESSION['registro_prof'])) {
																																		echo $_SESSION['registro_prof'];
																																	} ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Órgão do registro profissional</label>
											<input id="registro_prof_orgao" type="text" name="registro_prof_orgao" class="form-control" value="<?php if (isset($_SESSION['registro_prof_orgao'])) {
																																					echo $_SESSION['registro_prof_orgao'];
																																				} ?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Grau de instrução</label>
											<select id="grau_instrucao" name="grau_instrucao" class="select2 form-control select2-hidden-accessible" data-select2-placeholder="Select state" data-select2-id="select2-data-4-680y" tabindex="-1" aria-hidden="true">
												<option data-select2-id="select2-data-6-cshs"></option>
												<option value="Analfabeto">Analfabeto</option>
												<option value="Ensino fundamental incompleto">Ensino fundamental incompleto</option>
												<option value="Ensino fundamental completo">Ensino fundamental completo</option>
												<option value="Ensino medio incompleto">Ensino médio incompleto</option>
												<option value="Ensino medio completo">Ensino médio completo</option>
												<option value="Superior incompleto">Superior incompleto</option>
												<option value="Superior completo">Superior completo</option>
												<option value="Pos-graduacao">Pós-graduação</option>
												<option value="Mestrado">Mestrado</option>
												<option value="Doutorado">Doutorado</option>
												<option value="Pos-Doutorado">Pós-Doutorado</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nome do titular da conta</label>
											<input id="nome_conta_corrente" type="text" name="nome_conta_corrente" class="form-control" value="<?php if (isset($_SESSION['nome_conta_corrente'])) {
																																					echo $_SESSION['nome_conta_corrente'];
																																				} ?>">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nº da Conta corrente</label>
											<input id="conta_corrente" type="text" name="conta_corrente" class="form-control" value="<?php if (isset($_SESSION['conta_corrente'])) {
																																			echo $_SESSION['conta_corrente'];
																																		} ?>">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Agência da conta</label>
											<input id="agencia_conta_corrente" type="text" name="agencia_conta_corrente" class="form-control" value="<?php if (isset($_SESSION['agencia_conta_corrente'])) {
																																							echo $_SESSION['agencia_conta_corrente'];
																																						} ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nº título de eleitor</label>
											<input id="titulo_eleitor" type="number" name="titulo_eleitor" class="form-control" value="<?php if (isset($_SESSION['titulo_eleitor'])) {
																																			echo $_SESSION['titulo_eleitor'];
																																		} ?>" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Zona</label>
											<input id="titulo_zona" type="text" name="titulo_zona" class="form-control" value="<?php if (isset($_SESSION['titulo_zona'])) {
																																	echo $_SESSION['titulo_zona'];
																																} ?>" maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Seção</label>
											<input id="titulo_secao" type="text" name="titulo_secao" class="form-control" value="<?php if (isset($_SESSION['titulo_secao'])) {
																																		echo $_SESSION['titulo_secao'];
																																	} ?>" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nº do PIS</label>
											<input id="pis" type="text" name="pis" class="form-control" value="<?php if (isset($_SESSION['pis'])) {
																													echo $_SESSION['pis'];
																												} ?>" maxlength="11" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11);">
										</div>
									</div>

									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Data de cadastramento</label>
											<input id="data_cadastramento" type="date" name="data_cadastramento" class="form-control" value="<?php if (isset($_SESSION['data_cadastramento'])) {
																																					echo $_SESSION['data_cadastramento'];
																																				} ?>">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Estado civil</label>
											<select id="tipo_estado_civil" name="tipo_estado_civil" class="select2 form-control select2-hidden-accessible" data-select2-placeholder="Select state" data-select2-id="select2-data-4-680y" tabindex="-1" aria-hidden="true">
												<option data-select2-id="select2-data-6-cshs"></option>
												<option value="Solteiro">Solteiro(a)</option>
												<option value="Casado">Casado(a)</option>
												<option value="Separado">Separado(a)</option>
												<option value="Divorciado">Divorciado(a)</option>
												<option value="Viúvo">Viúvo(a)</option>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nº da conta FGTS</label>
											<input id="conta_fgts" type="number" name="conta_fgts" class="form-control" value="<?php if (isset($_SESSION['conta_fgts'])) {
																																	echo $_SESSION['conta_fgts'];
																																} ?>">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Data de opção</label>
											<input id="data_opcao_fgts" type="date" name="data_opcao_fgts" class="form-control" value="<?php if (isset($_SESSION['data_opcao_fgts'])) {
																																			echo $_SESSION['data_opcao_fgts'];
																																		} ?>">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Banco depositário - FGTS</label>
											<input id="banco_depositario_fgts" type="text" name="banco_depositario_fgts" class="form-control" value="<?php if (isset($_SESSION['banco_depositario_fgts'])) {
																																							echo $_SESSION['banco_depositario_fgts'];
																																						} ?>">
										</div>
									</div>
								</div>
						</div>
						<!-- --------------------------------------------------------------------- -->

						<div class="card-body">
							<h3 class="h6 mb-4">Endereço</h3>
							<div class="mb-3">
								<label class="form-label">Logradouro</label>
								<input id="logradouro" type="text" name="logradouro" class="form-control" value="<?php if (isset($_SESSION['logradouro'])) {
																														echo $_SESSION['logradouro'];
																													} ?>">
							</div>

							<div class="row">
								<div class="col-lg-4">
									<div class="mb-3">
										<label class="form-label">Número</label>
										<input id="numero" type="number" name="numero" class="form-control" value="<?php if (isset($_SESSION['numero'])) {
																														echo $_SESSION['numero'];
																													} ?>" maxlength="10" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10);">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="mb-3">
										<label class="form-label">Complemento<span style="color: red;"> (Não obrigatório)</span></label>
										<input id="complemento" name="complemento" type="text" class="form-control" value="<?php if (isset($_SESSION['complemento'])) {
																																echo $_SESSION['complemento'];
																															} ?>">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="mb-3">
										<label class="form-label">Bairro</label>
										<input id="bairro" type="text" name="bairro" class="form-control" value="<?php if (isset($_SESSION['bairro'])) {
																														echo $_SESSION['bairro'];
																													} ?>">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4">
									<div class="mb-3">
										<label class="form-label">Cidade</label>
										<input id="cidade" type="text" name="cidade" class="form-control" value="<?php if (isset($_SESSION['cidade'])) {
																														echo $_SESSION['cidade'];
																													} ?>">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="mb-3">
										<label class="form-label">UF</label>
										<input id="uf" type="text" name="uf" class="form-control" value="<?php if (isset($_SESSION['uf'])) {
																												echo $_SESSION['uf'];
																											} ?>"maxlength="2" pattern="^[a-z]{2}\i$" title="Digite exatamente 2 letras (maiúsculas ou minúsculas)">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="mb-3">
										<label class="form-label">CEP</label>
										<input id="cep" type="text" name="cep" class="form-control" value="<?php if (isset($_SESSION['cep'])) {
																												echo $_SESSION['cep'];
																											} ?>" maxlength="9" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 9);">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">E-Mail</label>
										<input id="endereco_eletronico" type="email" name="endereco_eletronico" class="form-control" value="<?php if (isset($_SESSION['endereco_eletronico'])) {
																																				echo $_SESSION['endereco_eletronico'];
																																			} ?>">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Telefone</label>
										<input id="telefone_fixo" type="text" name="telefone_fixo" class="form-control" value="<?php if (isset($_SESSION['telefone_fixo'])) {
																																	echo $_SESSION['telefone_fixo'];
																																} ?>" placeholder="Ex.: 84 9999-9999">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label class="form-label">Celular</label>
										<input id="celular" type="text" name="celular" class="form-control" value="<?php if (isset($_SESSION['celular'])) {
																														echo $_SESSION['celular'];
																													} ?>" placeholder="Ex.: 84 99999-9999">
									</div>
								</div>
							</div>
							<div class="mb-3">
								<button id="meu-botao2" type="submit" name="save_filiacao2" class="btn btn-primary" formaction="user_crud/user_inserir.php">Salvar</button>
								<button id="meu-botao-red2" type="submit" name="edit_filiacao2" class="btn btn-danger" formaction="user_crud/user_edit.php">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
									</svg>
									Editar
								</button>
							</div>
							</form>
						</div>
					</div>

					<!-- --------------------------------------------------------------------- -->
					<div class="card text-center">
						<div class="card-header">
							Etapa 1/3
						</div>
						<div class="card-body">
							<h5 class="card-title">Fim da sessão</h5>
							<p class="card-text">Tem certeza de que preencheu corretamente todos os campos acima?</p>
							<a href="user_upload.php" name="salvar_tudo_continuar" class="btn btn-success">Ir para a próxima etapa</a>
						</div>
					</div>
					<!-- --------------------------------------------------------------------- -->
				</div>
			</div>

		</div>
	</div>
	</div>
	</div>
	</div>

	</div>
	<script type="text/javascript" src="js/checar.js"></script>

	<!-- Modal para exibir mensagem de erro-->
	<div class="modal fade" id="insertErrorModal" tabindex="-1" role="dialog" aria-labelledby="insertErrorModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="insertErrorModalLabel">
						<!-- <i class="fas fa-times-circle"></i> -->
						Ops! Você não completou tudo!
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p> Por favor, verifique os campos abaixo.</p>
					<table>
						<u>
							<?php
							$mensagem = $_SESSION['mensagem'];
							if (!empty($mensagem)) {
								for ($i = 0; $i < count($mensagem); $i++) {
							?> <li> <?php
									echo ucfirst($mensagem[$i]);
									?> </li> <?php
											}
										}
												?>
						</u>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			<?php if (isset($_GET['insert_error'])) : ?>
				$('#insertErrorModal').modal('show');
			<?php endif; ?>
		});
	</script>
	</body>

	</html>