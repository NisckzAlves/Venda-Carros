<?php
$marca = "";
$modelo ="";
$cor ="";
$anoFabricacao="";
$anoModelo="";
$combustivel="";
$preco="";
$detalhes="";
$flag_msg = null;
$msg = "";

if (isset($_POST["enviar"])) {
  try {
    require("connection.php");
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $cor = $_POST["cor"];
    $anoFabricacao = $_POST["anoFabricacao"];
    $anoModelo = $_POST["anoModelo"];
    $combustivel = $_POST["combustivel"];
    $preco = $_POST["preco"];
    $detalhes = $_POST["detalhes"];
    if (isset($_POST["foto"])) {
        $foto=$_POST["foto"];
      } else {
        $foto = "";
      }
    
      if (empty($_POST["marca"]) || empty($_POST["modelo"]) || empty($_POST["cor"]) || empty($_POST["anoFabricacao"]) || empty($_POST["anoModelo"]) || empty($_POST["combustivel"]) || empty($_POST["preco"]) || empty($_POST["detalhes"]) || empty($_FILES["foto"]["name"])) {
        $flag_msg = false;  
        $msg = "Dados incompletos, preencha o formulário corretamente!";
    }

    $target_dir = "uploads/";

    $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $target_file = $target_dir . uniqid() . '.' . $file_extension;
    
    if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO carro (marca, modelo, cor, anoFabricacao, anoModelo, combustivel, preco, detalhes, foto) VALUES (:marca, :modelo, :cor, :anoFabricacao, :anoModelo, :combustivel, :preco, :detalhes, :foto)");
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":modelo", $modelo);
        $stmt->bindParam(":cor", $cor);
        $stmt->bindParam(":anoFabricacao", $anoFabricacao);
        $stmt->bindParam(":anoModelo", $anoModelo);
        $stmt->bindParam(":combustivel", $combustivel);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":detalhes", $detalhes);
        $stmt->bindParam(":foto", $target_file);
        $stmt->execute();

        $flag_msg = true; // Sucesso 
        $msg = "Dados enviados com sucesso!";

    }
  } catch(PDOException $e) {
    $flag_msg = false; //Erro 
    $msg = "Erro na conexão com o Banco de dados: " . $e->getMessage();
  }
  
  $conn = null;
}
require_once "header.php";
?>
<div class="p-4 mb-4 bg-light">
  <h1 class="display-5">Veiculos</h1>
  <hr class="my-3">
  <p class="lead">Cadastre um novo veiculo.</p>
</div>

<div class="container">
<a class="btn btn-success" href="carros-list.php">Voltar</a>
  <?php 
    if (!is_null($flag_msg)) {
      if ($flag_msg) {
        echo "<div class='alert alert-success' role='alert'>$msg</div>"; 
      } else {
        echo "<div class='alert alert-warning' role='alert'>$msg</div>"; 
      }
    }
  ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
    <div class="form-group" id="marcaVeiculo">
  <label for="marca">Marca:</label>
  <input type="text" class="form-control" id="marca" name="marca">
</div>

<div class="form-group" id="modeloVeiculo">
  <label for="modelo">Modelo:</label>
  <input type="text" class="form-control" id="modelo" name="modelo">
</div>

<div class="form-group" id="corVeiculo">
  <label for="cor">Cor:</label>
  <input type="text" class="form-control" id="cor" name="cor">
</div>

<div class="form-group" id="anoFabricacaoVeiculo">
  <label for="anoFabricacao">Ano de Fabricação:</label>
  <input type="text" class="form-control" id="anoFabricacao" name="anoFabricacao">
</div>

<div class="form-group" id="anoModeloVeiculo">
  <label for="anoModelo">Ano do Modelo:</label>
  <input type="text" class="form-control" id="anoModelo" name="anoModelo">
</div>

<div class="form-group" id="combustivelVeiculo">
  <label for="combustivel">Combustível:</label>
  <select class="form-control" id="combustivel" name="combustivel">
    <option value="gasolina">Gasolina</option>
    <option value="etanol">Etanol</option>
    <option value="diesel">Diesel</option>
  </select>
</div>

<div class="form-group" id="precoVeiculo">
  <label for="preco">Preço:</label>
  <input type="text" class="form-control" id="preco" name="preco">
</div>

<div class="form-group" id="detalhesVeiculo">
  <label for="detalhes">Detalhes:</label>
  <textarea class="form-control" id="detalhes" name="detalhes" rows="3"></textarea>
</div>
    <div class="form-group">
      <label for="imagemCurso">Imagem:</label>
      <input type="file" name="foto" accept="image/*" class="form-control" id="foto" value="<?= $foto; ?>">
    </div>
    <br/>
    <button type="submit" class="btn btn-primary mb-2" name="enviar">Enviar</button>
    <a href="cadastroCurso.php"><button type="button" class="btn btn-primary mb-2" name="limpar">Limpar</button></a>
  </form>
</div>
</div>
<?php require_once "footer.php"; ?>