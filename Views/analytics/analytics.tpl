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
{include file="Views/analytics/drawchart.tpl"}
{*
{literal}
<script>
var a = new alltime();
var data = $data;
alltime.run(data);
</script>
{/literal}
*}
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
