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
          <td width="50%">{substr($data->original_link,0,63)|cat: ' ...'}</td>
          <td><a target="_blank" href="{#DOMAIN#}{$data->key_url}">{#domain#}{$data->key_url}</a></td>
          <td class="centered"><a target="_blank" href="{#domain#}{$data->key_url}+" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- <script>
window.onload(function()){
  localStorage.clear();
});
</script> -->
<script type="text/javascript">
var dataObject = {
    'original_link' : "{substr($data->original_link,0,63)|cat: ' ...'}",
    'shorten_link'  : "{#domain#}{$data->key_url}"
};
var data = localStorage.getItem('Data');
if(data){
//  console.log(JSON.parse(data));
  //console.log("NONE");
  data = ([dataObject]).concat(JSON.parse(data));
  localStorage.setItem('Data',JSON.stringify(data));
}
else {
  data = [dataObject];
  localStorage.setItem('Data',JSON.stringify(data));
}
var result = localStorage.getItem('Data');
//console.log(JSON.parse(result));
// localStorage.clear();
var len = data.length;

// localStorage.clear();
for(var i = 1; i < len; i++){
  if(i === 5){
    console.log(JSON.parse(result)[5]);
  }
   var originallink = JSON.parse(result)[i].original_link;
   var shortenlink = JSON.parse(result)[i].shorten_link;
   var content = document.getElementById('tbody');
   var record = '<tr><td width="50%">'+originallink+'</td><td><a target="_blank" href="'+shortenlink+'">'+shortenlink+'</a></td><td class="centered"><a target="_blank" href="'+shortenlink+'+" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td></tr>';
   content.innerHTML = content.innerHTML + record;
 }
  console.log(len);
  console.log(JSON.parse(result));
  if (len > 5){
    for(var i = len-1; i > 5; i-- ){
      JSON.parse(result).pop();
      console.log(JSON.parse(result));
      console.log('lon hon 5');
    }
  }
</script>
