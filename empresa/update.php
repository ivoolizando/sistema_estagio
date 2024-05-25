<?php
session_start();
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Titulo = mysqli_real_escape_string($conn, $_POST['Titulo']);
    $Turno = mysqli_real_escape_string($conn, $_POST['Turno']);
    $Curso = mysqli_real_escape_string($conn, $_POST['Curso']);
    $Setor = mysqli_real_escape_string($conn, $_POST['Setor']);
    $DataEstagioInicio = mysqli_real_escape_string($conn, $_POST['DataEstagioInicio']);
    $DataEstagioFinal = mysqli_real_escape_string($conn, $_POST['DataEstagioFinal']);
    $ValorBolsa = mysqli_real_escape_string($conn, $_POST['ValorBolsa']);
    $Descricao = mysqli_real_escape_string($conn, $_POST['Descricao']);
    $vaga_id = isset($_POST['vaga_id']) ? mysqli_real_escape_string($conn, $_POST['vaga_id']) : null;
    

    $ValorBolsa_clean = preg_replace('/[^\d,]/', '', $ValorBolsa);
    $ValorBolsa_form = str_replace(',', '.', $ValorBolsa_clean);
    $ValorBolsa_form = number_format((float)$ValorBolsa_form, 2, '.', '');

    if ($vaga_id) {
        $sql = "UPDATE Vaga 
        SET 
        Titulo = '$Titulo',
        Turno = '$Turno',
        Curso = '$Curso',
        Setor = '$Setor',
        DataEstagioInicio = '$DataEstagioInicio',
        DataEstagioFinal = '$DataEstagioFinal',
        ValorBolsa = '$ValorBolsa_form',
        Descricao = '$Descricao'
        WHERE ID = '$vaga_id';";
        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>
                alert('Vaga atualizada com sucesso!".$ValorBolsa_form."');
                window.location.href = 'vagas.php';
              </script>";
        }

        else {
            echo "<script type='text/javascript'>
            alert('Ocorreu um erro ao atualizar a Vaga.');
            window.location.href = 'vagas.php';
            </script>";
        }
    }
} else {
    echo "<script type='text/javascript'>
    alert('Ocorreu um erro ao atualizar a Vaga.');
    window.location.href = 'vagas.php';
    </script>";
    }

?>