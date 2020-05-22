<?php

$email = $_POST["emaillogin"];
$pass = $_POST["senhalogin"];
$pold = $_POST["senhaold"];

iF (session_status() != 2) {
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $pass;
}

print_r("SEU E-MAIL: ".$email);

$existe_sessao = session_status() == PHP_SESSION_ACTIVE;

if ($pold == $pass && $existe_sessao == 2 && $pold != null) {
    if (!isset($_SESSION['produtos'])) {
        $_SESSION['produtos'] = array();
    }
    echo "<html> <h2> Incluir </h2>
    <form name = 'cadastro' method = 'POST' action = 'produtos.php' id='aa'>
    Nome do Produto: <input type = 'text' name = 'nomeproduto' required>
    <input name='emaillogin' value='$email' hidden>  
    <input name='senhalogin' value='$pass' hidden>
    <input name='senhaold' value='$pold' hidden>
    <input name = 'cadastra' type = 'submit' value = 'Enviar'> <br>
    </form>
    </html>";
    if (isset($_POST["cadastra"])) {
        $produtoNovo = $_POST["nomeproduto"];
        array_push($_SESSION['produtos'], $produtoNovo);
        print_r(array_values($_SESSION['produtos']));
    }

    echo "<html><h2> Alterar </h2> <form name = 'altera' method = 'POST' action = 'produtos.php'>
    Informe a posição para alterar: <input type = 'number' name = 'posicao' required>
    Informe o novo nome: <input type = 'text' name = 'novonome' required>
    <input name='emaillogin' value='$email' hidden>  
    <input name='senhalogin' value='$pass' hidden>
    <input name='senhaold' value='$pold' hidden>
    <input name = 'altera' type = 'submit' value = 'Enviar'> <br>
    </form>
    </html>";

    if (isset($_POST["altera"])) {
        $produtoNovo = $_POST["posicao"];
        $novonome = $_POST['novonome'];
        $_SESSION['produtos'][$produtoNovo] = $novonome;
        print_r(array_values($_SESSION['produtos']));
    }

    echo "<html><h2> Deletar </h2>
    <form name = 'remove' method = 'POST' action = 'produtos.php'>
    Informe a posição de delete: <input type = 'number' name = 'posicao' required>
    <input name='emaillogin' value='$email' hidden>  
    <input name='senhalogin' value='$pass' hidden>
    <input name='senhaold' value='$pold' hidden>
    <input name = 'deleta' type = 'submit' value = 'Enviar'> <br>
    </form></html>";
    if (isset($_POST["deleta"])) {
        $posicao = $_POST['posicao'];
        echo "deletando item na posição: " . $posicao;
        var_dump($_SESSION['produtos']);
        unset($_SESSION['produtos'][$posicao]);
        var_dump($_SESSION['produtos']);
    }

    echo "<html><h2> Listar </h2><form name = 'listar' method = 'POST' action = 'produtos.php'>
    <input name='emaillogin' value='$email' hidden>  
    <input name='senhalogin' value='$pass' hidden>
    <input name='senhaold' value='$pold' hidden>
    <input name = 'listar' type = 'submit' value = 'Listar Produtos'></form>
    </html>";
    if (isset($_POST["listar"])) {
        print_r(array_values($_SESSION['produtos']));
        print_r(sizeof($_SESSION['produtos']));
    }

    echo
    "<html><form name = 'desloga' method = 'POST' action = 'form_success.php'>
    <input name = 'Deslogar' type = 'submit' value = 'Deslogar'></form></html>";
} else {
    echo "<script> alert('Acesso negado!')</script>";
    session_destroy();
}