<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Conexão com o banco de dados 
require "conectaBD.php"; 
 
// Inicia sessões 
session_start(); 
 
// Recupera o login 
$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE; 
// Recupera a senha, a criptografando em MD5 
$pass = isset($_POST["pass"]) ? md5(trim($_POST["pass"])) : FALSE; 
 
/** 
* Executa a consulta no banco de dados. 
* Caso o número de linhas retornadas seja 1 o login é válido,  
*/
$SQL = "SELECT id,nome,login,senha FROM itander.usuario WHERE login = '".$login."'"; 
$result_id = mysqli_query($SQL); 
$total = mysqli_num_rows($result_id); 
 
// Caso o usuário tenha digitado um login válido o número de linhas será 1.. 
if($total) 
{ 
    // Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão 
    $dados = mysqli_fetch_array($result_id); 
 
    // Agora verifica a senha 
    if(!strcmp($senha, $dados["senha"])) 
    { 
        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
        $_SESSION["id_usuario"]= $dados["id"]; 
        $_SESSION["nome_usuario"] = stripslashes($dados["nome"]); 
        header("Location: index.php"); 
        exit; 
    } 
    // Senha inválida 
    else
    { 
     "Senha inválida!"; 
    exit; 
    } 
} 
    // Login inválido 
else
{ 
    echo "O login fornecido por você é inexistente!"; 
    exit; 
} 