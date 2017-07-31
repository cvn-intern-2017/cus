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
