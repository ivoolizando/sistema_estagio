<?php
// Conexão com o banco de dados
include("../conexao.php");

session_start();
if(!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

// Conectando ao banco de dados
$mysqli = new mysqli('localhost', 'nome_do_usuario', 'senha', 'nome_do_banco_de_dados');

if ($mysqli->connect_error) {
    die('Erro de Conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Buscando os dados do banco de dados
$cursos = $mysqli->query("SELECT * FROM cursos");
$vagas = $mysqli->query("SELECT * FROM vagas");
$empresas = $mysqli->query("SELECT * FROM empresas");
$solicitacoes = $mysqli->query("SELECT * FROM solicitacoes WHERE aluno_id = " . $_SESSION['aluno_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu do Aluno</title>
</head>
<body>
    <header>
        <div>
            <span>Bem-vindo, <?php echo $_SESSION['nome_aluno']; ?>!</span>
            <a href="index.php" onclick="<?php session_destroy(); ?>">Sair</a>
        </div>
    </header>
    <div id="menu">
        <ul>
            <li><a href="#cursos">Cursos</a></li>
            <li><a href="#vagas">Vagas</a></li>
            <li><a href="#empresas">Empresas</a></li>
            <li><a href="#solicitacoes">Solicitações e Relatório de Estágio</a></li>
        </ul>
    </div>
    <div id="conteudo">
        <div id="cursos">
            <h2>Cursos</h2>
            <?php while($curso = $cursos->fetch_assoc()) { ?>
                <p><?php echo $curso['nome']; ?></p>
            <?php } ?>
        </div>
        <div id="vagas">
            <h2>Vagas</h2>
            <?php while($vaga = $vagas->fetch_assoc()) { ?>
                <p><?php echo $vaga['titulo']; ?></p>
            <?php } ?>
        </div>
        <div id="empresas">
            <h2>Empresas</h2>
            <?php while($empresa = $empresas->fetch_assoc()) { ?>
                <p><?php echo $empresa['nome']; ?></p>
            <?php } ?>
        </div>
        <div id="solicitacoes">
            <h2>Solicitações e Relatório de Estágio</h2>
            <?php while($solicitacao = $solicitacoes->fetch_assoc()) { ?>
                <p><?php echo $solicitacao['status']; ?></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
