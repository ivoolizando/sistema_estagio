<?php
session_start();
include("../conexao.php");
include("componentes/header.php");
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dados'])) {
    $alunoid = $_POST['aluno_id'];
    $aluno = $_POST['aluno'];
    $vaga = $_POST['vaga'];
    $usuario = $_SESSION['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contratacao'])) {
    $bolsa = $_POST["bolsa"];
    $carga = $_POST["carga"];
    $setor = $_POST["setor"];
    $supervisor = $_POST["supervisor"];
    $datainicio = $_POST["datainicio"];
    $datafim = date("Y-m-d", strtotime($datainicio . " +1 year"));
    $alunoid = $_POST['aluno_id'];
    $aluno = $_POST['aluno'];
    $vaga = $_POST['vaga'];
    $usuario = $_SESSION['id'];

    if (true) {

        $sql = "INSERT INTO Contrato (Bolsa, Carga, DataInicio, DataFim, Setor, Supervisor, Vaga, AlunoID, EmpresaID)
  VALUES ($bolsa, $carga, '$datainicio', '$datafim','$setor','$supervisor', '$vaga', $alunoid, $usuario)";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
                alert('Contrato realizado com sucesso!');
                window.location.href = 'vagas.php';
              </script>";
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } elseif (false) {
        echo "<script type='text/javascript'>
                alert('Senhas não são iguais!');
                window.location.href = 'cadastroAluno.php';
              </script>";

        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
            TEXT-ALIGN: center;
        }

        form {
            background-color: #f8f8f8;
            margin: 0 auto;
            padding: 20px;
            width: 600px;
            border-radius: 8px;
        }

        input[type="password"],
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
            background-color: #45a049;
        }
    </style>

</head>

<body>

    <?php
    $alunoid = $_POST['aluno_id'];
    $aluno = $_POST['aluno'];
    $vaga = $_POST['vaga'];
    $usuario = $_SESSION['id'];
    echo '<br><h2>Formulário de contrato do Aluno ' . $aluno . ' para a Vaga ' . $vaga . '</h2><br>';
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        Remuneração/Bolsa: <input type="number" name="bolsa">
        <br><br>
        Carga Horária: <input type="number" name="carga">
        <br><br>
        Setor: <input type="text" name="setor">
        <br>
        Supervisor: <input type="text" name="supervisor">
        <br>
        Data Início: <input type="date" name="datainicio">
        <br>
        <br>
        <?php
        echo '<input type="hidden" name="aluno" value="' . $aluno . '">';
        echo '<input type="hidden" name="aluno_id" value="' . $alunoid . '">';
        echo '<input type="hidden" name="vaga" value="' . $vaga . '">';
        ?>
        <input --bs-primary type="submit" name="contratacao">
    </form>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>