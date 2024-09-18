<?php
// Inicia a sessão
session_start();
// Inclui o código sanatizar.php
include_once 'sanitizar.php';

//Sanitização dos dados do Formulário
$dadosform = sanitizar($_POST);
$loginUsuario = $dadosform['login'];

//Credenciais paraconexão com o Banco
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';

//Abre conexão com o MySQL
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
  die('Falha ao conectar com o MySQL: ' . $conn->connect_error); // Mensagem de erro ao conectar com o banco
}

// Realiza o delete no banco
$sql = "DELETE FROM usuario WHERE login = '{$loginUsuario}'";

$result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

if (mysqli_affected_rows($conn) != 0) {
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Usuário Excluído com Sucesso.</div>';
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao Excluir Usuário no Banco!</div>';
}
$conn->close(); //Fecha a conexão com o Banco

//Retorna ao Formulário para mostrar a mensagem de Sucesso ou Erro 
header("Location:listarUsuarios.php");
