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
    <title>Vagas</title>
</head>
<?php
include("componentes/header.php");
?>

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
    <div class="content"></div>
    <ul class="list-group">
        <?php
        $usuario = $_SESSION['id'];
        $sql = "SELECT *
        FROM Vaga
        WHERE VagaStatus = true and ID NOT IN (SELECT vaga_id FROM solicitacoes);";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li class="list-group-item"><h4>' . $row['Titulo'] . '</h4><p>' . $row['Descricao'] . '</p>';
                echo '<form action="candidatura.php" method="post">';
                echo '<input type="hidden" name="vagaId" value="' . $row['ID'] . '">';
                echo '<input type="hidden" name="usuarioId" value="' . $usuario . '">';
                echo '<input type="submit" class="btn btn-primary float-right" value="Candidatar-se">';
                echo '</form></li>';
            }
        }
        else{
        echo '<br> <br> <h2>Não há vagas disponíveis no momento.</h2>';
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