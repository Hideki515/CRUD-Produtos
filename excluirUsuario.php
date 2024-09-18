<?php
// Inicia a sessão
session_start();
// Inclui sanatizar.php no código
include_once 'sanitizar.php';

$dados = sanitizar($_GET); //Sanitização 
$loginUsuario = $dados['id']; // Pega o id do Login

$_SESSION['form'] = $dados; 

// Chama o excluirUsuarioForm.php
header("Location:excluirUsuarioForm.php");