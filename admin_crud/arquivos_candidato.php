<?php
include('../koneksi.php');

$directory = "../user_upload/";
if (isset($_POST['arquivo_candidato'])) {
    $arquivoCandidato = $_POST['arquivo_candidato'];

    $sql = "SELECT * FROM tb_login WHERE id_usuarios = '$arquivoCandidato'";

    // Executa a consulta
    $result = $koneksi->query($sql);

    // Verifica se a consulta retornou resultados
    if ($result && $result->num_rows > 0) {
        // Obtém o nome da pessoa e armazena em $nome_pessoa
        $row = $result->fetch_assoc();
        $nome_pessoa = $row['nama'];
    }

    $usuario = $row['nama'];

    // Verifica se o diretório do usuário existe
    if (is_dir($directory . $usuario)) {
        // Cria um arquivo ZIP temporário
        $zipFile = tempnam(sys_get_temp_dir(), 'download_');
        $zip = new ZipArchive();
        $zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Função para adicionar arquivos/diretórios ao arquivo ZIP
        function addFilesToZip($dir, $zip, $baseDir = '')
        {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $path = $dir . '/' . $file;
                    $localPath = ($baseDir == '') ? $file : $baseDir . '/' . $file;
                    if (is_dir($path)) {
                        $zip->addEmptyDir($localPath);
                        addFilesToZip($path, $zip, $localPath);
                    } else {
                        $zip->addFile($path, $localPath);
                    }
                }
            }
        }

        // Adiciona os arquivos/diretórios ao arquivo ZIP
        addFilesToZip($directory . $usuario, $zip);

        // Fecha o arquivo ZIP
        $zip->close();

        // Envia o arquivo ZIP para o navegador
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $usuario . '.zip"');
        header('Content-Length: ' . filesize($zipFile));
        readfile($zipFile);

        // Remove o arquivo ZIP temporário
        unlink($zipFile);
    } else {
        echo "Diretório do usuário não encontrado";
    }
} else {
    echo "Arquivo_candidato não foi enviado via POST.";
}
