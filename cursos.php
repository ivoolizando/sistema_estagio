<?php
// Conexão com o banco de dados
$db = new PDO('mysql:host=localhost;dbname=seu_banco_de_dados;charset=utf8', 'usuario', 'senha');

// Consulta para obter todos os cursos
$query = $db->query("SELECT * FROM cursos");
$cursos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cursos Disponíveis</title>
</head>
<body>
    <h1>Cursos Disponíveis</h1>

    <?php foreach($cursos as $curso): ?>
        <div>
            <h2><a href="vagas.php?curso=<?php echo $curso['id']; ?>"><?php echo $curso['nome']; ?></a></h2>
            <!-- Adicione outras informações do curso conforme necessário -->
        </div>
    <?php endforeach; ?>
</body>
</html>
