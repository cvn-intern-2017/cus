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
      bar:{
        groupWidth: "70%",
      }
    };
    var chart = new google.visualization.BarChart(document.getElementById('chart_' + timeFrame));
    chart.draw(data, options);
  }
}

var arrDataAllTime = [['Browser', 'Clicked Time']];
var arrDataTwoHours = [['Browser', 'Clicked Time']];
var arrDataDay = [['Browser', 'Clicked Time']];
var arrDataMonth = [['Browser', 'Clicked Time']];
var arrDataYear = [['Browser', 'Clicked Time']];

function sendDataToJs(objDataTimeFrame,timeFrame){
  var values = Object.values(objDataTimeFrame);
  var keys = Object.keys(objDataTimeFrame);

  switch (timeFrame) {
    case 'all':
      for (var i = 0; i < values.length; i++) {
        arrDataAllTime.push([keys[i],values[i]]);
      }
      break;
    case '2hours':
      for (var i = 0; i < values.length; i++) {
        arrDataTwoHours.push([keys[i],values[i]]);
      }
      break;
    case 'day':
      for (var i = 0; i < values.length; i++) {
        arrDataDay.push([keys[i],values[i]]);
      }
      break;
    case 'month':
      for (var i = 0; i < values.length; i++) {
        arrDataMonth.push([keys[i],values[i]]);
      }
      break;
    case 'year':
      for (var i = 0; i < values.length; i++) {
        arrDataYear.push([keys[i],values[i]]);
      }
      break;
  }
}

$(document).ready(function(){
  draw('alltime',arrDataAllTime);
  $('#chart_day, #chart_twohours, #chart_month, #chart_year').addClass('hide');
  $('select#myTimeFrame').on('change',function(){
    $('#chart_alltime, #chart_day, #chart_twohours, #chart_month, #chart_year').removeClass('hide');
    switch ($("select#myTimeFrame").val()) {
      case "alltime":
        draw('alltime',arrDataAllTime);
        $('#chart_day, #chart_twohours, #chart_month, #chart_year').addClass('hide');
        break;
      case "twohours":
        draw('twohours',arrDataTwoHours);
        $('#chart_alltime, #chart_day, #chart_month, #chart_year').addClass('hide');
        break;
      case "day":
        draw('day',arrDataDay);
        $('#chart_alltime, #chart_twohours, #chart_month, #chart_year').addClass('hide');
        break;
      case "month":
        draw('month',arrDataMonth);
        $('#chart_alltime, #chart_day, #chart_twohours, #chart_year').addClass('hide');
        break;
      case "year":
        draw('year',arrDataYear);
        $('#chart_alltime, #chart_day, #chart_twohours, #chart_month').addClass('hide');
    }
  });
});
