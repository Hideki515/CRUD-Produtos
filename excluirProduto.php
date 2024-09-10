<?php
session_start();
include_once 'sanitizar.php';

$dados = sanitizar($_GET); //Sanitização 
$idproduto = $dados['id'];
if (!is_numeric($idproduto)) { //Validação 
  die("Id do produto não é numérico!");
}

$_SESSION['form'] = $dados;
header("Location:excluirProdutoForm.php");
