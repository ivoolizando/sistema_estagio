<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $contrato_id = mysqli_real_escape_string($conn, $_POST['contrato_id']);
  $dataAtual = date_create()->format('Y-m-d');

  if ($contrato_id != null) {
    $sql = "UPDATE Contratado SET DataDespacho = '$dataAtual' WHERE ID = '$contrato_id';";
    $result = mysqli_query($conn, $sql);
    echo "<script type='text/javascript'>
                    alert('Estágio Cancelado com sucesso!');
                    window.location.href = 'contratos.php';
                  </script>";
    exit();
  }
}
?>
