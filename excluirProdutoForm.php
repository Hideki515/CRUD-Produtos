<?php
session_start();
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h1 class="mt-2">Exclusão de Produto</h1>

        <form action="excluirProdutoExclusao.php" method="post"
          id="formExcluirProduto">
          <input type="hidden" name="id" value="<?php if (isset($_SESSION["form"]["id"])) echo $_SESSION["form"]["id"]; ?>">
          <div class="card text-white bg-dark mb-3" style="max-width: 22 rem;">
            <div class="card-header">Confirmação da Exclusão do Produto</div>
            <div class="card-body">
              <h5 class="card-title">Excluir?</h5>
              <p>Confirma exclusão do produto: <?php if (isset($_SESSION["form"]["nome"])) echo $_SESSION["form"]["nome"]; ?> ?</p>
              <button type="submit" class="btn	btn-danger	btn-sm	mt-2">Confirmar</button>
              <a href="listarProdutos.php" class="btn	btn-success	btn-sm	mt-2">Cancelar</a>
            </div>
          </div>
        </form>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
</main>

<?php
require_once 'footer.php';
