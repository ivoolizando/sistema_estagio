<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $vaga_id = mysqli_real_escape_string($conn, $_POST['vaga_id']);

  if ($vaga_id != null) {
    $sql = "DELETE FROM Vaga WHERE ID = '$vaga_id';";
    $result = mysqli_query($conn, $sql);
    $_SESSION['mensagem'] = "Vaga excluída!";
    header("Location: vagas.php");
  }
}
?>
