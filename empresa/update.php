<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($conn, $_POST['Titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['Descricao']);
    $vaga_id = isset($_POST['vaga_id']) ? mysqli_real_escape_string($conn, $_POST['vaga_id']) : null;

    // Se vaga_id for definido, vai atualizar o registro no bd
    if ($vaga_id) {
        $sql = "UPDATE Vaga SET Titulo = '$titulo', Descricao = '$descricao' WHERE ID = '$vaga_id';";
        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>
                alert('Vaga atualizada com sucesso!');
                window.location.href = 'vagas.php';
              </script>";
        }
    }
} else {
    $vaga_id = isset($_SESSION['vaga_id']) ? $_SESSION['vaga_id'] : null;
    if ($vaga_id) {
        $sql = "SELECT * FROM Vaga WHERE ID = '$vaga_id';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $titulo = $row['Titulo'];
        $descricao = $row['Descricao'];
    }
}
?>