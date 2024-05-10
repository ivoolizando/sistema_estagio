<?php
// Conexão com o banco de dados
$host = 'localhost';
$db   = 'nome_do_banco_de_dados';
$user = 'usuario';
$pass = 'senha';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

// Consulta para buscar todos os alunos
$stmt = $pdo->query('SELECT * FROM alunos');
$alunos = $stmt->fetchAll();

// Exibindo os alunos
echo '<h1>Alunos</h1>';
echo '<ul>';
foreach ($alunos as $aluno) {
    echo '<li>';
    echo '<a href="detalhes_aluno.php?id=' . $aluno['id'] . '">' . $aluno['nome'] . '</a>';
    echo '</li>';
}
echo '</ul>';
?>

<?php
// Conexão com o banco de dados
$host = 'localhost';
$db   = 'nome_do_banco_de_dados';
$user = 'usuario';
$pass = 'senha';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

// Consulta para buscar o aluno pelo ID
$stmt = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
$stmt->execute([ $_GET['id'] ]);
$aluno = $stmt->fetch();

// Exibindo os detalhes do aluno
echo '<h1>Detalhes do Aluno</h1>';
echo 'Nome: ' . $aluno['nome'] . '<br>';
echo 'Telefone: ' . $aluno['telefone'] . '<br>';
echo 'Email: ' . $aluno['email'] . '<br>';


/*Por favor, substitua 'nome_do_banco_de_dados', 'usuario' e 'senha' pelos detalhes do seu banco de dados. Além disso, certifique-se de que as tabelas e colunas correspondam ao seu esquema de banco de dados. Este código é um exemplo simples e não inclui autenticação ou sanitização de entrada, que são extremamente importantes em um ambiente de produção. Recomendo fortemente que você implemente esses recursos antes de usar este código em um ambiente de produção.*/
?>
