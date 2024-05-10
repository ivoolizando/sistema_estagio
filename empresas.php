<?php
// Conexão com o banco de dados
include 'db_connect.php';

// Consulta SQL para obter todas as empresas
$query = "SELECT * FROM empresas";
$result = mysqli_query($conn, $query);

echo "<ul>";

while($row = mysqli_fetch_assoc($result)) {
    echo "<li><a href='detalhes_empresa.php?id=".$row['id']."'>".$row['nome']."</a></li>";
}

echo "</ul>";
?>

<?php
// Conexão com o banco de dados
include 'db_connect.php';

// Obter o ID da empresa da URL
$empresa_id = $_GET['id'];

// Consulta SQL para obter detalhes da empresa
$query = "SELECT * FROM empresas WHERE id = $empresa_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo "<h1>".$row['nome']."</h1>";
echo "<p>Email: ".$row['email']."</p>";
echo "<p>CNPJ: ".$row['cnpj']."</p>";
echo "<p>Horário de Funcionamento: ".$row['horario_funcionamento']."</p>";
echo "<p>Telefone: ".$row['telefone']."</p>";

echo "<a href='cursos.php?id=".$row['id']."'>Ver Cursos Oferecidos</a>";
?>
