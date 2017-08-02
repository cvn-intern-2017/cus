<script>
    google.charts.load('current', {
      packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(alltime);
    function alltime() {
      var data = google.visualization.arrayToDataTable([
        ['Browser', 'Clicked Time'],
        {foreach from=$data.alltime key=browser item=num}
            ['{$browser}', {$num}],
        {/foreach}
      ]);

      var options = {
        title: 'Analytic Browser All Time',
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

      var chart = new google.visualization.BarChart(document.getElementById('chart_alltime'));
      chart.draw(data, options);
    }

    function twohours() {
      var data = google.visualization.arrayToDataTable([
        ['Browser', 'Clicked Time'],
        {foreach from=$data.twohours key=browser item=num}
            ['{$browser}', {$num}],
        {/foreach}
      ]);

      var options = {
        title: 'Analytic Browser 2 hours',
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

      var chart = new google.visualization.BarChart(document.getElementById('chart_twohours'));
      chart.draw(data, options);
    }

    function day(){
      var data = google.visualization.arrayToDataTable([
        ['Browser', 'Clicked Time'],
        {foreach from=$data.day key=browser item=num}
            ['{$browser}', {$num}],
        {/foreach}

      ]);

      var options = {
        title: 'Analytic Browser Day',
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

      var chart = new google.visualization.BarChart(document.getElementById('chart_day'));
      chart.draw(data, options);
    }


    function month(){
      var data = google.visualization.arrayToDataTable([
        ['Browser', 'Clicked Time'],
        {foreach from=$data.month key=browser item=num}
            ['{$browser}', {$num}],
        {/foreach}

      ]);

      var options = {
        title: 'Analytic Browser Month',
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

      var chart = new google.visualization.BarChart(document.getElementById('chart_month'));
      chart.draw(data, options);
    }

    function year(){
      var data = google.visualization.arrayToDataTable([
        ['Browser', 'Clicked Time'],
        {foreach from=$data.year key=browser item=num}
            ['{$browser}', {$num}],
        {/foreach}

      ]);

      var options = {
        title: 'Analytic Browser Year',
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

      var chart = new google.visualization.BarChart(document.getElementById('chart_year'));
      chart.draw(data, options);
    }

      $(document).ready(function(){
        $('select#myTimeFrame').on('change',function(){
            $('#chart_alltime, #chart_day, #chart_twohours, #chart_month, #chart_year').removeClass('hide');
          switch ($("select#myTimeFrame").val()) {
            case "alltime":
              alltime();
              $('#chart_day, #chart_twohours, #chart_month, #chart_year').addClass('hide');
              break;
            case "twohours":
              twohours();
              $('#chart_alltime, #chart_day, #chart_month, #chart_year').addClass('hide');
              break;
            case "day":
              day();
              $('#chart_alltime, #chart_twohours, #chart_month, #chart_year').addClass('hide');
              break;
            case "month":
              month();
              $('#chart_alltime, #chart_day, #chart_twohours, #chart_year').addClass('hide');
              break;
            default:
              year();
              $('#chart_alltime, #chart_day, #chart_twohours, #chart_month').addClass('hide');
          }
        });
      });
</script>
