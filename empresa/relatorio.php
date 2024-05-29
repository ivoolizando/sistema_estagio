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
</head>
<?php 
include('componentes/header.php');
?>
<body>
    <div class="d-flex w-auto">
    <form class="content" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for=""> Data Início: </label>
    <input class="form-control" <?php if(isset($_SESSION['filtroInicio'])) { echo 'value="'.$_SESSION['filtroInicio'].'"'; }?> name="filtroInicio" type="date"><br>
    <label for=""> Data Final: </label>
    <input class="form-control" <?php if(isset($_SESSION['filtroFim'])) { echo 'value="'.$_SESSION['filtroFim'].'"'; }?> name="filtroFim" type="date">
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