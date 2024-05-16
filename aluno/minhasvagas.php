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
</head>

<body>
    <div class="content"></div>
    <ul class="list-group">
        <?php
        if (isset($_SESSION['id'])) {
            $aluno_id = $_SESSION['id'];
            $sql = "SELECT * FROM solicitacoes WHERE aluno_id = '$aluno_id'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li class="list-group-item"><h4>' . $row['Titulo'] . '</h4><p>' . $row['Descricao'] . '</p>';
                echo '<button class="btn btn-primary float-right">Ver Detalhes</button></li>';
            }
        } else {
            // Trate o caso em que $_SESSION['id'] não está definido
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