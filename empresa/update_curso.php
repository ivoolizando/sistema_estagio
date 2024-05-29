<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($conn, $_POST['Titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['Descricao']);
    $curso_id = isset($_POST['curso_id']) ? mysqli_real_escape_string($conn, $_POST['curso_id']) : null;
    $video = mysqli_real_escape_string($conn, $_POST['Video']);

    
    if ($curso_id) {
        $sql = "UPDATE Curso SET Nome = '$titulo', Descricao = '$descricao', Video = '$video' WHERE ID = '$curso_id';";
        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>
                alert('Curso Atualizado com sucesso!');
                window.location.href = 'cursos.php';
              </script>";
        }
    }
} else {
    $cursos_id = isset($_SESSION['cursos_id']) ? $_SESSION['cursos_id'] : null;
    if ($cursos_id) {
        $sql = "SELECT * FROM Curso WHERE ID = '$cursos_id';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $titulo = $row['Titulo'];
        $descricao = $row['Descricao'];
        $video = $row['Video'];
    }
}
?>