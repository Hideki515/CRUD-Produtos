<?php

session_start();
include_once 'sanitizar.php';

//Sanitização dos dados do Formulário
$dadosform = sanitizar($_POST);

$errovalidacao = false;
//Aplicar a Validação dos Dados segundo as regras de negócio
if (empty($dadosform['preco'])) {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>';
  $_SESSION['erropreco'] = 'Este campo deve ser preemchido';
  $errovalidacao = true;
}

if (isset($_SESSION['form'])) {
  unset($_SESSION['form']); //Limpa os dados do formulário se guardados anteriormente
}

if ($errovalidacao) {  //Houve erro na validacao
  //Guarda os dados do POST na Session para reapresentar os dados
  $_SESSION['form'] = $dadosform;
  header("Location:cadastrarProdutos.php"); //Retorna ao Formulário
  die(); //Isso é necessário senão ele vai continuar e cadastrar o produto!!!
}

//Se passou pela validação sem erros, continua aqui

//Credenciais para conexão com o Banco
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';

//Abre conexão com o MySQL   
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die('Falha ao conectar com o MySQL: ' . $conn->connect_error);
}

//Altera a codificação de caracteres para utf8
$conn->set_charset("utf8");

//$sql = "INSERT INTO Produto(nome,descricao,preco,quantidade) VALUES('".$dadosform["nome"]."','".$dadosform["descricao"]."','".$dadosform["preco"]."','".$dadosform["quantidade"]."')";

$nome = $dadosform["nome"];
$descricao = $dadosform["descricao"];
$preco = $dadosform["preco"];
$quantidade = $dadosform["quantidade"];

$sql = "INSERT INTO Produto(nome,descricao,preco,quantidade) VALUES('$nome','$descricao','$preco','$quantidade')";
$result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

if (mysqli_affected_rows($conn) == 1) { //Conseguiu Gravar
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produto Cadastrado com Sucesso.</div>';
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar Produto no Banco!</div>';
}

$conn->close(); //Fecha a conexão com o Banco

//Retorna ao Formulário para mostrar a mensagem de Sucesso ou Erro
//header("Location:cadastrarProdutos.php");
header("Location:listarProdutos.php");