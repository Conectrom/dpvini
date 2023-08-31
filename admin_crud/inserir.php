<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require '../koneksi.php';

    function clear($input)
    { // clear
        global $koneksi;
        // sql injection
        $var = mysqli_escape_string($koneksi, $input);
        // xss
        $var = htmlspecialchars($var);
        return $var;
    }

    $filtro = "/^[a-záàâãéèêíïóôõöúçñ]+( [a-záàâãéèêíïóôõöúçñ]+)*+$/i";

    $nome = clear($_POST['ad_nome_trab']);
    $cpf = clear($_POST['ad_cpf_trab']);
    $senha = clear($_POST['ad_senha_trab']);
    $senha_sha1 = sha1($senha);

    $filtro_nome = preg_match($filtro, $nome);

    if ($filtro_nome == 1) {
        if (isset($_POST['ad_level'])) {
            $level = $_POST['ad_level'];
            // Salva a variável $ad_level em outro arquivo ou faz alguma outra ação desejada
        }

        $sql = "INSERT INTO tb_login (user, nama, password, level) VALUES ('$cpf', '$nome', '$senha_sha1', '$level')";

        if (mysqli_query($koneksi, $sql)) {
            header("Location: ../home_admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Erro, falha no insert<br>";
        var_dump($nama);
    }
    mysqli_close($koneksi);
}
