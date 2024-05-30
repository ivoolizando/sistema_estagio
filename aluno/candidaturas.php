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
    <br>
    <h2 style="text-align: center;">Minhas Candidaturas</h2><br>
    <?php
    $usuario = $_SESSION['id'];

    $sql = "SELECT Vaga.ID, Vaga.Titulo as Titulo, Vaga.descricao as Descricao, solicitacoes.status as statusvaga
        FROM Vaga inner join solicitacoes on Vaga.ID = solicitacoes.vaga_id
        WHERE Vaga.ID IN (SELECT vaga_id FROM solicitacoes) ;";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="list-group-item"><h4>' . $row['Titulo'] . '</h4><p>' . $row['Descricao'] . '</p>';
            echo '<form action="candidatura.php" method="post">';
            echo '<input type="hidden" name="vagaId" value="' . $row['ID'] . '">';
            echo '<input type="hidden" name="usuarioId" value="' . $usuario . '">';
            echo '<h5>Status: ' . $row['statusvaga'] . '</h5>';
            echo '</form></li>';
        }
    } else {
        echo '<br> <br> <h2>Não há candidaturas disponíveis no momento.</h2>';
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