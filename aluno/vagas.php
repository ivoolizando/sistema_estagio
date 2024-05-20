<?php
include("../conexao.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
include("componentes/header.php");
?>

<body>
    <div class="content"></div>
    <ul class="list-group">
        <?php
        $usuario = $_SESSION['id'];
        $sql = "SELECT *
        FROM Vaga
        WHERE ID NOT IN (SELECT vaga_id FROM solicitacoes);";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="list-group-item"><h4>' . $row['Titulo'] . '</h4><p>' . $row['Descricao'] . '</p>';
            echo '<form action="candidatura.php" method="post">';
            echo '<input type="hidden" name="vagaId" value="' . $row['ID'] . '">';
            echo '<input type="hidden" name="usuarioId" value="' . $usuario . '">';
            echo '<input type="submit" class="btn btn-primary float-right" value="Candidatar-se">';
            echo '</form></li>';
        }
        ?>

    </ul>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function candidatar(vagaId) {
            $.ajax({
                url: 'candidatar.php',
                type: 'post',
                data: {
                    'vaga_id': vagaId,
                    'aluno_id': '<?php echo $_SESSION['aluno_id']; ?>'
                },
                success: function(response) {
                    alert(response);
                }
            });
        }
    </script>
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