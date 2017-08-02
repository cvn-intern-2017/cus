<div class="clean100"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
  <div class="col s12">
    <blockquote>
      <p><b>Creation time of the short URL: </b>{$data.createdtime}</p>
      <p>
        <b>Original URL: </b>
        <a target="_blank" href="{$data.originallink}">{$data.originallink}</a>
      </p>
    </blockquote>
    <table>
      <thead>
        <tr>
          {foreach from=$data.alltime key=browser item=num}
            <th>
              {$browser}
            </th>
          {/foreach}
          <th class="grey lighten-2 center-align">Total</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            {foreach from=$data.alltime item=num}
              <td>
                {$num}
              </td>
            {/foreach}
            <td class="grey lighten-2 center-align">{$data.total}</td>
          </tr>
      </tbody>
    </table>
  </div>
</div>

<script>
    google.charts.load('current', {
      packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawMultSeries);
    function drawMultSeries() {
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
</script>
<script>
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
</script>

<script>
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
</script>
<script>

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
</script>
<script>
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
</script>
<script>
  $(document).ready(function(){
    $('select#myTimeFrame').on('change',function(){
        $('#chart_alltime, #chart_day, #chart_twohours, #chart_month, #chart_year').removeClass('hide');
      switch ($("select#myTimeFrame").val()) {
        case "alltime":
          drawMultSeries();

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
<div class="row">
  <div class="col s9">
    <div class="row">
      <div id="chart_alltime"></div>
      <div id="chart_twohours"></div>
      <div id="chart_day"></div>
      <div id="chart_month"></div>
      <div id="chart_year"></div>
    </div>
  </div>
  <div class="col s3 input-field">
    <select id="myTimeFrame">
      <option value="alltime">All Time</option>
      <option value="twohours">Two Hours</option>
      <option value="day">Day ago</option>
      <option value="month">Month</option>
      <option value="year">Year</option>
    </select>
  </div>
</div>
