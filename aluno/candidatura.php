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
        echo "<a href='candidaturas.php'><button type='submit'>Ver minhas candidaturas</button></a>";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
    ?>



    </ul>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
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
            background-color: #002c5b;
        }
    </style>

</html>