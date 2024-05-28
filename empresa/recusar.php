<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $vaga_id = mysqli_real_escape_string($conn, $_POST['vaga_id']);
  $solicitacao_id = mysqli_real_escape_string($conn, $_POST['solicitacao_id']);

  if ($vaga_id != null) {
    $sql = "UPDATE solicitacoes SET status = 'despachado' WHERE ID = '$solicitacao_id';";
    $result = mysqli_query($conn, $sql);
    $_SESSION['mensagem'] = "Candidatura cancelada!";
    $_SESSION['vaga_id'] = $vaga_id;
    header("Location: solicitacoes.php");
  }
}
?>
