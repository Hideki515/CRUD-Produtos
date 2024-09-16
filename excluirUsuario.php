<?php
session_start();
include_once 'sanitizar.php';

$dados = sanitizar($_GET); //Sanitização 
$loginUsuario = $dados['id'];

$_SESSION['form'] = $dados;

header("Location:excluirUsuarioForm.php");