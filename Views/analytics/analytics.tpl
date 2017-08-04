<div class="clean100"></div>
<div class="row">
  <div class="col s12">
    <blockquote>
      <p><b>Creation time of the short URL: </b>{$data.createdtime}</p>
      <p>
        <b>Original URL: </b>
        <a target="_blank" href="{$data.originallink}">{substr($data.originallink,0,127)|cat:'...'}</a>
      </p>
    </blockquote>
  {if isset($data.alltime)}
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
  {/if}
  </div>
</div>
{if isset($data.alltime)}
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="{$pathPublic}js/drawchart.js"></script>
  <script>
    var arrDataAllTime = [['Browser', 'Clicked Time']];
    var arrDataTwoHours = [['Browser', 'Clicked Time']];
    var arrDataDay = [['Browser', 'Clicked Time']];
    var arrDataMonth = [['Browser', 'Clicked Time']];
    var arrDataYear = [['Browser', 'Clicked Time']];
    {foreach from = $data.alltime key = browser item = num}
        arrDataAllTime.push(['{$browser}', {$num}]);
    {/foreach}
    {foreach from = $data.twohours key = browser item = num}
        arrDataTwoHours.push(['{$browser}', {$num}]);
    {/foreach}
    {foreach from = $data.day key = browser item = num}
        arrDataDay.push(['{$browser}', {$num}]);
    {/foreach}
    {foreach from = $data.month key = browser item = num}
        arrDataMonth.push(['{$browser}', {$num}]);
    {/foreach}
    {foreach from = $data.year key = browser item = num}
        arrDataYear.push(['{$browser}', {$num}]);
    {/foreach}

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
  </script>
  <div class="row">
    <div class="col s9">
      <div class="row" id="chart" style="min-height:500px;">
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
{else}
  <div class="row">
    <div class="col s12">
      <blockquote>
        <h6 class="grey-text">Nobody accessed this shorten URL</h6>
      </blockquote>
    </div>
  </div>
{/if}
