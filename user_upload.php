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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body>
    <div class="container-fluid">
        <div class="container">
            <!-- ------------------------------------------------------------------- -->

            <?php
            $id_usuario = $_SESSION['id_usuarios'];
            $sql = 'SELECT * FROM tb_observacao WHERE tb_observacao_id_trab = ' . $id_usuario;
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                // Exibe os dados encontrados
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">';
                    echo '<div id="disclaimer" class="alert alert-danger" role="alert">';
                    echo '<h4 class="alert-heading">Atenção! Ajeite a sua documentação!</h4>';
                    echo '<p>' . $row['observacao'] . '</p>';
                    echo '<hr>';
                    echo '<p class="mb-0">Faça as alterações nos campos necessários.</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">';
                echo '<div id="disclaimer" class="alert alert-success" role="alert">';
                echo '<h4 class="alert-heading">Bem-vindo à página de envio de documentação!</h4>';
                echo '<p>Aqui você pode enviar os documentos pessoais necessários para o cadastro.</p>';
                echo ' <p>Caso prefira, você pode enviar documentação por documentação e clicar em <span style="color: red;">"Enviar documento"</span>. Ao final de tudo, caso já tenha enviado todos, clique em <span style="color: red;">"Ir para a próxima etapa"</span> para prosseguir com a próxima etapa do processo.</p>';
                echo '<hr>';
                echo '<p class="mb-0">Lembrando que é de extrema importância que todas as informações estejam corretas e legíveis nos documentos enviados.</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>


            <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Documentos</h2>
            </div>

            <form action="user_crud/user_upload_file.php" method="post" enctype="multipart/form-data">
                <div class="card mb-4">
                    <?php include('user_crud/user_upload_view2.php'); ?>
                    <input type="submit" class="btn btn-success btn-lg btn-block" value="Enviar o documento" name="user_upload_file">
                </div>

                <div class="card text-center">
                    <div class="card-header">
                        Etapa 2/3
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Fim da sessão</h5>
                        <p class="card-text">Tem certeza de que preencheu corretamente todos os campos acima?</p>
                        <!-- <a href="user_beneficiarios.php" name="user_upload_file" class="btn btn-success">Salvar tudo e continuar</a> -->
                        <a href="user_beneficiarios.php" name="salvar_tudo_continuar" class="btn btn-success">Ir para a próxima etapa</a>
                        <a href="home_user.php" class="btn btn-primary">Voltar</a>
                    </div>
                </div>

                <!-- --------------------------------------------------- -->


            </form>


        </div>
    </div>

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
                            $resposta = $_SESSION['resposta'];
                            if (!empty($resposta)) {
                                for ($i = 0; $i < count($resposta); $i++) {
                            ?> <li> <?php
                                    echo ucfirst($resposta[$i]);
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