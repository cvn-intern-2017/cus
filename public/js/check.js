

function check(){
  var txtInputUrl     = document.getElementById('input_url');
  var valueInputUrl   = txtInputUrl.value;
  var flagTrueOrFalse = false;
  if(valueInputUrl == ''){
    document.getElementById("error_client").innerHTML = 'Please input your link';
    return false;
  }
  if(validateURLType(valueInputUrl) && isWhiteSpaceURL(valueInputUrl) == false && isCharacterUTF8(valueInputUrl) == false){
    if(valueInputUrl.length >= 65234){
      document.getElementById("error_client").innerHTML = 'Make sure the URL is less than 65234 characters';
      return false;
    }
    else{
      return true;
    }
  }
  else{
    document.getElementById("error_client").innerHTML = 'Invalid URL';
    return false;
  }
}

function validateURLType(value){
  var result = value.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
  if(result == null){
    return false;
  }
  else{
    return true;
  }
}
function isWhiteSpaceURL(value){
  var inputURL = new RegExp(" ");
  return inputURL.test(value.trim()); // true neu co khoang trang, false neu khong co
}

function isCharacterUTF8(value){
  for (var i = 0, n = value.length; i < n; i++) {
       if (value.charCodeAt( i ) > 127) { return true; }
   }
   return false;
}
/*
$(document).ready(function(){
  // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
  //add được record trong url table mới hiển thị popup
  $('#modal1').modal();
});
*/
