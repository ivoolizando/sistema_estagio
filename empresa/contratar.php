<?php
session_start();
include("../conexao.php");
include("componentes/header.php");
$alunoId = $_POST['aluno_id'];
$vaga_id = $_POST['vaga_id'];
$curso = $_POST['curso_id'];
$solicitacao_id = $_POST['solicitacao_id'];
$empresa = $_SESSION['id'];
$data_atual = date_create()->format('Y-m-d');
$sql = "SELECT 
Vaga.Titulo as Vaga_titulo,
Vaga.Turno as Vaga_turno,
Vaga.Setor as Vaga_setor,
Vaga.Curso as Curso,
Vaga.DataPeriodoInicio as Vaga_periodo_inicio, 
Vaga.DataPeriodoFinal as Vaga_periodo_final,
Vaga.DataEstagioInicio as Estagio_inicio,
Vaga.DataEstagioFinal as Estagio_final, 
Vaga.ValorBolsa as Valor, 
Vaga.Descricao as Descricao,
Aluno.ID as Aluno
FROM Vaga inner join Aluno WHERE Vaga.ID = " . $vaga_id . ";";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $titulo = $row['Vaga_titulo'];
        $curso = $row['Curso'];
        $turno = $row['Vaga_turno'];
        $setor = $row['Vaga_setor'];
        $periodo_inicio = $row['Vaga_periodo_inicio'];
        $periodo_final = $row['Vaga_periodo_final'];
        $estagio_inicio = $row['Estagio_inicio'];
        $estagio_final = $row['Estagio_final'];
        $valor = $row['Valor'];
        $aluno = $row['Aluno'];
        $descricao = $row['Descricao'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contratacao'])) {
    $sqlInsert = "INSERT INTO Contratado
    (
        EmpresaID,
        AlunoID,
        VagaID,
        Curso,
        Setor,
        Turno,
        DataPeriodoInicio,
        DataPeriodoFinal,
        DataEstagioInicio,
        DataEstagioFinal,
        DataContratacao,
        ValorBolsa
    ) 
    VALUES (
        '$empresa',
        '$alunoId',
        '$vaga_id',
        '$curso',
        '$setor',
        '$turno',
        '$periodo_inicio',
        '$periodo_final',
        '$estagio_inicio',
        '$estagio_final',
        '$data_atual',
        '$valor'
    )";

    $sqlSolicitacao = 'update solicitacoes set status ="vinculado" where id =' . $solicitacao_id
        . ';';
    $resultsolicitacao = mysqli_query($conn, $sqlSolicitacao);


    if ($conn->query($sqlInsert) === TRUE) {
        $_SESSION['mensagem'] = 'Contrato realizado com sucesso!';
        header('Location: contratos.php');
        exit();
    } else {
        echo "Erro: " . $sqlInsert . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <form class="content" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label> Título:</label>
        <input type="text" value="<?php echo $titulo ?>">
        <label>Curso:</label>
        <select class="form-control" disabled name="curso_id">
            <?php
            $sqlcurso = "SELECT ID, Nome from Curso where ID = '$curso'";
            $resultcurso = mysqli_query($conn, $sqlcurso);
            $rowcurso = mysqli_fetch_assoc($resultcurso);
            echo '<option selected value="' . $rowcurso['ID'] . '">' . $rowcurso['Nome'] . '</option>';

            ?>
        </select>
        <label>Turno:</label>
        <input type="text" disabled value="<?php echo $turno ?>">
        <label>Setor:</label>
        <input type="text" value="<?php echo $setor ?>">
        <div class="calendario">
            <label>Período de Seleção Inicial:</label>
            <input type="date" value="<?php echo $periodo_inicio ?>" disabled>
            <label>Período de Seleção Final:</label>
            <input type="date" value="<?php echo $periodo_final ?>" disabled>
            <label>Período de Estágio Inicial:</label>
            <input type="date" value="<?php echo $estagio_inicio ?>">
            <label>Período de Estágio Final:</label>
            <input type="date" value="<?php echo $estagio_final ?>">
        </div>

        <label> Valor da Bolsa: </label>
        <input type="number" value="<?php echo $valor ?>">
        <br>
        <label>Descrição:</label>
        <textarea class="area"><?= $descricao ?></textarea>

        <input type="hidden" name="aluno_id" value="<?php echo $alunoId ?>">
        <input type="hidden" name="vaga_id" value="<?php echo $vaga_id ?>">
        <input type="hidden" name="curso_id" value="<?php echo $curso ?>">
        <input type="hidden" name="solicitacao_id" value="<?php echo $solicitacao_id ?>">

        <input --bs-primary type="submit" name="contratacao">
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
<style>
    textarea {
        width: 100%;
    }

    body {
        font-family: Arial, sans-serif;
    }

    h2 {
        color: #333;
        TEXT-ALIGN: center;
    }

    .content {
        background-color: #f8f8f8;
        margin: 0 auto;
        padding: 20px;
        width: 600px;
        border-radius: 8px;
    }

    input[type="submit"] {
        width: 100%;
        background-color: #007BFF;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #002c5b;
    }

    .calendario {
        display: flex;
        flex-direction: column;
        padding: 20px 0px;
    }
</style>
<?php
$conn->close();
?>