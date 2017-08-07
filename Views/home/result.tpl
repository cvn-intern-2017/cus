
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
      <tbody id ="tbody">
        <tr>
          <td width="50%">{if $data->original_link|count_characters >64} {substr($data->original_link,0,63)|cat: ' ...'}{else}{$data->original_link}{/if}</td>
          <td><a target="_blank" href="{#DOMAIN#}{$data->key_url}">{#domain#}{$data->key_url}</a></td>
          <td class="centered"><a target="_blank" href="{#domain#}{$data->key_url}+" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
var dataObject = {
    'original_link' : "{if $data->original_link|count_characters > 64} {substr($data->original_link,0,63)|cat: '...'}{else}{$data->original_link}{/if}",
    'shorten_link'  : "{#domain#}{$data->key_url}"
};
var data = localStorage.getItem('Data');
if(data){
  data = ([dataObject]).concat(JSON.parse(data));
  localStorage.setItem('Data',JSON.stringify(data));
}
else{
  data = [dataObject];
  localStorage.setItem('Data',JSON.stringify(data));
}
var result = localStorage.getItem('Data');
var lenghtStorage = data.length;
for(var i = 1; i < 5; i++){
  // if(i === 5){
  //   console.log(JSON.parse(result)[5]);
  // }
   var originallink = JSON.parse(result)[i].original_link;
   var shortenlink = JSON.parse(result)[i].shorten_link;
   var content = document.getElementById('tbody');
   var record = '<tr><td width="50%">'+originallink+'</td><td><a target="_blank" href="'+shortenlink+'">'+shortenlink+'</a></td><td class="centered"><a target="_blank" href="'+shortenlink+'+" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td></tr>';
   content.innerHTML = content.innerHTML + record;
 }
  console.log(lenghtStorage);
  console.log(JSON.parse(result));
</script>
