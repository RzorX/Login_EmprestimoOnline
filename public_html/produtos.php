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
    <form name = 'cadastro' method = 'POST' action = ''>
    Nome do Produto: <input type = 'text' name = 'nomeproduto' required>
    <input name = 'cadastra' type = 'submit' value = 'Enviar'>
    </form>
    </html>";
    if (isset($_POST["cadastra"])) {
        $produtoNovo = $_POST["nomeproduto"];
        array_push($_SESSION['produtos'], $produtoNovo);
        print_r(array_values($_SESSION['produtos']));
    }

    echo "<html><h2> Alterar </h2> <form name = 'altera' method = 'POST' action = ''>
    Informe a posição para alterar: <input type = 'number' name = 'posicao' required>
    <input name = 'altera' type = 'submit' value = 'Enviar'> <br>
    </form></html>";

    echo "<html><h2> Deletar </h2>
    <form name = 'remove' method = 'POST' action = ''>
    Informe a posição de delete: <input type = 'number' name = 'posicao' required>
    <input name = 'deleta' type = 'submit' value = 'Enviar'> <br>
    </form></html>";
    if (isset($_POST["deleta"])) {
        $posicao = $_POST['posicao'];
        unset($_SESSION['produtos'][$posicao]);
    }

    echo 
    "<html><form name = 'desloga' method = 'POST' action = 'form_success.php'>
    <input name = 'Deslogar' type = 'submit' value = 'Deslogar'></form></html>";
}