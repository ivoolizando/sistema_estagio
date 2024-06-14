<?php
session_start();
include("../conexao.php");
include("componentes/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = mysqli_real_escape_string($conn, $_POST['Titulo']);

  if ($titulo != null) {
    $sql = "INSERT INTO Curso (Nome) VALUES ('$titulo');";
    $result = mysqli_query($conn, $sql);
    $_SESSION['mensagem'] = "Curso Adicionado!";
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


<body>
  <style>
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

    }

    .list-group-item {
      width: 600px;
    }

    .content {
      width: 600px;
      background-color: #f8f8f8;
      margin: 0 auto;
      padding: 20px;
      width: 600px;
      border-radius: 8px;
    }

    input[type="password"],
    input[type="text"],
    input[type="file"] {
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
  </style>
  <h2>Cadastrar novo curso</h2>

  <?php if (isset($_SESSION['mensagem'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['mensagem'] . '
    </div>';
    unset($_SESSION['mensagem']);
  } ?>

  <form class="content" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    Título: <input type="text" name="Titulo" required>
    <br>
    <input --bs-primary type="submit">
  </form>

  <body>
    <br>
    <h2>Cursos Existentes</h2>
    <ul class="list-group">

      <ul class="list-group">
        <?php
        $sql = "SELECT * from Curso;";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<li class="list-group-item">';
          echo '<div>' . "<h5>Título</h5>" . $row['Nome'] . '</div>';
          echo '<form method="POST" action="excluir_curso.php" style="display: inline; margin-right: 10px;">';
          echo '<input type="hidden" name="curso_id" value="' . $row['ID'] . '">';
          echo '<button type="submit">Excluir</button>';
          echo '</form>';
          echo '<form method="POST" action="editar_curso.php" style="display: inline; margin-right: 10px;">';
          echo '<input type="hidden" name="curso_id" value="' . $row['ID'] . '">';
          echo '<input type="hidden" name="Nome" value="' . $row['Nome'] . '">';
          echo '<button type="submit">Editar</button>';
          echo '</form>';
          echo '<form method="POST" action="solicitacoes.php" style="display: inline; margin-right: 10px;">';
          echo '<input type="hidden" name="curso_id" value="' . $row['ID'] . '">';
          echo '</form>';
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