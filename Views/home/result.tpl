
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
<script type="text/javascript">
  function saveLink(){
    var dataObject = {
        'original_link' : "{substr($data->original_link,0,63)|cat: ' ...'}",
        'shorten_link'  : "{#domain#}{$data->key_url}"
    };
    var data = localStorage.getItem('Data');
    if(data){
      data = JSON.parse(data).concat([dataObject]);
      localStorage.setItem('Data',JSON.stringify(data));
    }
    else {
      data = [dataObject];
      localStorage.setItem('Data',JSON.stringify(data));
    }
  }
  if({$data}){
    saveLink();
  }
</script>
