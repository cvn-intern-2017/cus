<div class="clean100"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
  <div class="col s12">
    <blockquote>
      <p><b>Creation time of the short URL: </b>2017-07-31 09:26:20</p>
      <p>
        <b>Original URL: </b>
        <a target="_blank" href="https://github.com/cvn-intern-2017/cus/wiki/Specification:-Feature-3---Chart">https://github.com/cvn-intern-2017/cus/wiki/Specification:-Feature-3---Chart</a>
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
        ['Browser', 'Clicked Time', {
          role: 'style'
        }],
        {foreach from=$data.alltime key=browser item=num}
            ['{$browser}', {$num}, '#29b6f6'],
        {/foreach}
      ]);

      var options = {
        title: 'Analytic Browser All Time',
        chartArea: {
          width: '50%'
        },
        hAxis: {
          title: '',
          minValue: 0
        },
        vAxis: {
          title: 'All Time',
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
    google.charts.load('current', {
      packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawMultSeries);
    function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Browser', 'Clicked Time', {
          role: 'style'
        }],
        {foreach from=$data.twohours key=browser item=num}
            ['{$browser}', {$num}, '#29b6f6'],
        {/foreach}
      ]);

      var options = {
        title: 'Analytic Browser 2 hours',
        chartArea: {
          width: '50%'
        },
        hAxis: {
          title: '2 hours',
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
    google.charts.load('current', {
      packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawMultSeries);
    function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Browser', 'Clicked Time', {
          role: 'style'
        }],
        {foreach from=$data.day key=browser item=num}
            ['{$browser}', {$num}, '#29b6f6'],
        {/foreach}

      ]);

      var options = {
        title: 'Analytic Browser Day',
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
  $(document).ready(function(){
    $('select#myTimeFrame').on('change',function(){
      $('#chart_alltime, #chart_day, #chart_twohours').addClass('hide');
      var timeFrame = $("select#myTimeFrame").val();
      console.log(timeFrame);
      $('#chart_'+timeFrame).removeClass('hide');
    });
  });
</script>
<div class="row">
  <div class="col s9">
    <div class="row">
      <div id="chart_alltime" class="col s12" style="height:500px"></div>
      <div id="chart_twohours" class="col s12" style="height:500px"></div>
      <div id="chart_day" class="col s12" style="height:500px"></div>
    </div>
  </div>
  <div class="col s3 input-field">
    <select id="myTimeFrame">
      <option value="All" selected disabled>All Chart</option>
      <option value="alltime">All Time</option>
      <option value="twohours">Two Hours</option>
      <option value="day">Day ago</option>
    </select>
  </div>
</div>
