<?php
session_start();
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h1 class="mt-2">Cadastro de Produto</h1>
        <?php //Mensagens de Erro ou Sucesso na execução das funções              
        if (isset($_SESSION['msg'])) {
          echo $_SESSION["msg"];
          unset($_SESSION["msg"]);
        }
        ?>

        <form action="salvarProduto.php" method="post" id="formCadastro">
          <div class="form-group">
            <label for="nome">Nome do Produto</label>
            <input type="text" class="form-control" name="nome"
              value="<?php if (isset($_SESSION["form"]["nome"])) echo $_SESSION["form"]["nome"]; ?>" required>
          </div>
          <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control"
              name="descricao"><?php if (isset($_SESSION["form"]["descricao"])) echo $_SESSION["form"]["descricao"]; ?></textarea>
          </div>
          <div class="form-group">
            <label for="preco">Preço</label>
            R$ <input type="text" class="form-control <?php if (isset($_SESSION["erropreco"])) echo 'is-invalid'; ?>"
              name="preco" value="<?php if (isset($_SESSION["form"]["preco"])) echo $_SESSION["form"]["preco"]; ?>">
            <div class="invalid-feedback">
              <?php echo $_SESSION["erropreco"];
              unset($_SESSION["erropreco"]); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control" name="quantidade" value="<?php if (isset($_SESSION["form"]["quantidade"])) echo $_SESSION["form"]["quantidade"];
                                                                                else echo '0'; ?>" required>
          </div>
          <!-- Quebra Pula uma linha -->
          <br>
          <!-- Botão para salvar o produto -->
          <button type="submit" class="btn btn-outline-success">Salvar</button>
          <!-- Botão de Cancelar -->
          <button type="reset" class="btn btn-outline-danger"
            value="<?php unset($_SESSION['form']); ?>">Cancelar</button>
        </form>
        <?php unset($_SESSION['form']); ?>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
</main>

<?php
require_once 'footer.php';
