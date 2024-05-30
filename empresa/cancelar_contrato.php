<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $contrato_id = mysqli_real_escape_string($conn, $_POST['contrato_id']);
  $dataAtual = date_create()->format('Y-m-d');

  if ($contrato_id != null) {
    $sql = "UPDATE Contratado SET DataDespacho = '$dataAtual' WHERE ID = '$contrato_id';";
    $result = mysqli_query($conn, $sql);
    $_SESSION['message'] = 'Estágio Cancelado com sucesso!';
    $_SESSION['msg_type'] = 'successo';
    header("Location: contratos.php");
    exit();
  }
}
?>
