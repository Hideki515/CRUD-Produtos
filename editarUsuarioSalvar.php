<?php

session_start();
include_once 'sanitizar.php';

// Sanitização dos dados do Formulário
$dadosform = sanitizar($_POST);
$errovalidacao = false;

$login     = $dadosform['login'];
$nome      = $dadosform['nome'];
$senha     = $dadosform['senha'];
$email     = $dadosform['email'];
$permissao = $dadosform['permissao'];

// Conectar ao Banco de Dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudproduto";

// Cria uma conexão MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Validação da Senha
if (empty($senha)) {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>';
    $_SESSION['errosenha'] = 'Este campo deve ser preenchido';
    $errovalidacao = true;
}

// Validação do E-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errovalidacao = true;
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>';
    $_SESSION['erroEmail'] = 'Este campo deve conter: @dominio.extensãoDominio';
}

// Validação de Permissão
if ($permissao == 'Selecione') {
    $errovalidacao = true;
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>';
    $_SESSION['erroPermissao'] = 'É necessário selecionar um Tipo de Permissão.';
}

// Verificar se houve erro na validação
if ($errovalidacao) {
    $_SESSION['form'] = $dadosform; // Guarda os dados do POST na Sessão para reapresentar os dados
    header("Location:editarUsuarioSalvar.php"); // Retorna ao Formulário
    die(); // Isso é necessário senão ele vai continuar e cadastrar o usuário!!!
}

// Gravar os Dados
$login = $dadosform["login"];
$nome = $dadosform["nome"];
$senha = $dadosform["senha"];
$email = $dadosform["email"];
$permissao = $dadosform["permissao"];

// $sql = "INSERT INTO usuario (login, nome, senha, email, permissao) VALUES ('$login', '$nome', '$senha', '$email', '$permissao')";
// $sql = "INSERT INTO usuario(login, nome, senha, email, permissao) VALUES('$login','$nome','$senha','$email','$permissao')";
$sql = "UPDATE Usuario SET login='" . $dadosform["login"] . "',nome='" . $dadosform["nome"] . "',senha='" . $dadosform["senha"] . "',email='" . $dadosform["email"] . "', permissao='" . $dadosform["permissao"] . "' WHERE login='" . $dadosform["login"] . "'";
$result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

if (mysqli_affected_rows($conn) == 1) { //Conseguiu Gravar
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Usuário Editado com Sucesso.</div>';
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao Editar Usuário no Banco!</div>';
    die(); // Isso é necessário para parar a execução após redirecionar
}

$conn->close();



header("Location:listarUsuarios.php");
