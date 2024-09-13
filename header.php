<!doctype html>
<html lang="pt-br" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD-Produto</title>
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <!-- Css personalizado para o NavBar -->
  <link href="./css/sticky-footer-navbar.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

  <header>
    <!-- Navbar Fixa no Topo da Tela -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <!-- Botão nome do Site -->
        <a class="navbar-brand" href="index.php">CRUD-Produto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <!-- Link para a Home -->
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <!-- Link para Listar Produtos -->
            <li class="nav-item">
              <a class="nav-link" href="listarProdutos.php">Listar Produtos</a>
            </li>
            <!-- Link para Cadastro de Produtos -->
            <li class="nav-item">
              <a class="nav-link" href="cadastrarProdutos.php">Cadastrar Produto</a>
            </li>
            <!-- Link para Cadastro de Usuário -->
            <li class="nav-item">
              <a class="nav-link" href="cadastrarUsuarios.php">Cadastrar Usuário</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>