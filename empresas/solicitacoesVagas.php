<?php
include("../conexao.php");

// Verifica se a empresa está logada
if(isset($_SESSION['empresa_logada'])) {
    $empresa_id = $_SESSION['empresa_logada'];

    // Consulta para obter todas as solicitações para as vagas da empresa
    $query = $db->query("SELECT * FROM solicitacoes WHERE vaga_id IN (SELECT id FROM vagas WHERE empresa_id = $empresa_id)");
    $solicitacoes = $query->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se a empresa tentou vincular um aluno a uma vaga
    if(isset($_POST['solicitacao_id']) && $_POST['acao'] == 'vincular') {
        $solicitacao_id = $_POST['solicitacao_id'];

        // Atualiza a solicitação para vincular o aluno à vaga
        $sql = "UPDATE solicitacoes SET status = 'vinculado' WHERE id = ?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$solicitacao_id]);
    }

    // Verifica se a empresa tentou recusar uma solicitação
    if(isset($_POST['solicitacao_id']) && $_POST['acao'] == 'recusar') {
        $solicitacao_id = $_POST['solicitacao_id'];

        // Atualiza a solicitação para recusar o aluno
        $sql = "UPDATE solicitacoes SET status = 'recusado' WHERE id = ?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$solicitacao_id]);
    }

    // Verifica se a empresa tentou excluir uma solicitação
    if(isset($_POST['solicitacao_id']) && $_POST['acao'] == 'excluir') {
        $solicitacao_id = $_POST['solicitacao_id'];

        // Exclui a solicitação
        $sql = "DELETE FROM solicitacoes WHERE id = ?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$solicitacao_id]);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Solicitações</title>
</head>
<body>
    <h1>Solicitações</h1>

    <?php foreach($solicitacoes as $solicitacao): ?>
        <div>
            <h2>Solicitação <?php echo $solicitacao['id']; ?></h2>
            <p>Status: <?php echo $solicitacao['status']; ?></p>

            <!-- Formulário para vincular, recusar ou excluir a solicitação -->
            <form method="POST">
                <input type="hidden" name="solicitacao_id" value="<?php echo $solicitacao['id']; ?>">
                <input type="submit" name="acao" value="Vincular">
                <input type="submit" name="acao" value="Recusar">
                <input type="submit" name="acao" value="Excluir">
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
