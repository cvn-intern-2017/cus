function addNewRecord(data){
  var dataObject = {
       'original_link' : (data.original_link.length > 64)?(data.original_link.substr(0,64)+'...'):data.original_link,
       'shorten_link'  : 'http://cus.dev.cybozu.xyz/' + data.key_url
  };
  var result = localStorage.getItem('Data');
  if(result){
    result = ([dataObject]).concat(JSON.parse(result));
    localStorage.setItem('Data',JSON.stringify(result));
  }
  else{
    result = [dataObject];
    localStorage.setItem('Data',JSON.stringify(result));
  }
}

function printRecords(){
  var result = localStorage.getItem('Data');
  var lengthStorage = (JSON.parse(result).length > 5) ? 5 : JSON.parse(result).length ;
  for(var i = 0; i < lengthStorage; i++){
     var originallink = JSON.parse(result)[i].original_link;
     var shortenlink = JSON.parse(result)[i].shorten_link;
     var content = document.getElementById('tbody');
     var record = '<tr><td width="50%">'+originallink+'</td><td><a target="_blank" href="'+shortenlink+'">'+shortenlink+'</a></td><td class="centered"><a target="_blank" href="'+shortenlink+'+" class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td></tr>';
     content.innerHTML = content.innerHTML + record;
   }
}

function removeOlderRecord(){
  var data = localStorage.getItem('Data');
  if(data.length > 5){
    data = (JSON.parse(data)).slice(0,5);
    localStorage.setItem('Data',JSON.stringify(data));
  }
}

function hasInLocalStorage(data){
  var result = localStorage.getItem('Data');
  var shortenLink = 'http://cus.dev.cybozu.xyz/' + data.key_url;
  if(result === null) {
    return;
  }
  var lengthStorage = (JSON.parse(result).length > 5) ? 5 : JSON.parse(result).length ;
  for(var i = 0; i < lengthStorage; i++){
     var shortenLinkAtStorage = JSON.parse(result)[i].shorten_link;
     if(shortenLink === shortenLinkAtStorage) return true;
   }
   return false;
}
