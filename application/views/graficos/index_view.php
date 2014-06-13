<html>
  <head>
    <title>Ejemplo Google Chart And Codeigniter</title>
    <meta charset="utf-8" />
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        
      google.load("visualization", "1", {packages:["corechart"]});
        //Funcion para generar un gráfico Pastel
      function PieChart(){
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(<?= $grafico1;?>);

        var options = {'title':'Cantidad De Frutas Que Se Vendieron',
                       'width':600,
                       'height':350,
                       is3D: true,
                        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
      //Funcion para generar un gráfico en Barras
      function BarChart() {
        var data = google.visualization.arrayToDataTable(<?= $grafico2;?>);

        var options = {
          title: 'Cantidad De Frutas Que Se Vendieron',
          vAxis: {title: 'Frutas',  titleTextStyle: {color: 'blue'}}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      //Funcion para generar un gráfico en Lineas
      function LineChart() {
        var data = google.visualization.arrayToDataTable(<?= $grafico2;?>);

        var options = {
          title: 'Cantidad De Frutas Que Se Vendieron'
        };

        var chart = new google.visualization.LineChart(document.getElementById('linechart_div'));
        chart.draw(data, options);
      }
        
        google.setOnLoadCallback(PieChart);
        google.setOnLoadCallback(BarChart);
        google.setOnLoadCallback(LineChart);  
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="piechart"></div>
    <div id="chart_div"></div>
    <div id="linechart_div"></div>
  </body>
</html>