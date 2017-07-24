<div class="maintenance">
      <h1>Analytics Page</h1>
      <p>Created Date: <b>{$data.created_time}</b></p>
      <p>Original URL: <b>{$data.original_link}</b></p>
      <p>Total Clicks: <b>{$data.total_click}</b></p>

      <p>Chrome: <b>{if isset($data.gg_click)}{$data.gg_click}{/if}</b></p>
      <p>Firefox: <b>{if isset($data.ff_click)}{$data.ff_click}{/if}</b></p>
      <p>Others: <b>{if isset($data.other_click)}{$data.other_click}{/if}</b></p>
</div>
