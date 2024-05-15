<?php
session_start();
include("../conexao.php");

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
    <style>
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
            width: 300px;
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
            border: none;
            border-radius: 3px;
            color: #ffffff;
            background-color: #007bff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vaga</title>
</head>

<body>
    <h2>EDITAR VAGA</h2>

    <form method="post" action="update.php">
        Título: <input type="text" name="Titulo" value="<?php echo $titulo; ?>" required>
        <br>
        Descrição: <input type="text" name="Descricao" value="<?php echo $descricao; ?>" required>
        <br>
        <input type="hidden" name="vaga_id" value="<?php echo $vaga_id; ?>">
        <input type="submit" value="Atualizar">
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
