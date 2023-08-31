<div class="modal fade modaleditar" tabindex="-1" role="dialog" aria-labelledby="modaluserLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modaluserLabel"> Edição de dados do usuário</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="trabalhador_id" name="trabalhador_id" value="">
				<div class="container">
					<ul class="nav nav-tabs">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Índice</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">Trabalhador</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu2">Documentos</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu3">Endereço</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu4">Contrato</a></li>
					</ul>

					<div class="tab-content">
						<div id="home" class="tab-pane fade show active">
							<div id="disclaimer" class="alert alert-success" role="alert" style="margin: 17px;">
								<h4 class="alert-heading">Bem-vindo à página de edição!</h4>
								<p>Aqui você pode atribuir novos dados nos campos que deseja substituir para o usuário. Caso não haja necessidade de alterar algum campo, basta deixá-lo em branco.<br>
									É importante preencher corretamente e especificamente o campo abaixo que deseja modificar, verificando cuidadosamente se todas as informações estão corretas e completas.</p>
							</div>
						</div>
						<div id="menu1" class="tab-pane fade">
							<form action="user_crud/user_inserir_doc.php" method="POST">
								<div class="card-body">
									<h3 class="h6 mb-4">Filiação</h3>
									<div class="mb-3">
										<input type="hidden" id="" class="trabalhador_id_1" name="trabalhador_id_1" value="">
										<label class="form-label">Nome do(a) trabalhador(a)</label>
										<input id="nome_trab" type="text" name="nome_trab" class="form-control" value="">
									</div>
									<div class="mb-3">
										<label class="form-label">Nome do pai</label>
										<input id="pai_trab" type="text" name="pai_trab" class="form-control" value="">
									</div>
									<div class="mb-3">
										<label class="form-label">Nome da mãe</label>
										<input id="mae_trab" type="text" name="mae_trab" class="form-control" value="">
									</div>
								</div>

								<!-- ------------------------------------------------------------------------ -->

								<div class="card-body">
									<h3 class="h6 mb-4">Nascimento</h3>
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Data de nascimento</label>
												<input id="dt_nascimento_trab" type="date" name="dt_nascimento_trab" class="form-control" value="">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Etnia</label>
												<input id="cor_trab" type="text" name="cor_trab" class="form-control" value="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Sexo</label>
												<select id="sexo_trab" name="sexo_trab" class="select2 form-control select2-hidden-accessible" data-select2-placeholder="Select state" data-select2-id="select2-data-4-680y" tabindex="-1" aria-hidden="true">
													<option data-select2-id="select2-data-6-cshs"></option>
													<option value="Masculino">Masculino</option>
													<option value="Feminino">Feminino</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Nome social</label>
												<input id="nome_social_trab" type="text" name="nome_social_trab" class="form-control" value="">
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Possui alguma deficiência?</label>
												<select id="deficiente_trab" name="deficiente_trab" class="select2 form-control select2-hidden-accessible" data-select2-placeholder="Select state" data-select2-id="select2-data-4-680y" tabindex="-1" aria-hidden="true">
													<option data-select2-id="select2-data-6-cshs"></option>
													<option value="Sim">Sim</option>
													<option value="Nao">Não</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Tipo de deficiência (se houver)</label>
												<input id="tipo_deficiencia_trab" type="text" name="tipo_deficiencia_trab" class="form-control" value="">
											</div>
										</div>
									</div>



									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Nacionalidade</label>
												<input id="nacionalidade_trab" type="text" name="nacionalidade_trab" class="form-control" value="">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Chegada ao Brasil</label>
												<input id="chegada_brasil_trab" type="date" name="chegada_brasil_trab" class="form-control" value="">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Naturalidade</label>
												<input id="naturalidade_trab" type="text" name="naturalidade_trab" class="form-control" value="">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Estado</label>
												<input id="estado_trab" type="text" name="estado_trab" class="form-control" value="">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Tipo sanguíneo</label>
												<select id="tp_sangue" name="tp_sangue" class="select2 form-control select2-hidden-accessible" data-select2-placeholder="Select state" data-select2-id="select2-data-4-680y" tabindex="-1" aria-hidden="true">
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
										<button id="meu-botao-red" type="submit" name="edit_filiacao" class="btn btn-primary" formaction="admin_crud/admin_edit.php">
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
					<!-- ------------------------------------------------------ -->
					<div id="menu2" class="tab-pane fade">
						<div class="card-body">
							<form action="user_crud/user_inserir_doc.php" method="POST">
								<h3 class="h6 mb-4">Documentos</h3>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<input type="hidden" id="" class="trabalhador_id_2" name="trabalhador_id_2" value="">
											<label class="form-label">CPF</label>
											<input id="cpf_doc" type="number" name="cpf_doc" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Cédula de identidade</label>
											<input id="identidade_doc" type="text" name="identidade_doc" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Data de emissão</label>
											<input id="dt_emissao_identidade" type="date" name="dt_emissao_identidade" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Órgão</label>
											<input id="orgao_identidade" type="text" name="orgao_identidade" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-3">
										<div class="mb-3">
											<label class="form-label">Possui habilitação?</label>
											<select id="habilitacao_radio" name="habilitacao_radio" class="select2 form-control select2-hidden-accessible" data-select2-placeholder="Select state" data-select2-id="select2-data-4-680y" tabindex="-1" aria-hidden="true">
												<option data-select2-id="select2-data-6-cshs"></option>
												<option value="Sim">Sim</option>
												<option value="Não">Não</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="mb-3">
											<label class="form-label">Habilitação</label>
											<input id="habilitacao_doc" type="text" name="habilitacao_doc" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-3">
										<div class="mb-3">
											<label class="form-label">Categoria</label>
											<input id="habilitacao_categoria" type="text" name="habilitacao_categoria" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-3">
										<div class="mb-3">
											<label class="form-label">Validade</label>
											<input id="dt_validade_habilitacao" type="date" name="dt_validade_habilitacao" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">CTPS</label>
											<input id="ctps_doc" type="text" name="ctps_doc" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Série</label>
											<input id="ctps_serie" type="text" name="ctps_serie" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Dígito</label>
											<input id="digito_fgts" type="text" name="digito_fgts" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Carteira reservista</label>
											<input id="reservista" type="text" name="reservista" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Registro profissional</label>
											<input id="registro_prof" type="text" name="registro_prof" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Órgão</label>
											<input id="registro_prof_orgao" type="text" name="registro_prof_orgao" class="form-control" value="">
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
												<option value="Superior completo (ou graduacao)">Superior completo (ou graduação)</option>
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
											<label class="form-label">Nº título de eleitor</label>
											<input id="titulo_eleitor" type="number" name="titulo_eleitor" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Zona</label>
											<input id="titulo_zona" type="text" name="titulo_zona" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Seção</label>
											<input id="titulo_secao" type="text" name="titulo_secao" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nome do titular da conta</label>
											<input id="nome_conta_corrente" type="text" name="nome_conta_corrente" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nº da Conta corrente</label>
											<input id="conta_corrente" type="text" name="conta_corrente" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Agência da conta</label>
											<input id="agencia_conta_corrente" type="text" name="agencia_conta_corrente" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nº do PIS</label>
											<input id="pis" type="number" name="pis" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Data de cadastramento</label>
											<input id="data_cadastramento" type="date" name="data_cadastramento" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Estado civil</label>
											<input id="tipo_estado_civil" name="tipo_estado_civil" type="text" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Nº da conta FGTS</label>
											<input id="conta_fgts" type="number" name="conta_fgts" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Data de opção</label>
											<input id="data_opcao_fgts" type="date" name="data_opcao_fgts" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Banco depositário - FGTS</label>
											<input id="banco_depositario_fgts" type="text" name="banco_depositario_fgts" class="form-control" value="">
										</div>
									</div>
								</div>
								<div class="mb-3">
									<button id="meu-botao-red" type="submit" name="edit_documentos" class="btn btn-primary" formaction="admin_crud/admin_edit.php">
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
					<!-- ------------------------------------------------------ -->
					<div id="menu3" class="tab-pane fade">
						<div class="card-body">
							<form method="POST">
								<h3 class="h6 mb-4">Endereço</h3>
								<div class="mb-3">
									<label class="form-label">Endereço</label>
									<input type="hidden" id="" class="trabalhador_id_3" name="trabalhador_id_3" value="">
									<input id="logradouro" type="text" name="logradouro" class="form-control" value="">
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Número</label>
											<input id="numero" type="number" name="numero" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Complemento</label>
											<input id="tp_complemento" name="tp_complemento" type="text" name="tp_complemento" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Bairro</label>
											<input id="bairro" type="text" name="bairro" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Cidade</label>
											<input id="cidade" type="text" name="cidade" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Estado</label>
											<input id="uf" type="text" name="uf" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">CEP</label>
											<input id="cep" type="text" name="cep" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Endereço eletrônico</label>
											<input id="endereco_eletronico" type="text" name="endereco_eletronico" class="form-control" value="">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Telefone</label>
											<input id="telefone_fixo" type="text" name="telefone_fixo" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Celular</label>
											<input id="celular" type="text" name="celular" class="form-control" value="">
										</div>
									</div>
								</div>
								<div class="mb-3">
									<button id="meu-botao-red" type="submit" name="edit_endereco" class="btn btn-primary" formaction="admin_crud/admin_edit.php">
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

					<!-- ------------------------------------>

					<div id="menu4" class="tab-pane fade">
						<div class="card-body">
							<form method="POST">
								<h3 class="h6 mb-4">Contrato</h3>
								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<input type="hidden" id="" class="trabalhador_id_4" name="trabalhador_id_4" value="">
											<label class="form-label">Data de admissão</label>
											<input id="dt_admissao" type="date" name="dt_admissao" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Data de registro</label>
											<input id="dt_registro" type="date" name="dt_registro" class="form-control" value="">
										</div>
									</div>
								</div>

								<!-- -->

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Função</label>
											<input id="funcao" type="text" name="funcao" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">CBO</label>
											<input id="cbo" type="text" name="cbo" class="form-control" value="">
										</div>
									</div>
								</div>

								<!-- -->

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Salário Inicial R$</label>
											<input id="salario_inicial" type="text" name="salario_inicial" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Forma de pagamento</label>
											<input id="forma_pagamento" type="text" name="forma_pagamento" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Tipo de pagamento</label>
											<input id="tipo_pagamento" type="text" name="tipo_pagamento" class="form-control" value="">
										</div>
									</div>
								</div>

								<!-- -->

								<div class="row">
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Insalubrida</label>
											<input id="insalubrida" type="text" name="insalubrida" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Periculosidade</label>
											<input id="periculosidade" type="text" name="periculosidade" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<label class="form-label">Comissão</label>
											<input id="comissao" type="text" name="comissao" class="form-control" value="">
										</div>
									</div>
								</div>

								<!-- -->

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Categoria</label>
											<input id="categoria" type="text" name="categoria" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Sindicato</label>
											<input id="sindicato" type="text" name="sindicato" class="form-control" value="">
										</div>
									</div>
								</div>

								<!-- -->

								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Centro de custo</label>
											<input id="centro_custo" type="text" name="centro_custo" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Localização</label>
											<input id="localizacao" type="text" name="localizacao" class="form-control" value="">
										</div>
									</div>
								</div>

								<!-- -->

								<div class="mb-3">
									<label class="form-label">Horário</label>
									<input id="horario" type="text" name="horario" class="form-control" value="">
								</div>
								<div class="mb-3">
									<button id="meu-botao-red" type="submit" name="edit_contrato" class="btn btn-primary" formaction="admin_crud/admin_edit.php">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
											<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
											<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
										</svg>
										Editar
									</button>
								</div>
						</div>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Fechar</button>
		</div>
	</div>
</div>
</div>