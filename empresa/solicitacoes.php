<?php
include("../conexao.php");
session_start();
include("componentes/header.php");
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
    <div class="content"></div>
    <ul class="list-group">
        <?php
        $vagaId = $_POST['vaga_id'];
        $usuario = $_SESSION['id'];
        $sql = "SELECT Aluno.ID as AlunoID, Aluno.Nome as Aluno, Aluno.Email as EmailAluno, Aluno.Curriculo as Curriculo, Vaga.Titulo as Vaga, solicitacoes.status as status 
        FROM solicitacoes 
        INNER JOIN Aluno ON solicitacoes.aluno_id = Aluno.ID 
        INNER JOIN Vaga ON solicitacoes.vaga_id = Vaga.ID
        WHERE Vaga.ID = " . $vagaId . ";";

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="list-group-item"><h4>' . $row['Aluno'] . '</h4><p>' . $row['EmailAluno'] . '</p><a target="_blank" href="../' . $row['Curriculo'] . '"><button style="margin-bottom:10px;">Ver Currículo</button></a><h5>Vaga: ' . $row['Vaga'] . '</h5><h5>Status: ' . $row['status'] . '</h5>';
            echo '<form action="contratar.php" method="post">';
            echo '<input type="hidden" name="aluno" value="' . $row['Aluno'] . '">';
            echo '<input type="hidden" name="aluno_id" value="' . $row['AlunoID'] . '">';
            echo '<input type="hidden" name="vaga" value="' . $row['Vaga'] . '">';
            echo '<input type="submit" name="dados" class="btn btn-primary float-right" value="Contratar">';
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