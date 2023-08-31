<?php
$directory = "../user_upload/";
$id_usuario = $_SESSION['nama']; // substitua pelo nome do usuário desejado

$fileFields = [
    'antecedentes_upload',
    'ctps_upload',
    'rg_upload',
    'cpf_upload',
    'cnh_upload',
    'reservista_upload',
    'titulo_eleitor_upload',
    'fotos_upload',
    'comprovante_upload',
    'certidao_upload',
    'cartao_sus_upload',
    'cartao_vacina_upload',
    'declaracao_upload',
    'cartao_bancario_upload',
    'certificados_upload',
    'registro_upload'
];

$fieldNames = [
    'Antecedente Criminal',
    'CTPS e PIS',
    'RG',
    'CPF',
    'CNH',
    'Reservista',
    'Titulo de Eleitor',
    'Foto 3x4',
    'Comprovante de Residencia',
    'Certidao de Nascimento-Casamento',
    'Cartao do SUS',
    'Cartao de Vacinacao',
    'Registro de Escolaridade',
    'Cartao de Conta Bancaria',
    'Certificados de Curso Especifico',
    'Registro CREA-CRA-COREM'
];

$fieldNames_user = [
    'Antecedente Criminal - ' . $id_usuario,
    'CTPS e PIS - ' . $id_usuario,
    'RG - ' . $id_usuario,
    'CPF - ' . $id_usuario,
    'CNH - ' . $id_usuario,
    'Reservista - ' . $id_usuario,
    'Titulo de Eleitor - ' . $id_usuario,
    'Foto 3x4 - ' . $id_usuario,
    'Comprovante de Residencia - ' . $id_usuario,
    'Certidao de Nascimento-Casamento - ' . $id_usuario,
    'Cartao do SUS - ' . $id_usuario,
    'Cartao de Vacinacao - ' . $id_usuario,
    'Registro de Escolaridade - ' . $id_usuario,
    'Cartao de Conta Bancaria - ' . $id_usuario,
    'Certificados de Curso Especifico - ' . $id_usuario,
    'Registro CREA-CRA-COREM - ' . $id_usuario
];

$mensagens = [
    ' (obrigatório) <br>* Envie em PDF.',
    ' (obrigatório) <br>* Envie em PDF, com uma foto frente e verso do documento escaneado se for um documento físico.',
    ' (obrigatório) <br>* Envie em PDF, com uma foto frente e verso do documento escaneado.',
    ' (obrigatório) <br>* Envie em PDF, com uma foto frente e verso do documento escaneado.',
    ' (obrigatório) <br>* Envie em PDF, com uma foto frente e verso do documento escaneado.',
    ' <br>* Campo obrigatório caso masculino. Se feminino, envie apenas se tiver. Envie em formato PDF.',
    ' (obrigatório) <br>* Envie em PDF, com uma foto frente e verso do documento escaneado.',
    ' (obrigatório) <br>* Envie apenas em formato JPG uma foto recente estilo 3x4.',
    ' (obrigatório) <br>* Envie em formato PDF um arquivo que seja um dos 3 últimos comprovantes recebidos.',
    ' (obrigatório) <br>* Envie em PDF.',
    ' (obrigatório) <br>* Envie em PDF',
    ' (obrigatório) <br>* dT/Hepatite B/Tríplice Viral/Covid-19.',
    ' (obrigatório) <br>* Histórico escolar ou certificado de conclusão do curso.',
    ' (obrigatório) <br>* Envie em PDF, um documento com o endereço da conta poupança ou corrente vinculada em seu nome.',
    ' (Não obrigatório dependendo da função) <br>* Envie em PDF e frente e verso os Certificados de Cursos Específicos de acordo com a função como cursos técnicos, profissionalizante e NRs.',
    ' (Não obrigatório dependendo da função) <br>* Envie em PDF o Registro de Conselho de classe (CREA, CRA, COREM).'
];

$userDirectory2 = "./user_upload/" . $id_usuario . '/';
$userDirectory = $directory . $id_usuario . '/';

// Verifica se o diretório do usuário existe

$result = [];

if (is_dir($userDirectory2)) {

    // Lê todos os arquivos do diretório do usuário
    $files = scandir($userDirectory2);

    // Remove os elementos "." e ".." do array
    $files = array_diff($files, array('.', '..'));

    // Criar um array associativo para armazenar os resultados
    $result = array_fill_keys($fieldNames_user, false);

    // Verifica se o nome de algum arquivo corresponde ao array de nomes desejados
    foreach ($files as $file) {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        if (in_array($fileName, $fieldNames_user)) {
            $result[$fileName] = true;
        }
    }
}
// Exibe o resultado em uma página Bootstrap

if (!isset($_POST['user_upload_file'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Lista de Arquivos</title>
        <!-- Inclua os links para o Bootstrap aqui -->
    </head>
    <body>
        <div class="container">
            <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a>Lista de arquivos</h2>
            </div>
            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th>Tipo de arquivo</th>
                        <th>Enviado?</th>
                        <th>Upload</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="user_crud/user_upload_file.php" method="post" enctype="multipart/form-data">
                        <?php
                        if (empty($result)) {
                            foreach ($fieldNames_user as $fieldName) {
                                $result[$fieldName] = false;
                            }
                        }
                        $i = 0;
                        foreach ($result as $fieldName => $containsFile) {
                            $itemName = substr($fieldName, 0, strpos($fieldName, '-'));
                            $index = array_search($fieldName, $fieldNames_user); // Obter o índice correspondente
                            echo "<tr" . ($containsFile ? ' style="background-color: #dcf2de;"' : '') . ">";
                            echo "<td>" . $itemName . '<span style="color: red;">' . $mensagens[$index] . "</span></td>"; // Adicionar $mensagens[$index] ao final do campo
                            echo "<td>" . ($containsFile ? "Sim" : "Não") . "</td>";
                            echo '<td><div class="custom-file">
                                <input type="file" accept=".pdf, .jpg" name="' . $fileFields[$i] . '" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Escolher arquivo</label>
                                </div></td>';
                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </form>
                </tbody>
            </table>
        </div>
    </body>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    </html>
<?php
}
?>