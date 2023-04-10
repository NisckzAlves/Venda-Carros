<?php 

if (isset($_GET['id'])) {
    require "connection.php";
    require "classes/Carro.php";

    $id = $_GET['id'];
    $lida = true;

    $sql = "SELECT * FROM carro WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]); 
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Carro');
    $carro = $stmt->fetch();


}else{
    header("location: contato-list.php");
    exit;
}
require_once "header.php"; 
?>

<div class="p-4 mb-4 bg-light">
  <h1 class="display-5">Saiba mais</h1>
  <hr class="my-3">
</div>

<div class="container">
  <a class="btn btn-primary" href="estoque.php">Voltar</a>
  <p></p>
  <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Marca: </strong>
                <?= $carro->getMarca(); ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Modelo: </strong>
                <?= $carro->getModelo(); ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cor: </strong>
                <?= $carro->getCor(); ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ano fabricação: </strong>
                <?= $carro->getAnoFabricacao(); ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ano modelo: </strong>
                <?= $carro->getAnoModelo(); ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Combustivel: </strong>
                <?= $carro->getCombustivel(); ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Preço: </strong>
                <?= $carro->getPreco(); ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detalhes: </strong>
                <?= $carro->getDetalhes(); ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <img src=" <?= $carro->getFoto(); ?>" width="300px">
            </div>
        </div>

    </div>
</div>

<?php require_once "footer.php"; ?>