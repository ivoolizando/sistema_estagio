<?php

/*tabela vagas para as vagas de estágio e uma tabela solicitacoes para as solicitações dos alunos.
Quando um aluno se candidata a uma vaga, uma nova entrada é criada na tabela solicitacoes. Quando uma empresa vincula um aluno a uma vaga, o status da solicitação é atualizado para ‘vinculado’*/

// Conexão com o banco de dados
$db = new PDO('mysql:host=localhost;dbname=seu_banco_de_dados;charset=utf8', 'usuario', 'senha');

// Consulta para obter todas as vagas de estágio
$query = $db->query("SELECT * FROM vagas");
$vagas = $query->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o usuário está logado e tentou se candidatar a uma vaga
if(isset($_SESSION['usuario_logado']) && isset($_POST['vaga_id'])) {
    $vaga_id = $_POST['vaga_id'];
    $aluno_id = $_SESSION['usuario_logado'];

    // Insere uma nova solicitação na tabela de solicitações
    $sql = "INSERT INTO solicitacoes (vaga_id, aluno_id) VALUES (?, ?)";
    $stmt= $db->prepare($sql);
    $stmt->execute([$vaga_id, $aluno_id]);
}

// Verifica se o perfil empresa está logado e tentou vincular um aluno a uma vaga
if(isset($_SESSION['empresa_logada']) && isset($_POST['solicitacao_id'])) {
    $solicitacao_id = $_POST['solicitacao_id'];

    // Atualiza a solicitação para vincular o aluno à vaga
    $sql = "UPDATE solicitacoes SET status = 'vinculado' WHERE id = ?";
    $stmt= $db->prepare($sql);
    $stmt->execute([$solicitacao_id]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vagas de Estágio</title>
</head>
<body>
    <h1>Vagas de Estágio</h1>

    <?php foreach($vagas as $vaga): ?>
        <div>
            <h2><?php echo $vaga['titulo']; ?></h2>
            <p><?php echo $vaga['descricao']; ?></p>

            <!-- Formulário para se candidatar à vaga -->
            <form method="POST">
                <input type="hidden" name="vaga_id" value="<?php echo $vaga['id']; ?>">
                <input type="submit" value="Candidatar-se à vaga">
            </form>
        </div>
    <?php endforeach; ?>
</body>

</html>


