<?php
// Inicia a sessao
session_start();
// Inclui no código sanatizzer.php
include_once 'sanitizar.php';

$dados = sanitizar($_GET); //Sanitização 
$loginUsuario = $dados['id'];  // Pega o id de Login

//Então busca os dados do Usuário pelo id
//Credenciais para conexão com o Banco
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';

//Abre conexão com o MySQL
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verifica se ocorreu erro na conexão com o banco
if ($conn->connect_error) {
  die('Falha ao conectar com o MySQL: ' . $conn->connect_error);
}

// Faz a seleção dos dados do usuário a ser editado com base no login
$sql = "SELECT * FROM Usuario WHERE login = '{$loginUsuario}'";
$result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

// Retorna erro ao recuperar dados do usuário
if (mysqli_affected_rows($conn) != 1) {
  die('Falha ao recuperar dados do Usuario');
}

// Obtém a próxima linha de resultado da consulta como um array associativo
$usuario = mysqli_fetch_assoc($result);

// Armazena os dados do usuário na sessão
// Isso permite que os dados fiquem disponíveis em outras páginas
$_SESSION['form'] = $usuario;

// Fecha a conexão com o Banco
$conn->close(); //Fecha a conexão com o Banco

// Chama a página de Formulário de Edição
header("Location:editarUsuarioForm.php");