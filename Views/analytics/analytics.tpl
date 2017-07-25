<style>
.analystic_page{
  padding-top: 2%;
  color: #888;
  display: table;
  font-family: sans-serif;
  height: 100%;
  width: 100%;
}
</style>

<div class="analystic_page">
      <h4>Analytics Data for <a href="#">{$data.short_link}</a></h4>
      <p>Created Date: <b>{$data.created_time}</b></p>
      <p>Original URL: <b><a href="#">{$data.original_link}</a></b></p>
      <p>Total Clicks: <b>{$data.total_click}</b></p>
</div>

<!--



      <p>Chrome: <b>{if isset($data.gg_click)}{$data.gg_click}{/if}</b></p>
      <p>Firefox: <b>{if isset($data.ff_click)}{$data.ff_click}{/if}</b></p>
      <p>Others: <b>{if isset($data.other_click)}{$data.other_click}{/if}</b></p>
-->
