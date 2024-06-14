<?php
$dataAtual = date('Y-m-d');
session_start();
include("../conexao.php");
$vaga_id = $_POST['vaga_id'];

$sql = "SELECT * FROM Vaga where id ='$vaga_id';";
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);

if ($rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $Titulo = $row['Titulo'];
        $Turno = $row['Turno'];
        $Curso = $row['Curso'];
        $Setor = $row['Setor'];
        $Descricao = $row['Descricao'];
        $DataPeriodoInicio = $row['DataPeriodoInicio'];
        $DataPeriodoFinal = $row['DataPeriodoFinal'];
        $DataEstagioInicio = $row['DataEstagioInicio'];
        $DataEstagioFinal = $row['DataEstagioFinal'];
        $ValorBolsa = $row['ValorBolsa'];
    }
} else {
    echo '<br> <br> <h2>Não há candidaturas disponíveis no momento.</h2>';
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($conn, $_POST['Titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['Descricao']);
    $vaga_id = isset($_POST['vaga_id']) ? mysqli_real_escape_string($conn, $_POST['vaga_id']) : null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vaga</title>
</head>

<body>
    <a href="vagas.php" class="btn btn-primary">Voltar</a>
    <h2>Editar Vaga</h2>

    <form class="content" method="post" action="update.php">

        <label for="">Título:</label>
        <input type="text" name="Titulo" value="<?php echo  $Titulo; ?>" required>

        <label for="">Turno:</label>
        <select class="form-select form-control" name="Turno" required>
            <option value="Manhã" <?php if ($Turno == 'Manhã') {
                                        echo 'selected';
                                    } ?>>Manhã</option>
            <option value="Tarde" <?php if ($Turno == 'Tarde') {
                                        echo 'selected';
                                    } ?>>Tarde</option>
            <option value="Noite" <?php if ($Turno == 'Noite') {
                                        echo 'selected';
                                    } ?>>Noite</option>
        </select><br>

        <label for="">Curso:</label>
        <select class="form-control" name="Curso">
            <?php
            $sql = "SELECT ID, Nome from Curso;";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['ID'] == $Curso) {
                        echo '<option selected value="' . $row['ID'] . '">' . $row['Nome'] . '</option>';
                    } else {
                        echo '<option value="' . $row['ID'] . '">' . $row['Nome'] . '</option>';
                    }
                }
            } else {
                echo '<option selected value ="0">Nenhum curso disponível.</option> ';
            }
            ?>
        </select>

        <label for="">Setor:</label>
        <input type="text" name="Setor" value="<?php echo  $Setor; ?>" required>

        <div class="data">
            <label for="">Periodo inicial:</label>
            <input type="date" name="DataPeriodoInicio" value="<?php echo  $DataPeriodoInicio; ?>" required disabled>

            <label for="">Periodo Final:</label>
            <input type="date" name="DataPeriodoFinal" value="<?php echo  $DataPeriodoFinal; ?>" required disabled>

            <label for="">Inicio do estagio:</label>
            <input type="date" name="DataEstagioInicio" value="<?php echo  $DataEstagioInicio; ?>" min="<?php echo $dataAtual; ?>" required>

            <label for="">Final do estagio:</label>
            <input type="date" name="DataEstagioFinal" value="<?php echo  $DataEstagioFinal; ?>" required>
        </div>

        <label for="">Valor da bolsa:</label>
        <input type="text" id="ValorBolsa" name="ValorBolsa" value="<?php echo $ValorBolsa; ?>" required onkeyup="formatarMoeda(this);">

        <br>
        <label for="">Descrição:</label>
        <textarea name="Descricao" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $Descricao; ?></textarea>

        <input type="hidden" name="vaga_id" value="<?php echo $vaga_id; ?>">
        <input type="submit" value="Atualizar">
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function formatarMoeda(input) {
            let valor = input.value;
            valor = valor.replace(/\D/g, '');
            valor = valor.replace(/(\d)(\d{2})$/, '$1,$2');
            valor = valor.replace(/(?=(\d{3})+(\D))\B/g, '.');
            input.value = 'R$ ' + '' + valor;
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            var dataEstagioInicio = document.querySelector('input[name="DataEstagioInicio"]').value;
            var dataEstagioFinal = document.querySelector('input[name="DataEstagioFinal"]').value;
            var dataAtual = new Date().toISOString().split('T')[0];

            if (dataEstagioInicio < dataAtual) {
                alert("A data de início do estágio não pode ser menor que a data atual.");
                event.preventDefault();
            }

            if (dataEstagioFinal < dataEstagioInicio) {
                alert("A data de término do estágio não pode ser menor que a data de início.");
                event.preventDefault();
            }
        });
        document.querySelector('input[name="DataEstagioInicio"]').addEventListener('change', function() {
            var dataEstagioInicio = this.value;
            var dataEstagioFinalInput = document.querySelector('input[name="DataEstagioFinal"]');
            dataEstagioFinalInput.min = dataEstagioInicio;
            if (dataEstagioFinalInput.value < dataEstagioInicio) {
                dataEstagioFinalInput.value = dataEstagioInicio;
            }
        });
    </script>
</body>

</html>
<style>
    a {
        margin: 20px;
    }

    .data {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    h2 {
        color: #6c757d;
        text-align: center;
        margin-top: 20px;
    }

    form {
        width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #ffffff;
    }

    input[type="text"] {
        width: 100%;
        margin-bottom: 10px;
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 3px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 5px;
        margin-top: 20px;
        border: none;
        border-radius: 3px;
        color: #ffffff;
        background-color: #007bff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #002c5b;
    }

    a {
        background-color: #002c5b;
    }
</style>