<?php
session_start();
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h1 class="mt-2">Cadastro de Novo Usuário</h1>
        <?php //Mensagens de Erro ou Sucesso na execução das funções              
        if (isset($_SESSION['msg'])) {
          echo $_SESSION["msg"];
          // Exibe a mensagem e remove-se da sessão para que não seja exibida novamente.
          unset($_SESSION["msg"]);
        }
        ?>

        <!-- Formulario para cadastro de novo usuário -->
        <form action="salvarUsuario.php" method="post" id="formCadastro">

          <!-- Campo de Login -->
          <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control <?php if (isset($_SESSION["erroLogin"])) echo 'is-invalid'; ?>"
              name="login" value="<?php if (isset($_SESSION["form"]["login"])) echo $_SESSION["form"]["login"]; ?>"
              required>
            <!-- Mensagem para Digitar uma Senha -->
            <div class="invalid-feedback">
              <?php echo $_SESSION["erroLogin"];
              unset($_SESSION["erroLogin"]); ?>
            </div>
          </div>

          <!-- Campo de Nome -->
          <div class="form-group">
            <label for="Nome Completo" class="col-form-label">Nome Completo</label>
            <input type="text" class="form-control" name="nome" id="nome"
              value="<?php if (isset($_SESSION["form"]["nome"])) echo $_SESSION["form"]["nome"]; ?>" required>
            <!-- Mensagem para Digitar uma Senha -->
            <div class="invalid-feedback">
              <?php echo $_SESSION["errosenha"];
              unset($_SESSION["errosenha"]); ?>
            </div>
          </div>

          <!-- Campo de Senha -->
          <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control <?php if (isset($_SESSION["errosenha"])) echo 'is-invalid'; ?>"
              name="senha" value="<?php if (isset($_SESSION["form"]["senha"])) echo $_SESSION["form"]["senha"]; ?>">
            <!-- Mensagem para Digitar uma Senha -->
            <div class="invalid-feedback">
              <?php echo $_SESSION["errosenha"];
              unset($_SESSION["errosenha"]); ?>
            </div>
          </div>

          <!-- Campo de Email -->
          <div class="form-group">
            <label for="Email">Email</label>
            <input type="text" class="form-control <?php if (isset($_SESSION["erroEmail"])) echo 'is-invalid'; ?>"
              name="email" value="<?php if (isset($_SESSION["form"]["email"])) echo $_SESSION["form"]["email"]; ?>">
            <!-- Mensagem para Digitar Email Válido-->
            <div class="invalid-feedback">
              <?php echo $_SESSION["erroEmail"];
              unset($_SESSION["erroEmail"]); ?>
            </div>
          </div>

          <!-- Dropdown Tipo de Permissão -->

          <div class="form-group">
            <label class="permissao" for="permissao">Nível de Acesso</label> <br>
            <select class="form-control <?php if (isset($_SESSION["erroPermissao"])) echo 'is-invalid'; ?>"
              name="permissao" id="permissao">
              <!-- Permissão de Seleciona -->
              <option value="Selecione"
                <?php echo isset($_SESSION["form"]["permissao"]) && $_SESSION["form"]["permissao"] === 'Selecione' ? 'selected' : ''; ?>
                hidden>Selecione</option>
              <!-- Permissão de Administrador -->
              <option value="Admin"
                <?php echo isset($_SESSION["form"]["permissao"]) && $_SESSION["form"]["permissao"] === 'Admin' ? 'selected' : ''; ?>>
                Administrador</option>
              <!-- Permissão de Normal -->
              <option value="Normal"
                <?php echo isset($_SESSION["form"]["permissao"]) && $_SESSION["form"]["permissao"] === 'Normal' ? 'selected' : ''; ?>>
                Normal</option>
              <!-- Permissão Somente Leitura -->
              <option value="Leitura"
                <?php echo isset($_SESSION["form"]["permissao"]) && $_SESSION["form"]["permissao"] === 'Leitura' ? 'selected' : ''; ?>>
                Somente Leitura</option>
            </select>
            <!-- Mensagem para Seleionar Permissão Válido -->
            <div class="invalid-feedback">
              <?php echo isset($_SESSION["erroPermissao"]) ? $_SESSION["erroPermissao"] : ''; ?>
              <?php unset($_SESSION["erroPermissao"]); ?>
            </div>
          </div>
          <br>
          <!-- Botão envio de dados -->
          <button type="submit" class="btn btn-outline-success">Salvar</button>
          <!-- Botão cancelar -->
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