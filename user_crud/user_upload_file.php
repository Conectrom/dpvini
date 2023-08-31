<?php

session_start();

include('../koneksi.php');
include('../user_crud/user_upload_view2.php');

if (isset($_POST['user_upload_file'])) {
    $uploadOk = 1; // variável para controle

    // Cria o diretório "user_upload/" se ele não existir
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }

    if (isset($_SESSION['nama'])) {
        $name = $_SESSION['nama'];
        $userDirectory = $directory . $name . "/";

        if (!file_exists($userDirectory)) {
            mkdir($userDirectory, 0777, true);
        }
    }

    if (is_dir($userDirectory)) {
        $files = scandir($userDirectory);
        $files = array_diff($files, array('.', '..'));
        $resultado = array_fill_keys($fieldNames, false);

        foreach ($files as $i => $file) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            if (in_array($fileName, $fieldNames_user)) {
                $result[$fileName] = true;
            }
        }

        // Fazer a consulta ao banco de dados para obter o valor adequado
        // para a chave 'reservista_upload' no array $result
        $id_usuario = $_SESSION['id_usuarios'];
        $sql = "SELECT sexo_trab FROM tb_trabalhador WHERE id_usuario = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $stmt->bind_result($sexo);
        $stmt->fetch();

        // Definir o valor adequado para a chave 'reservista_upload' no array $result
        $result['reservista_upload'] = ($sexo == 'Feminino');
    }

    $resposta = [];
    foreach ($fileFields as $i => $fieldName) {
        $file = $_FILES[$fieldName];
        $targetFile = basename($file["name"]); // obtém o nome completo do arquivo
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // obtém a extensão do arquivo
        $newFileName = $fieldNames[$i] . " - " . $name . "." . $fileType;
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
                } else if ($fieldName == 'reservista_upload') {
                    if ($sexo == 'Feminino') {
                        $uploadOk = true;
                        continue;
                    } else {
                        $resposta[] = $fieldNames[$i];
                        $uploadOk = 0;
                    }
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
            $allowedExtensions_foto = ["png", "jpg"];
            if ($fieldName == 'fotos_upload') {
                if (!in_array($fileType, $allowedExtensions_foto)) {
                    $resposta[] = "Desculpe, apenas arquivos JPG e PNG são permitidos para o campo " . $fieldNames[$i] . ".<br>";
                    $uploadOk = 0;
                }
            } else if (!in_array($fileType, $allowedExtensions)) {
                $resposta[] = "Desculpe, apenas arquivos PDF são permitidos para o campo " . $fieldNames[$i] . ".<br>";
                $uploadOk = 0;
            }
        }

        if ($uploadOk == 0) {
            $_SESSION['resposta'] = $resposta;
        } else if ($uploadOk == 1) {
            move_uploaded_file($file["tmp_name"], $destination);
        }
        $uploadOk = 1;
    }
} else {
    $resposta[] = "O formulário não foi enviado.";
}

if (isset($resposta) && !empty($resposta)) {
    echo '<script>window.location.href = "../user_upload.php?insert_error";</script>';
} else {
    $_SESSION['resposta'] = [];
    echo '<script>window.location.href = "../user_upload.php?insert_sucess";</script>';
}
