<?php 

require "connection.php";
require "Classes/Vendedor.php";

$sql = "SELECT * FROM vendedor ORDER BY id";
$stmt = $conn->query($sql);
$vendedores = $stmt->fetchAll(PDO::FETCH_CLASS, "Vendedor");

require_once "header.php"; 
?>

<div class="p-4 mb-4 bg-light">
  <h1 class="display-5">Gerenciamento de vededores</h1>
  <hr class="my-3">
  <p class="lead">Permite a inclusão, edição e exclusão de vendedores.</p>
</div>

<div class="container">
  <a class="btn btn-success" href="insert-vendedor.php">Cadastrar novo vendedor</a>
  <p></p>
  <table class="table table-bordered">
    <tr class="table-success text-center text-center">
      <th>#</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Telefone</th>
      <th>Ação</th>
    </tr>
    <?php foreach ($vendedores as $vendedor) { ?>
    <tr class="text-center">
      <td class="table-light" style="width:5%"><?= $vendedor->getId(); ?></td>
      <td class="table-light" style="width:25%"><?= $vendedor->getNome(); ?></td>
      <td class="table-light" style="width:25%"><?= $vendedor->getEmail(); ?></td>
      <td class="table-light" style="width:25%"><?= $vendedor->getTelefone(); ?></td>
      <td class="table-light" style="width:15%">
        <a href="vendedor-edit.php?id=<?= $vendedor->getId(); ?>"><button type="button" class="btn btn-primary">Editar</button></a>
        <a href="vendedor-destroy.php?id=<?= $vendedor->getId(); ?>"><button type="button" class="btn btn-danger">Excluir</button>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>
  </table>
</div>

<?php require_once "footer.php"; ?>