<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $curso_id = mysqli_real_escape_string($conn, $_POST['curso_id']);

  if ($curso_id != null) {
    $sql = "DELETE FROM Curso WHERE ID = '$curso_id';";
    $result = mysqli_query($conn, $sql);
    $_SESSION['mensagem'] = "Curso excluído!";
    header("Location: cursos.php");
  }
}
?>
