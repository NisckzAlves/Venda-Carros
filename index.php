<?php 

require "connection.php";
require "Classes/Vendedor.php";

$sql = "SELECT * FROM vendedor ORDER BY id";
$stmt = $conn->query($sql);
$vendedores = $stmt->fetchAll(PDO::FETCH_CLASS, "Vendedor");

require_once "header.php"; 
?>
<div class="b-example-divider"></div>

<div class="container col-xxl-8 px-4 py-5">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
      <img src="Images/Fachada.jpeg" class="d-block mx-lg-auto img-fluid" alt="Loja Cursos" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">AutoElite</h1>
      <p class="lead">
      A AutoElite é uma loja de carros que se destaca pela qualidade e diversidade de seu estoque, 
      além de contar com uma equipe experiente e 
      capacitada para auxiliar os clientes em todas as etapas da compra.</p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="cursos.php"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Conheça nossos vendedores</button></a>
      </div>
    </div>
  </div>
</div>
<?php foreach ($vendedores as $vendedor) { ?>
<div>
<p>Nome: <?= $vendedor->getNome(); ?></p>
<p>Email: <?= $vendedor->getEmail(); ?></p>
<p>Telefone: <?= $vendedor->getTelefone(); ?></p>
</div>
<?php }?>


</div>

<?php require_once "footer.php"; ?>