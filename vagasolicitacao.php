<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vaga_id = $_POST['vaga_id'];
    $aluno_id = $_POST['aluno_id']; // Você precisa obter o id do aluno logado

    $sql = "INSERT INTO Solicitacao (vaga_id, aluno_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $vaga_id, $aluno_id);

    if ($stmt->execute()) {
        echo "Solicitação de vaga enviada com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
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
<?php
include("componentes/header.php");
?>

<body>
    <div class="content"></div>
    <ul class="list-group">
    <?php
    $sql = "SELECT * FROM Vaga";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li class="list-group-item"><h4>' . $row['Titulo'] . '</h4><p>' . $row['Descricao'] . '</p>';
        echo '<form method="POST" action="vagasolicitacao.php">';
        echo '<input type="hidden" name="vaga_id" value="' . $row['id'] . '">';
        echo '<input type="hidden" name="aluno_id" value="1">'; // Substitua 1 pelo id do aluno logado
        echo '<button type="submit" class="btn btn-primary float-right">Candidatar-se</button>';
        echo '</form></li>';
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
        margin-bottom: 20px; /* Espaço entre as vagas */
    }

    .list-group-item h4 {
        color: #007bff; /* Cor do título */
        margin-bottom: 10px; /* Espaço entre o título e a descrição */
    }

    .list-group-item p {
        margin-bottom: 10px; /* Espaço entre a descrição e o botão */
    }
</style>

</html>
