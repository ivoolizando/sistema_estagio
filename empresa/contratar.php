<?php
include("../conexao.php");
include("componentes/header.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alunoId = $_POST['aluno_id'];

    $sql = "SELECT Aluno.Nome as Aluno, Aluno.Email as EmailAluno, Vaga.Titulo as Vaga 
    FROM Aluno 
    INNER JOIN solicitacoes ON Aluno.ID = solicitacoes.aluno_id 
    INNER JOIN Vaga ON solicitacoes.vaga_id = Vaga.ID
    WHERE Aluno.ID = ".$alunoId.";";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    echo '<h2>Informações do Aluno Contratado</h2>';
    echo '<p>Nome: ' . $row['Aluno'] . '</p>';
    echo '<p>Email: ' . $row['EmailAluno'] . '</p>';
    echo '<p>Vaga: ' . $row['Vaga'] . '</p>';
}
?>

    
</body>
</html>