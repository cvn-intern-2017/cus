function draw(timeFrame,array){
  google.charts.load('current', {
    packages: ['corechart', 'bar']
  });
  google.charts.setOnLoadCallback(drawchart);
  function drawchart(){
    var data = google.visualization.arrayToDataTable(array);
    var options = {
      title: 'Analytic Browser ' + timeFrame,
      colors: ['#29b6f6'],
      chartArea: {
        width: '50%'
      },
      hAxis: {
        title: '',
        minValue: 0
      },
      vAxis: {
        title: '',
      },
      bar: {
        groupWidth: "70%",
      }
    };

    var chart = new google.visualization.BarChart(document.getElementById('chart_' + timeFrame));
    chart.draw(data, options);
  }
}
