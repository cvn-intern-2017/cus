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
  <script type="text/javascript" src="{$pathPublic}js/loader.js"></script>
  <script src="{$pathPublic}js/drawchart.js"></script>

  <script>
  var dataAllTimeObj = {$data.alltime|@json_encode};
  sendDataToJs(dataAllTimeObj,'all');

  var dataTwoHoursObj = {$data.twohours|@json_encode};
  sendDataToJs(dataTwoHoursObj,'2hours');

  var dataDayObj = {$data.day|@json_encode};
  sendDataToJs(dataDayObj,'day');

  var dataMonthObj = {$data.month|@json_encode};
  sendDataToJs(dataMonthObj,'month');

  var dataYearObj = {$data.year|@json_encode};
  sendDataToJs(dataYearObj,'year');
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
