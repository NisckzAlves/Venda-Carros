<?php 

require "connection.php";
require "Classes/Carro.php";

$sql = "SELECT * FROM carro ORDER BY id";
$stmt = $conn->query($sql);
$carros = $stmt->fetchAll(PDO::FETCH_CLASS, "Carro");

require_once "header.php"; 
?>

<div class="p-4 mb-4 bg-light">
  <h1 class="display-5">Gerenciamento de carros</h1>
  <hr class="my-3">
  <p class="lead">Permite a inclusão, edição e exclusão de carros.</p>
</div>

<div class="container">
  <a class="btn btn-success" href="insert-veiculo.php">Cadastrar novo carro</a>
  <p></p>
  <table class="table table-bordered">
    <tr class="table-success text-center text-center">
      <th>#</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Ano fabricação</th>
      <th>Ano modelo</th>
      <th>Combustivel</th>
      <th>Cor</th>
      <th>Preço</th>
      <th>Detalhes</th>
      <th>imagem</th>
      <th>Ação</th>
    </tr>
    <?php foreach ($carros as $carro) { ?>
    <tr class="text-center">
      <td class="table-light" style="width:5%"><?= $carro->getId(); ?></td>
      <td class="table-light" style="width:10%"><?= $carro->getMarca(); ?></td>
      <td class="table-light" style="width:10%"><?= $carro->getModelo(); ?></td>
      <td class="table-light" style="width:10%"><?= $carro->getAnoFabricacao(); ?></td>
      <td class="table-light" style="width:10%"><?= $carro->getAnoModelo(); ?></td>
      <td class="table-light" style="width:10%"><?= $carro->getCombustivel(); ?></td>
      <td class="table-light" style="width:10%"><?= $carro->getCor(); ?></td>
      <td class="table-light" style="width:10%">R$<?= $carro->getPreco(); ?></td>
      <td class="table-light" style="width:25%"><?= $carro->getDetalhes(); ?></td>
      <td class="table-light" style="width:25%"><img src="<?= $carro->getfoto(); ?>" width="200px"></td>
      <td class="table-light" style="width:25%">
        <a href="carro-edit.php?id=<?= $carro->getId(); ?>"><button type="button" class="btn btn-primary">Editar</button></a>
        <a href="carro-destroy.php?id=<?= $carro->getId(); ?>"><button type="button" class="btn btn-danger">Excluir</button>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>
  </table>
</div>

<?php require_once "footer.php"; ?>