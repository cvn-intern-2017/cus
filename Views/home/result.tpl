<div class="row">
  <div class="col s12">
    <div class="clean100"></div>
    <table>
      <thead>
        <tr>
          <th width="50%">Original Link</th>
          <th>Shorten Link</th>
          <th>Analytics Data</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="50%">{substr($data->original_link,0,63)|cat: ' ...'}</td>
          <td><a target="_blank" href="{#DOMAIN#}{$data->key_url}">{#domain#}{$data->key_url}</a></td>
          <td class="centered"><a target="_blank" href="{#domain#}{$data->key_url}+" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
