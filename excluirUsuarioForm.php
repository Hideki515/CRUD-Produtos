<?php
session_start();
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h1 class="mt-2">Exclusão de Usuário</h1>

        <form action="excluirUsuarioExclusao.php" method="post"
          id="formExcluirUsuario">
          <input type="hidden" name="login" value="<?php if (isset($_SESSION["form"]["id"])) echo $_SESSION["form"]["id"]; ?>">
          <div class="card text-white bg-danger mb-3" style="max-width: 22 rem;">
            <div class="card-header">Confirmação da Exclusão do Usuario</div>
            <div class="card-body">
              <h5 class="card-title">Excluir?</h5>
              <p>Confirma exclusão do Login: <?php if (isset($_SESSION["form"]["id"])) echo $_SESSION["form"]["id"]; ?>
              do Usuario: <?php if (isset($_SESSION["form"]["nome"])) echo $_SESSION["form"]["nome"]; ?> ?</p>
              <button type="submit" class="btn	btn-outline-warning	btn-sm	mt-
2">Confirmar</button>
              <a href="listarUsuarios.php" class="btn	btn-outline-info	btn-sm	mt-
2">Cancelar</a>
            </div>
          </div>
        </form>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
</main>

<script>
  // Apenas se você precisar realmente fazer algo com a variável login no JavaScript
  var login = "<?php echo isset($_SESSION["form"]["login"]) ? htmlspecialchars($_SESSION["form"]["login"], ENT_QUOTES, 'UTF-8') : ''; ?>";
  console.log(login);
</script>

<?php
require_once 'footer.php';
