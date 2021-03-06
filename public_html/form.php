<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Itander - Cadastro</title>
        <link rel="stylesheet" href="css/form.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=IBM+Plex+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
              crossorigin="anonymous">

        <!--JQuery-->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" 
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" 
        crossorigin="anonymous"></script>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="All">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" media="All">
        <link rel="stylesheet" href="css/main.css" media="All">
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

        <!--Masks-->
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#cpf").mask("000.000.000-00");
                $("#rg").mask("000.000.000-W", {
                    translation: {
                        'W': {
                            pattern: /[X0-9]/
                        }
                    },
                    reverse: true
                });
                $("#cep").mask("00.000-000");
                $("#fixo").mask("(00) 0000-0000");
                $("#cel").mask("(00) 0000-00009");
                $("#cel").blur(function (event) {
                    if ($(this).val().length === 15) {
                        $("#cel").mask("(00) 00000-0009");
                    } else {
                        $("#cel").mask("(00) 0000-00009");
                    }
                });
                $("#conta").mask("0000000000");
                $("#num").mask("0000");
                $("#ag").mask("0000");
                $("#dig").mask("0");
            });
        </script>

        <!--Preenchimento automático-->
        <script type="text/javascript" >
            $(document).ready(function () {

                function limpa_formulário_cep() {
                    // Limpa valores do formulário de cep.
                    $("#rua").val("");
                    $("#bairro").val("");
                    $("#cidades").val("");
                    $("#estados").val("");
                }

                //Quando o campo cep perde o foco.
                $("#cep").blur(function () {

                    //Nova variável "cep" somente com dígitos.
                    var cep = $(this).val().replace(/\D/g, '');

                    //Verifica se campo cep possui valor informado.
                    if (cep !== "") {

                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;

                        //Valida o formato do CEP.
                        if (validacep.test(cep)) {

                            //Preenche os campos com "..." enquanto consulta webservice.
                            $("#rua").val("...");
                            $("#bairro").val("...");
                            $("#cidades").val("...");
                            $("#estados").val("...");

                            //Consulta o webservice viacep.com.br/
                            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                                if (!("erro" in dados)) {
                                    //Atualiza os campos com os valores da consulta.
                                    $("#rua").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidades").val(dados.localidade);
                                    $("#estados").val(dados.uf);
                                } //end if.
                                else {
                                    //CEP pesquisado não foi encontrado.
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                        } //end if.
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    } //end if.
                    else {
                        //cep sem valor, limpa formulário.
                        limpa_formulário_cep();
                    }
                });
            });
        </script>

        <!--Estados e Cidades-->
        <script type="text/javascript">
            $(document).ready(function () {

                $.getJSON('js/estados_cidades.json', function (data) {

                    var items = [];
                    var options = '<option value="">Selecione</option>';

                    $.each(data, function (key, val) {
                        options += '<option value="' + val.sigla + '">' + val.sigla + '</option>';
                    });
                    $("#estados").html(options);

                    $("#estados").change(function () {

                        var options_cidades = '<option value="">Selecione</option>';
                        var str = '';

                        $("#estados option:selected").each(function () {
                            str += $(this).text();
                        });

                        $.each(data, function (key, val) {
                            if (val.sigla === str) {
                                $.each(val.cidades, function (key_city, val_city) {
                                    options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                                });
                            } else {
                                $.each(val.cidades, function (key_city, val_city) {
                                    options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                                });
                            }
                        });

                        $("#cidades").html(options_cidades);

                    }).change();

                });

            });
        </script>

        <!--Estilo Input-->
        <style type="text/css">
            .form-control{
                color: grey;
                font-size: 16px;
                letter-spacing: 1px;
                height: 40px;
                box-shadow: none;
                border: none;
                border-bottom: 1px solid #FF9689;
                border-radius: 0;
                display: inline-block;
                transition:all 0.3s;
            }            
            .form-control:focus{ box-shadow: none; }
        </style>
    </head>

    <body>

        <div class="background" style="
             top: 0px;
             ">
            <div class="marca">
                <a class="navbar-brand" href="#" onclick="window.location = 'index.php'">
                    <img
                        srcset="img/itander-white.png 320w,
                        img/itander-white.png 480w,
                        img/itander-white.png 800w,
                        img/itander-white.png 1000w"
                        sizes="(max-width: 320px) 280px,
                        (max-width: 480px) 440px,
                        800px"
                        src="img/itander-white.png" alt="Empréstimos online">
                </a>
            </div>
            <div class="container" id="box" style=" margin-top: 100px;">
                <form role="form" id="form1" name="form1" action="form_success.php" method="post"                   
                      onsubmit="return valida_form(this)">
                    <fieldset>

                        <br>
                        <h4>Dados Pessoais</h4>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Nome Completo</label>
                                <input type="text" class="form-control" name="name" placeholder="Insira seu nome aqui" autofocus id="nome" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">CPF</label>
                                <input type="text" class="form-control" name="cpf" placeholder="Informe seu CPF" id="cpf" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">RG</label>
                                <input type="text" class="form-control" name="rg" placeholder="Informe seu RG" id="rg" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Insira seu e-mail aqui" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Senha</label>
                                <input type="password" class="form-control" name="pass" id="pass" placeholder="Crie uma senha" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Confirmar Senha</label>
                                <input type="password" class="form-control" id="pass_check" placeholder="Digite novamente a senha" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Celular</label>
                                <input type="tel" class="form-control" name="cel" placeholder="Ex.: (00) 0000-0000" id="cel" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Telefone Fixo (Opcional)</label>
                                <input type="tel" class="form-control" name="fixo" placeholder="Ex.: (00) 0000-0000" id="fixo">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Sexo</label>
                                <select class="form-control" id="genero" name="genero" required>
                                    <option value="">Selecione</option>
                                    <option value="indefinido">Prefiro não informar</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="feminino">Feminino</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Data de nascimento</label>
                                <input type="date" class="form-control" name="nasc" id="nasc" required>
                            </div>
                        </div>

                        <br>
                        <h4>Endereço</h4>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-2">
                                <label for="exampleInputEmail1">CEP</label>
                                <input type="text" class="form-control" name="cep" placeholder="Insira seu CEP" id="cep" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Endereço</label>
                                <input type="text" class="form-control" name="end" placeholder="Logradouro" id="rua" required>
                            </div>
                            <div class="form-group col-lg-1">
                                <label for="exampleInputEmail1">Número</label>
                                <input type="text" class="form-control input-sm" maxlength="5" name="num" id="num" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Bairro</label>
                                <input type="text" class="form-control" placeholder="Bairro" name="bairro" id="bairro" required>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="exampleInputEmail1">Estado</label>
                                <select class="form-control" id="estados" name="state" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="exampleInputEmail1">Cidade</label>
                                <select class="form-control" id="cidades" name="city" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group col-lg-7">
                                <label for="exampleInputEmail1">Complemento (Opcional)</label>
                                <input type="text" class="form-control" name="comp">
                            </div>
                        </div>

                        <br>
                        <h4>Dados Bancários</h4>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <select class="form-control" id="banco" name="bank" required>
                                    <option value="">Selecione o Banco</option>
                                    <option value="santader">033 – Banco Santander (Brasil) S.A</option>
                                    <option value="itau">341 – Banco Itaú S.A</option>
                                    <option value="itau holding">652 – Itaú Unibanco Holding S.A</option>
                                    <option value="citibank">745 – Banco Citibank S.A</option>
                                    <option value="banco do brasil">001 – Banco do Brasil S.A</option>
                                    <option value="caixa">104 – Caixa Econômica Federal</option>
                                    <option value="mercantil">389 – Banco Mercantil do Brasil S.A</option>
                                    <option value="safra">422 – Banco Safra S.A</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-1">
                                <input type="text" class="form-control input-sm" name="ag" placeholder="Ag." id="ag" required>
                            </div>

                            <div class="form-group col-lg-3">
                                <input type="text" class="form-control" name="conta" placeholder="Conta" id="conta" required>
                            </div>
                            <div class="form-group col-lg-1">
                                <input type="text" class="form-control input-sm" name="dig" placeholder="Dig." id="dig" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <select class="form-control" id="tipoconta" name="type" required>
                                    <option value="">Tipo de conta</option>
                                    <option value="corrente">Corrente</option>
                                    <option value="poupanca">Poupança</option>
                                </select>
                            </div>


                        </div>

                        <br>
                        <div class="box-actions" align="right">
                            <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
                            <input type="submit"
                                   id="envio"
                                   class="btn btn-primary"
                                   role="button" value="Criar Conta">
                        </div>

                    </fieldset>
                </form>

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <p>Some text in the modal.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <script type="text/javascript" language="javascript">
                    function valida_form() {                        
                        if (document.getElementById("pass").value !== document.getElementById("pass_check").value) {
                            alert('Por favor, suas senhas não conferem');
                            document.getElementById("pass_check").focus();
                            return false;
                        }
                    }
                </script>
            </div>
        </div>
    </body>

</html>