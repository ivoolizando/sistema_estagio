<?php

if (isset($_SESSION['filtroInicio']) && isset($_SESSION['filtroFim'])) {

    $filtroInicio = $_SESSION['filtroInicio'];
    $filtroFim = $_SESSION['filtroFim'];

    $filtroInicio = mysqli_real_escape_string($conn, $filtroInicio);
    $filtroFim = mysqli_real_escape_string($conn, $filtroFim);

    // Gráfico 1 com dados filtrados

    $sql = "SELECT COUNT(*) AS total FROM Vaga 
    WHERE VagaStatus = 1 AND
    DataPeriodoInicio >= '$filtroInicio' AND
    DataPeriodoInicio <= '$filtroFim' AND
    EmpresaID = ".$_SESSION["id"].";";
    $result = mysqli_query($conn, $sql);

    $sql2 = "SELECT COUNT(*) AS total FROM Vaga 
    WHERE VagaStatus = 0 AND
    DataPeriodoInicio >= '$filtroInicio' AND
    DataPeriodoInicio <= '$filtroFim' AND
    EmpresaID = ".$_SESSION["id"].";";
    $result2 = mysqli_query($conn, $sql2);

} else {

    // Gráfico 1 sem filtros

    $sql = "SELECT COUNT(*) AS total FROM Vaga WHERE VagaStatus = 1 AND EmpresaID = ".$_SESSION["id"].";";
    $result = mysqli_query($conn, $sql);

    $sql2 = "SELECT COUNT(*) AS total FROM Vaga WHERE VagaStatus = 0 AND EmpresaID = ".$_SESSION["id"].";";
    $result2 = mysqli_query($conn, $sql2);

    
}



if ($result) {
    $row = mysqli_fetch_assoc($result);
    $VagasAtivas = $row['total']; 
}

if ($result2) {
    $row2 = mysqli_fetch_assoc($result2);
    $VagasInativas = $row2['total'];
}

$totalVagas = $VagasAtivas + $VagasInativas;

?>
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);
        

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Vagas', 'Status de Vagas no período'],
                <?php 
                    if($VagasAtivas>0) {
                        echo "['Vagas Ativas', ".$VagasAtivas."],";
                    }
                    if($VagasInativas>0) {
                        echo "['Vagas Inativas', ".$VagasInativas."],";
                    }
                    ?>
            ]);

            var options = {
                title: 'Gráfico de Status de Vagas: (Total <?=$totalVagas?> Vagas)',
                pieHole: 0.4,
                legend: {
                    position: 'left',
                    alignment: 'center',
                    orientation: 'horizontal',
                },
                colors: ['blue', 'red'],
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
        
    </script>
</head>

</html>