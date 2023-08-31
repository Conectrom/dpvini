<?php
session_start();

include("../koneksi.php");

$id_usuario = $_SESSION['id_usuarios'];

$bloqueioUsuario = 1;
$liberarUsuario = 0;

if (isset($_POST['user_finalizar'])) {
    $sql = "UPDATE tb_trabalhador SET envio_trab = '$bloqueioUsuario' WHERE id_usuario='$id_usuario'";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: ../home_final.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

if (isset($_POST['user_liberar'])) {
    $id_trabalhador = $_POST['user_liberar'];

    $sql = "SELECT * FROM tb_trabalhador WHERE id_usuario='$id_trabalhador'";
    $result = $koneksi->query($sql);

    // Verifica se existem resultados
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $envio_trab = $row['envio_trab'];

        if ($envio_trab == $bloqueioUsuario) {
            $sql = "UPDATE tb_trabalhador SET envio_trab = '$liberarUsuario' WHERE id_usuario='$id_trabalhador'";
        } elseif ($envio_trab == $liberarUsuario) {
            $sql = "UPDATE tb_trabalhador SET envio_trab = '$bloqueioUsuario' WHERE id_usuario='$id_trabalhador'";
        } else {
            echo "Estado inválido para atualização.";
            exit;
        }

        if (mysqli_query($koneksi, $sql)) {
            header("Location: ../home_admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Não foi possível encontrar o trabalhador com o ID fornecido.";
        exit;
    }
}
?>
