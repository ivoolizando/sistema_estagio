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
    <style>
        input[type="submit"]:hover {
            background-color: #002c5b;
        }

        button[type="submit"]:hover {
            background-color: #002c5b;
        }
    </style>
    <div class="content"></div>
    <ul class="list-group">
        <?php
        if(isset($_SESSION['vaga_id'])) {

            $vagaId = $_SESSION['vaga_id'];
            unset($_SESSION['vaga_id']);
        }
        else {
            $vagaId = $_POST['vaga_id'];
        }
        $usuario = $_SESSION['id'];
        $sql = "SELECT solicitacoes.id as solicitacao_id , Aluno.ID as AlunoID, Aluno.Nome as Aluno, Aluno.Email as EmailAluno, Aluno.Curriculo as Curriculo, Vaga.ID as Vaga, Vaga.Titulo as VagaTitulo, Vaga.Curso as Curso, solicitacoes.status as status
        FROM solicitacoes 
        INNER JOIN Aluno ON solicitacoes.aluno_id = Aluno.ID 
        INNER JOIN Vaga ON solicitacoes.vaga_id = Vaga.ID
        WHERE Vaga.ID = " . $vagaId . ";";

        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows>0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li class="list-group-item"><h4>' . $row['Aluno'] . '</h4><p>' . $row['EmailAluno'] . '</p><a target="_blank" href="../' . $row['Curriculo'] . '"><button style="margin-bottom:10px;">Ver Currículo</button></a><h5>Vaga: ' . $row['VagaTitulo'] . '</h5><h5>Status: ' . $row['status'] . '</h5>';
                if (isset($_SESSION['mensagem'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['mensagem'] . '
                              </div>';
                    unset($_SESSION['mensagem']);
                }
                if ($row['status']=='pendente') {
                echo '<form action="contratar.php" method="post">';
                echo '<input type="hidden" name="aluno" value="' . $row['Aluno'] . '">';
                echo '<input type="hidden" name="aluno_id" value="' . $row['AlunoID'] . '">';
                echo '<input type="hidden" name="vaga_id" value="' . $row['Vaga'] . '">';
                echo '<input type="hidden" name="curso_id" value="' . $row['Curso'] . '">';
                echo '<input type="hidden" name="solicitacao_id" value="' . $row['solicitacao_id'] . '">';
                echo '<input type="submit" name="dados" class="btn btn-primary float-right" value="Contratar">';
                echo '</form>';
                echo '<form action="recusar.php" method="post">';
                echo '<input type="hidden" name="vaga_id" value="' . $row['Vaga'] . '">';
                echo '<input type="hidden" name="solicitacao_id" value="' . $row['solicitacao_id'] . '">';
                echo '<input type="submit" name="recusar" class="btn btn-primary float-right" value="Recusar candidatura">';
                echo '</form>';
                }
                echo '</li>';
            }
        }

        else {
            echo '<a href="vagas.php"><button class="btn">Voltar</button></a><br>';
            echo '<h2>Sem candidaturas para a vaga no momento.</h2>';
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
</style>

</html>