<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title> Itander </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="All">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" media="All">
        <link rel="stylesheet" href="css/main.css" media="All">
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <?php
        session_start();
        session_destroy();
        $nome = $_POST["name"];
        $cpf = $_POST["cpf"];
        $rg = $_POST["rg"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $cel = $_POST["cel"];
        $fixo = $_POST["fixo"];
        $genero = $_POST["genero"];
        $nasc = $_POST["nasc"];
        $cep = $_POST["cep"];
        $end = $_POST["end"];
        $num = $_POST["num"];
        $bairro = $_POST["bairro"];
        $state = $_POST["state"];
        $city = $_POST["city"];
        $comp = $_POST["comp"];
        $bank = $_POST["bank"];
        $ag = $_POST["ag"];
        $conta = $_POST["conta"];
        $dig = $_POST["dig"];
        $tyoe = $_POST["type"];
        ?>
        <a name="home"></a>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p align= "center">
                        <a class="navbar-brand" href="#" onclick="window.location = 'index.php'">
                            <img
                                srcset="img/itander-logo-only.png 320w,
                                img/itander-logo-only.png 480w,
                                img/itander-logo-only.png 800w,
                                img/itander-logo-only.png 1000w"
                                sizes="(max-width: 320px) 280px,
                                (max-width: 480px) 440px,
                                800px"
                                src="img/itander-logo-only.png" alt="Empréstimos online">
                        </a></p>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                </div>
            </div>
        </nav>

        <div class="login1" style="text-align: center; margin-top: 100px">
            <?php
            echo
            "
                <h2>É um prazer tê-lo conosco: $nome</h2>
                <p> Acesse sua seção </p>    
                <form action='produtos.php' method='post' include='$pass'>
                <h2 class='telalogin'> Login             
                    <input type='text' value='$email' name='emaillogin'>
                </h2>
                <h2 class='inputsenha'> Senha
                    <input name='senhalogin'>
                    <input name='senhaold' value='$pass' hidden>    
                </h2>";
                echo "<input name='logn' type='submit' role='button' value='Entrar'>
                </div>";
            
            ?>
        </form>            
</html>
