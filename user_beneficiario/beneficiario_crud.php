<?php
session_start();
include('../koneksi.php');

$id_usuario = $_SESSION['id_usuarios']; // Número do usuário
$directory = "../user_upload/"; // caminho base

function clear($input, $koneksi)
{
    if (!$koneksi || !$koneksi->ping()) {
        return $var = null;
    }

    $var = mysqli_real_escape_string($koneksi, $input);
    $var = htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
    return $var;
}

$fileFields = [
    'certidao_beneficiarios',
    'cartao_sus_beneficiarios',
    'cartao_vacina_beneficiarios',
    'declaracao_beneficiarios',
    'rg_beneficiarios',
];

$fieldNames = [
    'Certidao de Nascimento',
    'Cartao do SUS',
    'RG',
    'CPF',
    'CNH',
];

$fieldNames_user = [
    'Certidao de Nascimento - ' . $id_usuario,
    'Cartao do SUS - ' . $id_usuario,
    'RG - ' . $id_usuario,
    'CPF - ' . $id_usuario,
    'CNH - ' . $id_usuario
];


$filtro_date = "/^\d{4}\-\d{2}\-\d{2}$/";
$filtro_text = "/^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/i";
$filtro_num = "/^[0-9]+[\-.(]*$/i";

if (isset($_POST['save_beneficiario'])) {

    $save_beneficiario = array(
        'nome_ben' => clear($_POST['nome_ben'], $koneksi),
        'cpf_ben' => clear($_POST['cpf_ben'], $koneksi),
        'parentesco_ben' => clear($_POST['parentesco_ben'], $koneksi),
        'dt_nascimento_ben' => clear($_POST['dt_nascimento_ben'], $koneksi)
    );

    foreach ($save_beneficiario as $chave => $valor) {
        if ($chave != 'dt_nascimento_ben') {
            if ($chave == "cpf_ben") {
                $teste[$chave] = preg_match($filtro_num, $valor);
            } else {
                $teste[$chave] = preg_match($filtro_text, $valor);
            }
        } else {
            $teste[$chave] = preg_match($filtro_date, $valor);
        }
    }

    $save_ben_string = implode(", ", array_keys($save_beneficiario));

    foreach ($save_beneficiario as $chave => $valor) {
        $valores[] = "'" . mysqli_real_escape_string($koneksi, $valor) . "'";
    }
    $valores_para_sql = implode(", ", $valores);

    if (in_array(0, $teste) || in_array(false, $teste)) {
        foreach ($teste as $chave => $valor) {
            if ($valor == 0 || $valor == false) {
                $resposta[] = str_replace("_trab", "", $chave);
            }
        }
        $sql_ben = false;
        $stmt_ben = false;
    } else {
        $sql_ben = "INSERT INTO tb_beneficiarios ($save_ben_string, tb_beneficiarios_id_usuario) VALUES ($valores_para_sql, $id_usuario)";
        $stmt_ben = mysqli_prepare($koneksi, $sql_ben);
    }

    $uploadOk = 1; // variável para controle

    // Cria o diretório "user_upload/" se ele não existir
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }

    $nome_usuario = $_SESSION['nama'];
    $userDirectory = $directory . "/" . $nome_usuario . "/" . $save_beneficiario['nome_ben'] . "/";
    if (!file_exists($userDirectory)) {
        mkdir($userDirectory, 0777, true);
    }

    foreach ($fileFields as $i => $fieldName) {
        $file = $_FILES[$fieldName];
        $targetFile = basename($file["name"]); // obtém o nome completo do arquivo
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // obtém a extensão do arquivo
        $newFileName = $fieldNames[$i] . " - " . $nome_usuario . "." . $fileType;
        $destination = $userDirectory . $newFileName;

        if (file_exists($destination)) {
            $hash1 = md5_file($destination);
            $hash2 = md5_file($file["tmp_name"]);
            if ($hash1 === $hash2) {
                $resposta[] = "Desculpe, o arquivo " . $targetFile . " já foi adicionado.";
                $uploadOk = 0;
            }
        } else {
            $uploadOk = 1;
        }

        if ($uploadOk != 0) {
            if (empty($targetFile)) {
                if (isset($result[$fieldNames_user[$i]]) && $result[$fieldNames_user[$i]]) {
                    $uploadOk = true;
                    continue;
                } else {
                    $resposta[] = $fieldNames[$i];
                    $uploadOk = 0;
                }
            }
        }

        if ($uploadOk != 0) {
            if ($file["size"] > 500000) {
                $resposta[] = "Desculpe, o arquivo " . $targetFile . " é muito grande.";
                $uploadOk = 0;
            }
        }

        if ($uploadOk != 0) {
            $allowedExtensions = ["pdf"];
            if (!in_array($fileType, $allowedExtensions)) {
                $resposta[] = "Desculpe, apenas arquivos PDF são permitidos para o campo " . $fieldNames[$i] . ".<br>";
                $uploadOk = 0;
            }
        }

        if ($uploadOk == 0) {
            $_SESSION['resposta_ben'] = $resposta;
        } else if ($uploadOk = 1) {
            move_uploaded_file($file["tmp_name"], $destination);
        }
        $uploadOk = 1;
    }

    if (isset($resposta) && !empty($resposta)) {
        echo '<script>window.location.href = "../user_beneficiarios.php?insert_error";</script>';
    } else {
        $_SESSION['resposta_ben'] = [];
        $insert_ben = mysqli_stmt_execute($stmt_ben);
        echo '<script>window.location.href = "../user_beneficiarios.php?insert_sucess";</script>';
    }
} else {
    $resposta[] = "O formulário não foi enviado.";
}

if (isset($_POST['delete_beneficiario'])) {

    $cpf_ben = $_POST['cpf_ben'];
    $nome_ben = $_POST['nome_ben'];

    $nome_usuario = $_SESSION['nama'];
    $userDirectory_del = $directory . "/" . $nome_usuario . "/" . $nome_ben . "/";

    $sql_del_ben = "DELETE FROM tb_beneficiarios WHERE cpf_ben = '$cpf_ben' AND tb_beneficiarios_id_usuario = '$id_usuario'";
    $stmt_del_ben = mysqli_prepare($koneksi, $sql_del_ben);

    if (mysqli_stmt_execute($stmt_del_ben)) {
        echo '<script>window.location.href = "../user_beneficiarios.php?insert_sucess";</script>';
        array_map('unlink', glob($userDirectory_del . "/*.pdf"));
        rmdir($userDirectory_del);
    } else {
        $resposta[] = "Erro no delete";
        echo '<script>window.location.href = "../user_beneficiarios.php?insert_error";</script>';
    }
}
