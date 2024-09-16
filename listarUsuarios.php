<?php
session_start();
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-2">Listagem de Usuários</h1>

    <?php //Mensagens de Erro ou Sucesso na execução das funções              
    if (isset($_SESSION['msg'])) {
      echo $_SESSION["msg"];
      unset($_SESSION["msg"]);
    }
    ?>

    <?php
    //Credenciais para conexão com o Banco
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'crudproduto';

    //Abre conexão com o MySQL   
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    //echo "Charset Padrão: " . $conn -> character_set_name();

    if (!$conn) {
      die('Falha ao conectar com o MySQL: ' . mysqli_connect_error());
    }
    //echo '<br>Conexão ao Banco realizada com Sucesso.';

    $sql = 'SELECT * FROM Usuario';
    $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

    //echo "<PRE>";
    if (mysqli_num_rows($result) > 0) {
      echo '<div class="table-responsive">';
      // echo '  <table class="table table-bordered table-hover table-sm">';
      echo '  <table class="table  table-hover table-sm">';
      echo '    <thead >';
      echo '      <tr class="table-info">';
      echo '        <th class="info">Login</th>';
      echo '        <th class="info">Nome</th>';
      echo '        <th class="info">Email</th>';
      echo '        <th class="info">Tipo de Permissão</th>';
      echo '        <th class="info"></th>';
      echo '      </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '  <td>' . $row['login'] . '</td>';
        echo '  <td>' . $row['nome'] . '</td>';
        echo '  <td>' . $row['email'] . '</td>';
        echo '  <td>' . $row['permissao'] . '</td>';
        echo ' <td> <a href="editarUsuario.php?id=' . $row['login'] . '" class="btn btn-outline-info btn-sm">Editar</a>
              <a href="excluirUsuario.php?id=' . $row['login'] . '&nome=' . $row['nome'] . '" class="btn btn-outline-danger btn-sm mt-1">Excluir</a></td>';

        echo '</tr>';
      }
      echo '    </tbody>';
      echo '  </table>';
      echo '</div>';
    } else {
      echo "Nenhum Produto Encontrado.";
    }

    //echo "</PRE>";

    //Fecha  a conexão
    mysqli_close($conn);
    ?>

  </div>
</main>

<?php
require_once 'footer.php';
