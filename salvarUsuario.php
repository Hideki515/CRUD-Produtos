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
$dsn = "mysql:host=localhost;dbname=crudproduto"; // Data Source Name
$dbuser = 'root';
$dbpass = '';

try {
  $conn = new PDO($dsn, $dbuser, $dbpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Validação do Login
  if (empty($login)) {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>';
    $_SESSION['erroLogin'] = 'Este campo deve ser preenchido';
    $errovalidacao = true;
  } else {
    // Verificar se o Login já existe
    $stmt = $conn->prepare('SELECT * FROM usuario WHERE login = :login');
    $stmt->execute(array('login' => $login));
    // Obtem a próxima linha do conjunto de resultados
    $result = $stmt->fetch();

    if (!empty($result)) { // Já tem um usuário com este Login
      $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Este Login já está sendo usado.</div>';
      $_SESSION['erroLogin'] = 'Este login já está em uso.';
      $errovalidacao = true;
      // Não armazenar o login na sessão se ele já existir
      unset($dadosform['login']);
    }
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
    header("Location:cadastrarUsuarios.php"); // Retorna ao Formulário
    die(); // Isso é necessário senão ele vai continuar e cadastrar o produto!!!
  }

  // Gravar os Dados
  $stmt = $conn->prepare("INSERT INTO usuario (login, nome, senha, email, permissao) VALUES (:login, :nome, :senha, :email, :permissao)");
  $stmt->bindParam(':login', $login);
  $stmt->bindParam(':nome', $nome);
  $stmt->bindParam(':senha', $senha);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':permissao', $permissao);

  $stmt->execute();

  if ($stmt->rowCount() == 1) { // Inseriu com Sucesso
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Novo Usuário Cadastrado com Sucesso.</div>';
    header('Location:cadastrarUsuarios.php');
  } else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao Cadastrar novo Usuário.</div>';
    header('Location:cadastrarUsuarios.php');
  }

  die(); // Isso é necessário para parar a execução após redirecionar

} catch (PDOException $e) {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao Salvar Cadastro Novo Usuário: ' . $e->getMessage() . '</div>';
  header('Location:cadastrarUsuarios.php');
  die(); // Isso é necessário para parar a execução após redirecionar
}