<?php

if (isset($_SESSION['filtroInicio']) && isset($_SESSION['filtroFim'])) {

    $filtroInicio = $_SESSION['filtroInicio'];
    $filtroFim = $_SESSION['filtroFim'];

    $filtroInicio = mysqli_real_escape_string($conn, $filtroInicio);
    $filtroFim = mysqli_real_escape_string($conn, $filtroFim);

    // Gráfico 3 com dados filtrados

    $sql6 = "SELECT DISTINCT Curso.Nome as Curso, COUNT(*) AS Quantidade
    FROM Contratado inner join Curso on Contratado.Curso = Curso.ID WHERE
    DataContratacao >= '$filtroInicio' AND
    DataContratacao <= '$filtroFim' AND
    EmpresaID = ".$_SESSION["id"]."
    GROUP BY Curso;";
    $result6 = mysqli_query($conn, $sql6);

} else {

   // Gráfico 3 sem filtros

   $sql6 = "SELECT DISTINCT Curso.Nome as Curso, COUNT(*) AS Quantidade
   FROM Contratado inner join Curso on Contratado.Curso = Curso.ID WHERE EmpresaID = ".$_SESSION["id"]."
   GROUP BY Curso;";
   $result6 = mysqli_query($conn, $sql6);
    
}

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
            <?php $totalContratos = 0; ?>
            var data3 = google.visualization.arrayToDataTable([
                ['Contratos', 'Contratos da empresa por Cursos'],
                <?php
                    if ($result6) {
                        while ($row = mysqli_fetch_assoc($result6)) {
                            if($row['Quantidade']>0) {
                                $totalContratos = $totalContratos + $row['Quantidade'];
                                echo "['Contratos de ".$row['Curso']."', ".$row['Quantidade']."],";
                            }
                        }
                    }  
                ?>
            ]);

            var options3 = {
                title: 'Gráfico de Cursos dos Contratos: (Total <?=$totalContratos?>)',
                pieHole: 0.4,
                legend: {
                    position: 'left',
                    alignment: 'center',
                    orientation: 'horizontal',
                },
                colors: ['blue', 'purple', 'green'],
            };

            var chart3 = new google.visualization.PieChart(document.getElementById('donutchart3'));
            chart3.draw(data3, options3);
        }
        
    </script>
</head>

</html>