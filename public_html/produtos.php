<?php

$e = $_POST["emaillogin"];
$p = $_POST["senhalogin"];
$pold = $_POST["senhaold"];

session_start();

if ($p != $pold) {
    echo "<script> alert('Senha inválida') </script>";
} else {
    if (!isset($_SESSION['produtos'])) {
        $_SESSION['produtos'] = array();
    }
    echo "<html> <h2> Incluir </h2>
    <form name = 'produtos' method = 'POST' action = ''>
    nome: <input type = 'text' name = 'nomeproduto' required><br>
    <input name = 'envia' type = 'submit' value = 'Enviar'>
    </form>
    </html>";
    if (isset($_POST["envia"])) {
        $produtoNovo = $_POST["nomeproduto"];
        array_push($_SESSION['produtos'], $produtoNovo);
        print_r(array_values($_SESSION['produtos']));
    }

    echo "<h2> Alterar </h2>";

    echo "<h2> Deletar </h2>
    <form name = 'produtos' method = 'POST' action = ''>
    nome: <input type = 'number' name = 'posicao' required><br>
    <input name = 'deleta' type = 'submit' value = 'Enviar'>";
    if (isset($_POST["deleta"])) {
        $posicao = $_POST['posicao'];
        unset($_SESSION['produtos'][$posicao]);
    }

    echo 
    "<form name = 'produtos' method = 'POST' action = 'form_success.php'>
    <input name = 'Deslogar' type = 'submit' value = 'Deslogar'>";
}