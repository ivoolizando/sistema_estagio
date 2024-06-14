<?php
session_start();
include("../conexao.php");
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
  <a href="vagas.php"><button class="btn">Ver Vagas</button></a>

  <body>
    <br>
    <h2>Meus Contratos</h2><br>
    <ul class="list-group">

    <?php
    if (isset($_SESSION['mensagem'])) {
      echo '<div class="alert alert-success" role="alert">
                  ' . $_SESSION['mensagem'] . '
                </div>';
      unset($_SESSION['mensagem']);
    }
    ?>
      <ul class="list-group">
        <?php

        function formatDate($date) {
            return date("d/m/Y", strtotime($date));
        }

        $sql = "SELECT
        Empresa.ID,
        Contratado.ID as ContratoID,
        Vaga.Titulo as VagaTitulo,
        Curso.Nome as Curso,
        Aluno.Nome as AlunoNome,
        Contratado.Setor as Setor,
        Contratado.Turno as Turno,
        Contratado.DataEstagioInicio as EstagioInicio,
        Contratado.DataEstagioFinal as EstagioFim,
        Contratado.DataContratacao as DataContratacao,
        Contratado.DataDespacho as DataDespacho,
        Contratado.ValorBolsa as Bolsa
        FROM Contratado
        INNER JOIN Empresa on Contratado.EmpresaID = Empresa.ID
        INNER JOIN Aluno on Contratado.AlunoID = Aluno.ID
        INNER JOIN Vaga on Contratado.VagaID = Vaga.ID
        INNER JOIN Curso on Contratado.Curso = Curso.ID
        WHERE Empresa.ID = " . $_SESSION["id"] . ";";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);

        if ($rows>0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="list-group-item" >';
            echo '<div><h5>' . $row['VagaTitulo'] . '</h5></div>';
            echo '<div>' . "<br><h5>Curso</h5>" . $row['Curso'] . '</div>';
            echo '<div>' . "<br><h5>Aluno</h5>" . $row['AlunoNome'] . '</div>';
            echo '<div>' . "<br><h5>Departamento</h5>" . $row['Setor'] . '</div>';
            echo '<div>' . "<br><h5>Turno</h5>" . $row['Turno'] . '</div>';
            echo '<div>' . "<br><h5>Data de início do estágio</h5>" . formatDate($row['EstagioInicio']) . '</div>';
            echo '<div>' . "<br><h5>Data término do estágio</h5>" . formatDate($row['EstagioFim']) . '</div>';
            echo '<div>' . "<br><h5>Data de Contratação</h5>" . formatDate($row['DataContratacao']) . '</div>';
            if ($row['DataDespacho']!=null) {
            echo '<div>' . "<br><h5>Data de distrato</h5>" . formatDate($row['DataDespacho']) . '</div>';
            }
            echo '<div>' . "<br><h5>Valor da Bolsa</h5>" . $row['Bolsa'] . '</div>';
            if ($row['DataDespacho']!=null) {
            echo '<br><div class="alert alert-danger" role="alert">
                    Contrato encerrado.
                  </div>';
            }
            echo '<div class="botao">';
            if ($row['DataDespacho']==null) {
            echo '<form method="POST" action="renovar_contrato.php" style="">';
            echo '<input type="hidden" name="contrato_id" value="' . $row['ContratoID'] . '">';
            echo '<input type="hidden" name="estagiodatafinal" value="' . $row['EstagioFim'] . '">';
            echo '<button type="submit">Renovar Contrato</button>';
            echo '</form>';
            echo '<form method="POST" action="cancelar_contrato.php">';
            echo '<input type="hidden" name="contrato_id" value="' . $row['ContratoID'] . '">';
            echo '<button type="submit" style="background-color:red;">Cancelar Contrato</button>';
            echo '</form>';
            }
            // echo '<form method="POST" action="encerrar_vaga.php" style="">';
            // echo '<input type="hidden" name="vaga_id" value="' . $row['ID'] . '">';
            // echo '<button class="excluir" type="submit" style="background: red;">Encerrar Contrato</button>';
            // echo '</form>';
            echo '</div>';
            echo '</li>';
          }
        }

        else {
            echo 'Você não possui contratos ativos no momento';
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
    background-color: #002c5b;
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
    background-color: #002c5b;
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