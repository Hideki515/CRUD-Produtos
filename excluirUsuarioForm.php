<?php
// Inicia a sessão
session_start();
// Inclui header.php no código
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <!-- Titulo da página -->
        <h1 class="mt-2">Exclusão de Usuário</h1>

        <!-- Form de excluir usuário -->
        <form action="excluirUsuarioExclusao.php" method="post" id="formExcluirUsuario">
          <!-- Campo invísivel que tem o login -->
          <input type="hidden" name="login"
            value="<?php if (isset($_SESSION["form"]["id"])) echo $_SESSION["form"]["id"]; ?>">
          <!-- Card de exluir usuario -->
          <div class="card text-white bg-secondary mb-3" style="max-width: 22 rem;">
            <!-- Título do Card -->
            <div class="card-header">Confirmação da Exclusão do Usuario</div>
            <!-- Corpo do Card -->
            <div class="card-body">
              <!-- Sub titulo do corpo do Card -->
              <h5 class="card-title">Excluir?</h5>
              <!-- Texto de confirmação de exclusão -->
              <p>Confirma exclusão do Login: <?php if (isset($_SESSION["form"]["id"])) echo $_SESSION["form"]["id"]; ?>
                do Usuario: <?php if (isset($_SESSION["form"]["nome"])) echo $_SESSION["form"]["nome"]; ?> ?</p>
              <!-- Botão de Confirmar Exclusão -->
              <button type="submit" class="btn	btn-danger	btn-sm	mt-2">Confirmar</button>
              <!-- Botão de Cacelar Exclusão -->
              <a href="listarUsuarios.php" class="btn	btn-warning	btn-sm	mt-2">Cancelar</a>
            </div>
          </div>
        </form>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
</main>

<?php
// Inclui footer.php no código
require_once 'footer.php';
