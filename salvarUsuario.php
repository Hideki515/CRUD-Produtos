<?php
// Inicia a Sessão.
session_start();
// Inclui o sanatizar.
include_once 'sanitizar.php';

// Sanitização dos dados do Formulário
$dadosform = sanitizar($_POST);

$errovalidacao = false;

// Gravar Dados.
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

// Validação do Login
if (empty($login)) {

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>'; // Mensagem de Erro Campo.
    $_SESSION['erroLogin'] = 'Este campo deve ser preenchido'; // Mensagem de erro Login.
    $errovalidacao = true; // Ocorreu erro ao validar login.

} else {

    // Verifica se há espaços em branco no Login
    if (str_contains($login, ' ')) {

        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Este Login contém.</div>'; // Mensagem de Erro Campo.
        $_SESSION['erroLogin'] = 'Login não pode conter espaços.'; // Mensagem de erro por login conter espaços.
        $errovalidacao = true; // Erro ao validar Login. \

        // Não armazenar o login na sessão se ele já existir
        unset($dadosform['login']);
    } else {
        // Verificar se o Login já existe
        $loginEscapado = $conn->real_escape_string($login); // Escapa caracteres especiais na variável $login para evitar injeção de SQL

        // Faz a seleção de dados em busca de login já existente
        $sql = "SELECT * FROM usuario WHERE login = '$loginEscapado'";

        // Executa a consulta SQL armazenada na variável $sql e armazena o resultado na variável $result
        $result = $conn->query($sql);

        // Verifica se a consulta retornou alguma linha de resultado
        if ($result->num_rows > 0) { // Já tem um usuário com este Login
            
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Este Login já está sendo usado.</div>'; // Mensagem de Erro ao Login
            $_SESSION['erroLogin'] = 'Este login já está em uso.'; // Mensagem de erro por login há existente
            $errovalidacao = true; // Erro ao validar Login

            // Não armazenar o login na sessão se ele já existir
            unset($dadosform['login']);
        }
    }
}

// Validação do Nome
if (empty($nome)) { // Verifica se a variável está vazio.

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>'; // Mensagem de Erro.
    $_SESSION['erroNome'] = 'Este campo deve ser preenchido'; // Mensagem de Erro por campo Vazio.
    $errovalidacao = true; // Erro ao validar Nome.

}

// Validação da Senha
if (empty($senha)) { // Verifica se a variável está vazia.

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>'; // Mensagem de Erro.
    $_SESSION['erroSenha'] = 'Este campo deve ser preenchido'; // Mensagem de Erro por campo Vazio.
    $errovalidacao = true; // Erro ao validar Senha.

}

// Validação do E-mail
if (empty($email)) { // Verifica se a variável está vazia.

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>'; // Mensagem de Erro.
    $_SESSION['erroEmail'] = 'Este campo deve ser preenchido'; // Mensagem de erro por campo vazio.
    $errovalidacao = true; // Erro ao Validar Email em caso de campo Vazio

} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Verifica se email está seguindo o padrão de email

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>'; // Mensagem de Erro.
    $_SESSION['erroEmail'] = 'Este campo deve conter: @dominio.extensãoDominio'; // Mensagem de erro por campo escrito errado.
    $errovalidacao = true; // Erro ao Validar email em caso de campo escrito de forma errada.

}

// Validação de Permissão
if ($permissao == 'Selecione') { // Verifica se a permissão é igual a Selecione

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>'; // Mensagem de Erro.
    $_SESSION['erroPermissao'] = 'É necessário selecionar um Tipo de Permissão.'; // Mensagem de erro por permissão inválida.
    $errovalidacao = true; // Erro ao Validar permissão.

}

// Verificar se houve erro na validação
if ($errovalidacao) { // Verifica se a erros de validação.

    $_SESSION['form'] = $dadosform; // Guarda os dados do POST na Sessão para reapresentar os dados
    header("Location:cadastrarUsuarios.php"); // Retorna ao Formulário
    die(); // Isso é necessário senão ele vai continuar e cadastrar o usuário!!!

}

// Realiza o cadastro do Usuário no Banco
$sql = "INSERT INTO usuario(login, nome, senha, email, permissao) VALUES('$login','$nome','$senha','$email','$permissao')";
$result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

if (mysqli_affected_rows($conn) == 1) { //Conseguiu Gravar
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Usuário Cadastrado com Sucesso.</div>'; // Mensagem de Sucesso
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar Usuário no Banco!</div>'; // Mensagem de Erro
    die(); // Isso é necessário para parar a execução após redirecionar
}

// Fecha a conexão com o banco.
$conn->close();

// Passa o cabeçalho bruto.
header("Location:listarUsuarios.php");
