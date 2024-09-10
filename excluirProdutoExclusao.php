<?php
session_start();
include_once 'sanitizar.php';

//Sanitização dos dados do Formulário
$dadosform = sanitizar($_POST);
$idproduto = $dadosform['id'];

if (!is_numeric($idproduto)) {  //Validação
  die("Id do produto não é numérico!");
}
//Se passou pela validação sem erros, continua aqui 
//Credenciais paraconexão com o Banco
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';

//Abre conexão com o MySQL
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die('Falha ao conectar com o MySQL: ' . $conn->connect_error);
}

$sql = "DELETE FROM Produto WHERE id='{$idproduto}'";

$result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

if (mysqli_affected_rows($conn) != 0) {
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produto Excluído com Sucesso.</div>';
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao Excluir Produto no Banco!</div>';
}
$conn->close(); //Fecha a conexão com o Banco

//Retorna ao Formulário para mostrar a mensagem de Sucesso ou Erro 
header("Location:listarProdutos.php");
