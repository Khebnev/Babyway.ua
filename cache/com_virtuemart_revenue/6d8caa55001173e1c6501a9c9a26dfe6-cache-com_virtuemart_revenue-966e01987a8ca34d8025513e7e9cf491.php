<?php die("Access Denied"); ?>#x#a:2:{s:6:"result";a:2:{s:6:"report";a:0:{}s:2:"js";s:1434:"
  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['День', 'Заказы', 'Всего продано', 'Чистая прибыль'], ['2020-10-22', 0,0,0], ['2020-10-23', 0,0,0], ['2020-10-24', 0,0,0], ['2020-10-25', 0,0,0], ['2020-10-26', 0,0,0], ['2020-10-27', 0,0,0], ['2020-10-28', 0,0,0], ['2020-10-29', 0,0,0], ['2020-10-30', 0,0,0], ['2020-10-31', 0,0,0], ['2020-11-01', 0,0,0], ['2020-11-02', 0,0,0], ['2020-11-03', 0,0,0], ['2020-11-04', 0,0,0], ['2020-11-05', 0,0,0], ['2020-11-06', 0,0,0], ['2020-11-07', 0,0,0], ['2020-11-08', 0,0,0], ['2020-11-09', 0,0,0], ['2020-11-10', 0,0,0], ['2020-11-11', 0,0,0], ['2020-11-12', 0,0,0], ['2020-11-13', 0,0,0], ['2020-11-14', 0,0,0], ['2020-11-15', 0,0,0], ['2020-11-16', 0,0,0], ['2020-11-17', 0,0,0], ['2020-11-18', 0,0,0], ['2020-11-19', 0,0,0]  ]);
        var options = {
          title: 'Отчет за период с 22.10.2020 по 20.11.2020',
            series: {0: {targetAxisIndex:0},
                   1:{targetAxisIndex:0},
                   2:{targetAxisIndex:1},
                  },
                  colors: ["#00A1DF", "#A4CA37","#E66A0A"],
        };

        var chart = new google.visualization.LineChart(document.getElementById('vm_stats_chart'));

        chart.draw(data, options);
      }
";}s:6:"output";s:0:"";}