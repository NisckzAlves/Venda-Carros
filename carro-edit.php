<?php
require_once "connection.php"; //moved require outside of if block

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM carro WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
    $carro = $stmt->fetch(); 
} else {
    header("Location: carros-list.php"); //redirect if no id provided
    exit;
}

$flag_msg = null;
$msg = "";

if (isset($_POST["enviar"])) {
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $cor = $_POST["cor"];
    $anoFabricacao = $_POST["anoFabricacao"];
    $anoModelo = $_POST["anoModelo"];
    $combustivel = $_POST["combustivel"];
    $preco = $_POST["preco"];
    $detalhes = $_POST["detalhes"];
    $novaFoto = $_FILES["novaFoto"]["name"] ?? "";
    $foto = empty($novaFoto) ? $_POST["fotoAntiga"] : $novaFoto;

    if (empty($marca) || empty($modelo) || empty($cor) || empty($anoFabricacao) || empty($anoModelo) || empty($combustivel) || empty($preco) || empty($detalhes)) {
        $flag_msg = false;  
        $msg = "Dados incompletos, preencha o formulário corretamente!";
    } else {
        $target_dir = "uploads/";
        $file_extension = pathinfo($novaFoto, PATHINFO_EXTENSION) ?? pathinfo($_POST['fotoAntiga'], PATHINFO_EXTENSION);
        $target_file = $target_dir . uniqid() . '.' . $file_extension;
        if (move_uploaded_file($_FILES['novaFoto']['tmp_name'], $target_file) || !empty($_POST['fotoAntiga'])) {
            $stmt = $conn->prepare("UPDATE carro SET marca=:marca, modelo=:modelo, cor=:cor, anoFabricacao=:anoFabricacao, anoModelo=:anoModelo, combustivel=:combustivel, preco=:preco, detalhes=:detalhes, foto=:foto WHERE id=:id");
            $stmt->bindParam(":marca", $marca);
            $stmt->bindParam(":modelo", $modelo);
            $stmt->bindParam(":cor", $cor);
            $stmt->bindParam(":anoFabricacao", $anoFabricacao);
            $stmt->bindParam(":anoModelo", $anoModelo);
            $stmt->bindParam(":combustivel", $combustivel);
            $stmt->bindParam(":preco", $preco);
            $stmt->bindParam(":detalhes", $detalhes);
            $stmt->bindParam(":foto", $target_file);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $flag_msg = true; // Success 
                $msg = "Dados atualizados com sucesso!";
            } else {
                $flag_msg = false; // Error 
                $msg = "Erro ao atualizar os dados.";
            }
        } else {
            $flag_msg = false; // Error 
            $msg = "Erro ao fazer upload da imagem.";
        }
    }
}

require_once "header.php";

?>
<div class="p-4 mb-4 bg-light">
  <h1 class="display-5">Edição de carros</h1>
  <hr class="my-3">
  <p class="lead">Atualize um carro já existente.</p>
</div>

<div class="container">
<a class="btn btn-success" href="carros-list.php">Voltar</a>
  <p></p>
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
<div class="form-group" id="marcaVeiculo">
  <label for="marca">Marca:</label>
  <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $carro['marca']; ?>">
</div>
<div class="form-group" id="modeloVeiculo">
  <label for="modelo">Modelo:</label>
  <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $carro['modelo']; ?>">
</div>

<div class="form-group" id="corVeiculo">
  <label for="cor">Cor:</label>
  <input type="text" class="form-control" id="cor" name="cor" value="<?php echo $carro['cor']; ?>">
</div>

<div class="form-group" id="anoFabricacaoVeiculo">
  <label for="anoFabricacao">Ano de Fabricação:</label>
  <input type="text" class="form-control" id="anoFabricacao" name="anoFabricacao" value="<?php echo $carro['anoFabricacao']; ?>">
</div>

<div class="form-group" id="anoModeloVeiculo">
  <label for="anoModelo">Ano do Modelo:</label>
  <input type="text" class="form-control" id="anoModelo" name="anoModelo" value="<?php echo $carro['anoModelo']; ?>">
</div>

<div class="form-group" id="combustivelVeiculo">
  <label for="combustivel">Combustível:</label>
  <select class="form-control" id="combustivel" name="combustivel" value="<?php echo $carro['combustivel']; ?>">
    <option value="gasolina">Gasolina</option>
    <option value="etanol">Etanol</option>
    <option value="diesel">Diesel</option>
  </select>
</div>

<div class="form-group" id="precoVeiculo">
  <label for="preco">Preço:</label>
  <input type="text" class="form-control" id="preco" name="preco" value="<?php echo $carro['preco']; ?>">
</div>

<div class="form-group" id="detalhesVeiculo">
  <label for="detalhes">Detalhes:</label>
  <textarea class="form-control" id="detalhes" name="detalhes" rows="3"> <?php echo $carro['detalhes']; ?></textarea>
</div>
<div class="form-group" id="fotoCarro">
  <label for="foto">Foto atual:</label><br>
  <img src="<?php echo $carro['foto']; ?>" height="100"><br>
  <input type="file" name="novaFoto" accept="image/*" class="form-control" id="novaFoto">
  <input type="hidden" name="fotoAntiga" value="<?php echo $carro['foto']; ?>">
</div>

    <br/>
    <button type="submit" class="btn btn-primary mb-2" name="enviar">Enviar</button>
    <a href="cadastroCurso.php"><button type="button" class="btn btn-primary mb-2" name="limpar">Limpar</button></a>
  </form>
</div>

<?php require_once "footer.php"; ?>