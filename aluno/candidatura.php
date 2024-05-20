<?php
include("../conexao.php");
include("componentes/header.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Vagas</title>
    <style>
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
</style>
</head>

<body>
    <?php
    $usuarioId = $_POST['usuarioId'];
    $vagaId = $_POST['vagaId'];

    $sql = "INSERT INTO solicitacoes (status,aluno_id, vaga_id) VALUES ('pendente',$usuarioId, $vagaId)";
    if (mysqli_query($conn, $sql)) {
        echo "Candidatura realizada com sucesso!<br>";
        echo "<a href='minhasvagas.php'><button type='submit'>Ver minhas candidaturas</button></a>";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
    ?>



    </ul>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
<style>
    .content {
        margin: auto;
    }

    .list-group {
        margin: auto;
        width: 80vh;
    }

    .list-group-item {
        margin-bottom: 20px;
        /* Espaço entre as vagas */
    }

    .list-group-item h4 {
        color: #007bff;
        /* Cor do título */
        margin-bottom: 10px;
        /* Espaço entre o título e a descrição */
    }

    .list-group-item p {
        margin-bottom: 10px;
        /* Espaço entre a descrição e o botão */
    }
</style>

</html>