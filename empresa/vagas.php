<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = mysqli_real_escape_string($conn, $_POST['Titulo']);
  $descricao = mysqli_real_escape_string($conn, $_POST['Descricao']);
  $curso = mysqli_real_escape_string($conn, $_POST['Curso']);
  $turno = mysqli_real_escape_string($conn, $_POST['Turno']);
  $setor = mysqli_real_escape_string($conn, $_POST['Setor']);
  $periodoselecao = mysqli_real_escape_string($conn, $_POST['PeriodoSelecao']);
  $periodoestagio = mysqli_real_escape_string($conn, $_POST['PeriodoEstagio']);
  $valorbolsa = mysqli_real_escape_string($conn, $_POST['ValorBolsa']);

  if ($titulo != null && $descricao != null) {
    $sql = "INSERT INTO Vagas (Titulo, Descricao, Curso, Turno, Setor, PeriodoSelecao, PeriodoEstagio, ValorBolsa, EmpresaID) VALUES ('$titulo', '$descricao', '$curso', '$turno','$setor', '$periodoselecao','$periodoestagio', '$valorbolsa', " . $_SESSION["id"] . ");";
    $result = mysqli_query($conn, $sql);
    $_SESSION['mensagem'] = "Vaga adicionada!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<?php
include("componentes/header.php");
?>

<body>
  <a href="criar_vagas.php"><button class="btn">Nova Vaga</button></a>

  <?php if (isset($_SESSION['mensagem'])) {
    echo '<script> alert("' . $_SESSION['mensagem'] . '"); window.location.href = "vagas.php";</script>';
    unset($_SESSION['mensagem']);
  } ?>

  <body>
    <br>
    <h2>Vagas</h2>
    <ul class="list-group">

      <ul class="list-group">
        <?php
        $sql = "SELECT * from Vaga where EmpresaID = " . $_SESSION["id"] . ";";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<li class="list-group-item" >';
          echo '<div>' . "<h5>Título</h5>" . $row['Titulo'] . '</div>';
          echo '<div>' . "<br><h5>Descrição</h5>" . $row['Descricao'] . '</div>';
          echo '<div class="botao">';
          echo '<form method="POST" action="editar_vaga_form.php" style="">';
          echo '<input type="hidden" name="vaga_id" value="' . $row['ID'] . '">';
          echo '<input type="hidden" name="Titulo" value="' . $row['Titulo'] . '">';
          echo '<input type="hidden" name="Descricao" value="' . $row['Descricao'] . '">';
          echo '<button type="submit">Editar</button>';
          echo '</form>';
          echo '<form method="POST" action="solicitacoes.php" style="">';
          echo '<input type="hidden" name="vaga_id" value="' . $row['ID'] . '">';
          echo '<button type="submit">Ver Solicitações</button>';
          echo '</form>';
          echo '<form method="POST" action="excluir_vaga.php" style="">';
          echo '<input type="hidden" name="vaga_id" value="' . $row['ID'] . '">';
          echo '<button class="excluir" type="submit" style="background: red;">Encerra vaga</button>';
          echo '</form>';
          echo '</div>';
          echo '</li>';
        }
        ?>
      </ul>


  </body>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</body>

</html>
<style>
  .botao {
    display: flex;
    flex-direction: row;
    gap: 10px
  }

  body {
    font-family: Arial, sans-serif;
  }

  h2 {
    color: #333;
    TEXT-ALIGN: center;
  }

  .list-group {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;

  }

  .list-group-item {
    width: 600px;
  }

  .content {
    background-color: #f8f8f8;
    margin: 0 auto;
    padding: 20px;
    width: 600px;
    border-radius: 8px;
  }

  select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type="submit"] {
    width: 100%;
    background-color: #007BFF;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #45a049;
  }

  button[type="submit"] {
    width: auto;
    background-color: #007BFF;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button[type="submit"]:hover {
    background-color: #45a049;
  }

  .btn {
    width: auto;
    background-color: #007BFF;
    color: #FFF;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn:hover {
    background-color: #002c5b;
    color: #FFF;
  }

  a{
    margin: 20px;
  }
</style>