<?php
session_start();
include("../conexao.php");
include("componentes/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($conn, $_POST['Titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['Descricao']);
    $url = mysqli_real_escape_string($conn, $_POST['Url']);

    if ($titulo != null && $descricao != null) {
        $sql = "INSERT INTO Curso (Nome, Descricao, EmpresaID, Video) VALUES ('$titulo', '$descricao',' " . $_SESSION["id"] . "', '$url');";
        $result = mysqli_query($conn, $sql);
        $_SESSION['mensagem'] = "Curso Adcionado!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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


    <body>
        <br>
        <h2>CURSOS EXISTENTES</h2>
        <ul class="list-group">

            <ul class="list-group">
                <?php
                $sql = "SELECT * from Curso";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li class="list-group-item">';
                    echo '<div>' . "<h5>Título</h5>" . $row['Nome'] . '</div>';
                    // echo '<div>' . "<br><h5>Descrição</h5>" . $row['Descricao'] . '</div>';
                    // echo '<iframe width="560" height="315" src="' . $row['Video'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                    // echo '</li><br><br>';
                }
                ?>
            </ul>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    </body>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</body>

</html>