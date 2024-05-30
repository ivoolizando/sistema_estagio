<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $contrato_id = mysqli_real_escape_string($conn, $_POST['contrato_id']);
  $estagiodatafinal = mysqli_real_escape_string($conn, $_POST['estagiodatafinal']);
  $dataNova = date('Y-m-d', strtotime('+1 year', strtotime($estagiodatafinal)));

  if ($contrato_id != null) {
    $sql = "UPDATE Contratado SET DataEstagioFinal = '$dataNova' WHERE ID = '$contrato_id';";
    $result = mysqli_query($conn, $sql);
    $_SESSION['mensagem'] = "Estágio renovado com sucesso!";
    header('Location: contratos.php');
    exit();
  }
}
?>
