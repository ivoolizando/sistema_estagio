<?php
// Conexão com o banco de dados
require 'conexao.php';

// Supondo que o aluno esteja logado e seu ID seja $id_aluno
$id_aluno = $_SESSION['id_aluno'];

// Consulta ao banco de dados
$aluno = $pdo->query("SELECT * FROM Alunos WHERE id_aluno = $id_aluno")->fetch();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil do Aluno</title>
    <!-- Adicione seu CSS aqui -->
</head>
<body>
    <div id="sidebar">
        <ul>
            <li><a href="relatorio_estagio.php">Relatório de Estágio</a></li>
            <li><a href="vagas.php">Vagas</a></li>
            <!-- Adicione mais links conforme necessário -->
        </ul>
    </div>

    <div id="main">
        <h1>Perfil do Aluno</h1>
        <p>Nome: <?php echo $aluno['nome_aluno']; ?></p>
        <p>Email: <?php echo $aluno['email_aluno']; ?></p>
        <!-- Adicione mais informações conforme necessário -->
    </div>
</body>
</html>
