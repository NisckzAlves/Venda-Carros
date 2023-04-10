<?php 
require "connection.php";
require "Classes/Carro.php";

$sql = "SELECT * FROM carro ORDER BY marca";
$stmt = $conn->query($sql);
$carros = $stmt->fetchAll(PDO::FETCH_CLASS, "Carro");

require_once "header.php"; 
?>


<div class="p-4 mb-4 bg-light">
  <h1 class="display-5">Carros</h1>
  <hr class="my-3">
  <p class="lead">Conheça os carros disponíveis em nossa plataforma.</p>
</div>

<br />
<div class="container">
  <div class="row featurette">
<?php foreach ($carros as $carro) { ?>
<div class="container">
<div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading"><?= $carro->getMarca(); ?></h2>
      <p class="lead"><?= $carro->getDetalhes(); ?>.</p>
      <p class="lead"><a href="estoque-especifico.php?id=<?= $carro->getId(); ?>"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Saiba mais</button></a></p>
    </div>

    <div class="col-md-5">
      <figure class="figure">
          <img src="<?= $carro->getFoto(); ?>" class="figure-img img-fluid rounded" alt="Curso de PHP" width="500px">
      </figure>
    </div>
  </div>
  <hr class="featurette-divider">
</div>
<?php }?>
</div>
</div>
<?php 
require_once "footer.php"; ?>