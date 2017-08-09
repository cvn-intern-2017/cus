
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
for(var i = 0; i < 5; i++){
   var originallink = JSON.parse(result)[i].original_link;
   var shortenlink = JSON.parse(result)[i].shorten_link;
   var content = document.getElementById('tbody');
   var record = '<tr><td width="50%">'+originallink+'</td><td><a target="_blank" href="'+shortenlink+'">'+shortenlink+'</a></td><td class="centered"><a target="_blank" href="'+shortenlink+'+" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td></tr>';
   content.innerHTML = content.innerHTML + record;
 }
 data = localStorage.getItem('Data');
 if(data.length > 5){
   data = (JSON.parse(data)).slice(0,5);
   localStorage.setItem('Data',JSON.stringify(data));
 }

</script>
