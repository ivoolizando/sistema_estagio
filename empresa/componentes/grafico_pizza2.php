<?php

if (isset($_SESSION['filtroInicio']) && isset($_SESSION['filtroFim'])) {

    $filtroInicio = $_SESSION['filtroInicio'];
    $filtroFim = $_SESSION['filtroFim'];

    $filtroInicio = mysqli_real_escape_string($conn, $filtroInicio);
    $filtroFim = mysqli_real_escape_string($conn, $filtroFim);

    // Gráfico 2 com dados filtrados

    $sql3 = "SELECT COUNT(*) AS total FROM solicitacoes 
    WHERE status = 'pendente' AND
    data_solicitacao >= '$filtroInicio' AND
    data_solicitacao <= '$filtroFim' AND
    empresa_id = ".$_SESSION["id"].";";
    $result3 = mysqli_query($conn, $sql3);

    $sql4 = "SELECT COUNT(*) AS total FROM solicitacoes 
    WHERE status = 'vinculado' AND
    data_solicitacao >= '$filtroInicio' AND
    data_solicitacao <= '$filtroFim' AND
    empresa_id = ".$_SESSION["id"].";";
    $result4 = mysqli_query($conn, $sql4);

    $sql5 = "SELECT COUNT(*) AS total FROM solicitacoes 
    WHERE status = 'despachado' AND
    data_solicitacao >= '$filtroInicio' AND
    empresa_id = ".$_SESSION["id"].";";
    $result5 = mysqli_query($conn, $sql5);

} else {

   // Gráfico 2 sem filtros

   $sql3 = "SELECT COUNT(*) AS total FROM solicitacoes 
   WHERE status = 'pendente' AND
   empresa_id = ".$_SESSION["id"].";";
   $result3 = mysqli_query($conn, $sql3);

   $sql4 = "SELECT COUNT(*) AS total FROM solicitacoes 
   WHERE status = 'vinculado' AND
   empresa_id = ".$_SESSION["id"].";";
   $result4 = mysqli_query($conn, $sql4);

   $sql5 = "SELECT COUNT(*) AS total FROM solicitacoes 
   WHERE status = 'despachado' AND
   empresa_id = ".$_SESSION["id"].";";
   $result5 = mysqli_query($conn, $sql5);
    
}


// Verifique se a consulta retornou algum resultado
if ($result3) {
    $row3 = mysqli_fetch_assoc($result3);
    $candidaturasPendentes = $row3['total'];
}

if ($result4) {
    $row4 = mysqli_fetch_assoc($result4);
    $candidaturasVinculadas = $row4['total']; 
}

if ($result5) {
    $row5 = mysqli_fetch_assoc($result5);
    $candidaturasCanceladas = $row5['total']; 
}

$totalCandidaturas = $candidaturasPendentes + $candidaturasVinculadas + $candidaturasCanceladas;

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
            var data2 = google.visualization.arrayToDataTable([
                ['Solicitações', 'Status de solicitações no período'],
                <?php 
                    if($candidaturasPendentes>0) {
                        echo "['Candidaturas pendentes', ".$candidaturasPendentes."],";
                    }
                    if($candidaturasCanceladas>0) {
                        echo "['Candidaturas canceladas', ".$candidaturasCanceladas."],";
                    }
                    if($candidaturasVinculadas>0) {
                        echo "['Candidaturas vinculadas', ".$candidaturasVinculadas."],";
                    }                
                ?>
            ]);

            var options2 = {
                title: 'Gráfico de Status de Solicitações: (Total <?=$totalCandidaturas?>)',
                pieHole: 0.4,
                legend: {
                    position: 'left',
                    alignment: 'center',
                    orientation: 'horizontal',
                },
                colors: ['orange', 'red', 'green'],
            };

            var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
            chart2.draw(data2, options2);
        }
        
    </script>
</head>

</html>