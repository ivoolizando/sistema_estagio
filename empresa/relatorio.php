<?php
include('../conexao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filtroData'])) {
    $_SESSION['filtroInicio'] = $_POST['filtroInicio'];
    $_SESSION['filtroFim'] = $_POST['filtroFim'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fecharFiltro'])) {
    unset($_SESSION['filtroInicio']);
    unset($_SESSION['filtroFim']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<?php
include('componentes/header.php');
?>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    h2 {
        color: #333;
        TEXT-ALIGN: center;
    }

    .list-group {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .list-group-item {
        width: 600px;
    }

    .content {
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
        background-color: #002c5b;
    }

    button[type="submit"]:hover {
        background-color: #002c5b;
    }
</style>

<body>
    <div class="d-flex w-auto">
        <form class="content" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for=""> Data Início: </label>
            <input class="form-control" <?php if (isset($_SESSION['filtroInicio'])) {
                                            echo 'value="' . $_SESSION['filtroInicio'] . '"';
                                        } ?> name="filtroInicio" type="date"><br>
            <label for=""> Data Final: </label>
            <input class="form-control" <?php if (isset($_SESSION['filtroFim'])) {
                                            echo 'value="' . $_SESSION['filtroFim'] . '"';
                                        } ?> name="filtroFim" type="date">
            <input --bs-primary type="submit" name="filtroData">
            <input --bs-primary style="background-color: red;" type="submit" value="Remover filtros" name="fecharFiltro">
        </form>
    </div>

    <?php
    include('componentes/grafico_pizza.php');
    include('componentes/grafico_pizza2.php');
    include('componentes/grafico_pizza3.php');
    ?>
    <div class="d-flex justify-content-between">
        <div id="donutchart" style="width: 600px; height: 400px;"></div>
        <div id="donutchart2" style="width: 600px; height: 400px;"></div>
        <div id="donutchart3" style="width: 600px; height: 400px;"></div>
    </div>

</body>

</html>