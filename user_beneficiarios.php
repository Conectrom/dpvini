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


?>
<script>
    $(document).ready(function() {
        var count = 1; // contador para identificar cada div adicionada
        // Manipulador de evento para o botão "adicionar novo beneficiário"
        $('#adicionar').click(function() {
            var template = $('#template').clone(); // Clona o template
            // Atualiza o id e remove o atributo "hidden" para torná-lo visível
            template.attr('id', 'beneficiario-' + count).removeAttr('hidden');
            // Atualiza o atributo "data-id" do botão "salvar"
            template.find('.salvar').attr('data-id', count);
            // Adiciona a cópia do template na div "beneficiarios-container"
            $('.beneficiarios-container').append(template);
            count++;
        });
    });
</script>


<!-- Importe o JavaScript do Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<title>Adicionar Beneficiário</title>

<body>
    <div class="container-fluid">
        <div class="container">

            <div class="justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                <!-- -->
                <?php
                if (isset($_GET['insert_error'])) {
                    echo '<div id="disclaimer" class="alert alert-danger" role="alert">
                              <h4 class="alert-heading">Aviso! Verifique os dados atribuidos!</h4>
                              <p>';

                    if (isset($_SESSION['resposta']) && !empty($_SESSION['resposta'])) {
                        foreach ($_SESSION['resposta'] as $mensagem) {
                            echo '<span class="error-message">' . $mensagem . '</span><br>';
                        }
                        $_SESSION['resposta'] = []; // Limpa o array após exibir as mensagens
                    }

                    echo '</p>
                          <hr>
                          <p class="mb-0">Certifique-se de verificar cuidadosamente cada campo preenchido, observando se todas as informações estão corretas e completas.</p>
                          </div>';
                } else if (!isset($_GET['insert_error'])) {
                ?>
                    <div id="disclaimer" class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Bem-vindo à página de beneficiários!</h4>
                        <p>Aqui você pode cadastrar os seus dependentes. Caso não possua dependentes, não se preocupe, você pode pular esta etapa e finalizar a inscrição.<br>
                            É importante preencher corretamente cada campo abaixo, verificando cuidadosamente se todas as informações estão corretas e completas.</p>
                        <hr>
                        <p class="mb-0">Certifique-se de verificar cuidadosamente cada campo preenchido, observando se todas as informações estão corretas e completas.</p>
                    </div>
                <?php } ?>
                <!-- <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Ficha de beneficiários</h2> -->
            </div>
            <div class="card mb-4">
                <button id="adicionar" type="button" class="btn btn-success btn-lg btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    Adicionar novo beneficiário</button>
            </div>
            <div class="beneficiarios-container">
                <!-- Aqui serão adicionadas as divs dinamicamente -->
            </div>
            <?php
            include_once('koneksi.php');

            $usuario = $_SESSION['id_usuarios']; // Número do usuário
            // Consulta os beneficiários do usuário especificado
            $query = "SELECT * FROM tb_beneficiarios WHERE tb_beneficiarios_id_usuario = $usuario";
            $result = mysqli_query($koneksi, $query);

            ?>
            <div class="card mb-4" style="background-color: #ffffff;"> <br>
                <div class="col-lg-4">
                    <h2 class="h5 mb-4">Ficha de beneficiários</h2>
                </div>

                <?php
                // Gera os containers HTML com os inputs preenchidos
                while ($row = mysqli_fetch_assoc($result)) {
                    $nome = $row['nome_ben'];
                    $cpf = $row['cpf_ben'];
                    $parentesco = $row['parentesco_ben'];
                    $dataNascimento = $row['dt_nascimento_ben'];

                ?>
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mb-4" style="background-color: #dcf2de;">
                                        <div class="card-body">

                                            <form method="POST" action="user_beneficiario/beneficiario_crud.php">
                                                <h3 class="h6 mb-4">Beneficiário</h3>
                                                <div class="mb-3">
                                                    <label class="form-label">Nome do beneficiário</label>
                                                    <input type="text" name="nome_ben" class="form-control" value="<?php echo $nome; ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">CPF do beneficiário</label>
                                                    <input type="text" name="cpf_ben" class="form-control" value="<?php echo $cpf; ?>" readonly>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Parentesco</label>
                                                            <input type="text" name="parentesco_ben" class="form-control" value="<?php echo $parentesco; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Data de nascimento</label>
                                                            <input type="text" name="dt_nascimento_ben" class="form-control" value="<?php echo $dataNascimento; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" name="delete_beneficiario" class="btn btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                        Excluir beneficiário
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mb-4" style="background-color: #dcf2de;">
                                        <div class="card-body">
                                            <h3 class="h6 mb-4">Arquivos</h3>
                                            <table class="table table-bordered table-hover table-striped" style="background-color: #fff;">
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Status</th>
                                                </tr>
                                                <tr>
                                                    <td>Certidão de nascimento</td>
                                                    <td>Enviado</td>
                                                </tr>
                                                <tr>
                                                    <td>Cartão do SUS</td>
                                                    <td>Enviado</td>
                                                </tr>
                                                <tr>
                                                    <td>Cartão de Vacina</td>
                                                    <td>Enviado</td>
                                                </tr>
                                                <tr>
                                                    <td>Declaração Escolar</td>
                                                    <td>Enviado</td>
                                                </tr>
                                                <tr>
                                                    <td>RG e CPF do dependente</td>
                                                    <td>Enviado</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }

                mysqli_close($koneksi);
                ?>

                <!-- Template oculto -->
                <div id="template" hidden>
                    <!-- Seu código HTML completo do bootstrap aqui -->
                    <form action="user_beneficiario/beneficiario_crud.php" method="post" enctype="multipart/form-data">
                        <div class="container">

                            <!-- ------------------------------------------------------------------------ -->
                            <div class="row">
                                <div class="col-lg-7 mb-4 card">
                                    <div class="card-body">
                                        <h3 class="h6 mb-4">Beneficiário</h3>
                                        <div class="mb-3">
                                            <label class="form-label">Nome do beneficiário</label>
                                            <input type="text" name="nome_ben" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">CPF do beneficiário</label>
                                            <input type="text" name="cpf_ben" class="form-control" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Parentesco</label>
                                                    <input type="text" name="parentesco_ben" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Data de nascimento</label>
                                                    <input type="date" name="dt_nascimento_ben" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-danger">* Anexe os arquivos (em PDF) apenas se o filho for menor de 14 anos.</p>
                                        <input type="submit" name="save_beneficiario" class="btn btn-primary" value="Salvar">
                                    </div>
                                </div>

                                <div class="col-lg-5 card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="custom-file">
                                                <input class="custom-file-input" id="customFile" type="file" name="certidao_beneficiarios">
                                                <label class="custom-file-label" for="customFile">Certidão de Nascimento</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="custom-file">
                                                <input class="form-control custom-file-input" id="customFileLang" type="file" name="cartao_sus_beneficiarios">
                                                <label class="custom-file-label" for="customFileLang">Cartão do SUS</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="custom-file">
                                                <input class="form-control custom-file-input" id="customFileLang" type="file" name="cartao_vacina_beneficiarios">
                                                <label class="custom-file-label" for="customFileLang">Cartão de Vacina</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="custom-file">
                                                <input class="form-control custom-file-input" id="customFileLang" type="file" name="declaracao_beneficiarios">
                                                <label class="custom-file-label" for="customFileLang">Declaração Escolar</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="custom-file">
                                                <input class="form-control custom-file-input" id="customFileLang" type="file" name="rg_beneficiarios">
                                                <label class="custom-file-label" for="customFileLang">RG e CPF do dependente</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </form>
            <div class="card text-center">
                <div class="card-header">
                    Etapa 3/3
                </div>
                <div class="card-body">
                    <h5 class="card-title">Fim do cadastro</h5>
                    <p class="card-text">Ao clicar no botão, você confirma que preencheu corretamente todos os campos acima. Esta é a etapa final do cadastro e suas informações serão salvas. Se você precisa fazer alguma alteração, clique em "Voltar" para retornar ao formulário anterior.</p>
                    <p class="card-text">Por favor, verifique todas as informações antes de concluir o processo. Caso seja feito o envio, não será mais possível retornar.</p>
                    <button id='botao' type='submit' name='view' class='btn btn-warning' data-toggle='modal' data-target='.modaluser'> Finalizar o cadastro e enviar </button>
                    <a href="user_upload.php" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <!-- ------------------------------------------------------------------------ -->
    </div>
    </div>

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
                            $mensagem = $_SESSION['resposta_ben'];
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

    <!-- Modal -->
    <div class="modal fade modaluser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginErrorModalLabel">
                        Tem certeza que deja finalizar o cadastro?
                        <i class="fasfa-times-circle"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Antes de prosseguir, confirme seu cadastro com segurança. Tem certeza de que deseja finalizar o processo agora?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    <form action="user_crud/user_finalizar.php" method="POST" enctype="multipart/form-data">
                        <input type="submit" name="user_finalizar" class="btn btn-success" value="Finalizar cadastro e fechar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script>
    $(document).ready(function() {
        <?php if (isset($_GET['insert_error'])) : ?>
            $('#insertErrorModal').modal('show');
        <?php endif; ?>
    });
</script>

</html>