<?php
require("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM vendedor WHERE id = :id";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
    $vendedor = $stmt->fetch(); 
} else {
    header("Location: list-vendedores.php"); 
    exit;
}

$nome= "";
$email = "";
$telefone ="";
$flag_msg = null;
$msg = "";

if (isset($_POST["enviar"])) {
  try {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    
      if (empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["telefone"]) ) {
        $flag_msg = false;  
        $msg = "Dados incompletos, preencha o formulário corretamente!";
    }

    else {
        $stmt = $conn->prepare("UPDATE vendedor SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id");

        // atribui os valores aos parâmetros da query e executa
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $flag_msg = true; // Sucesso 
        $msg = "Dados enviados com sucesso!";
    }
  } catch(PDOException $e) {
    $flag_msg = false; //Erro 
    $msg = "Erro na conexão com o Banco de dados: " . $e->getMessage();
  }
}

require_once "header.php";
?>

<div class="p-4 mb-4 bg-light">
  <h1 class="display-5">Vendedores</h1>
  <hr class="my-3">
  <p class="lead">Cadastre um novo vendedor.</p>
</div>

<div class="container">
<a class="btn btn-success" href="list-vendedores.php">Voltar</a>
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
  <label for="nome">Nome:</label>
  <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $vendedor['nome']?>">
</div>

<div class="form-group" id="modeloVeiculo">
  <label for="email">E-mail:</label>
  <input type="email" class="form-control" id="email" name="email" value="<?php echo $vendedor['email']?>">
</div>

<div class="form-group" id="corVeiculo">
  <label for="telefone">Telefone:</label>
  <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $vendedor['telefone']?>">
</div>


    <button type="submit" class="btn btn-primary mb-2" name="enviar">Enviar</button>
    <a href="vendedor-edit.php"><button type="button" class="btn btn-primary mb-2" name="limpar">Limpar</button></a>
  </form>
</div>
</div>
<?php require_once "footer.php"; ?>