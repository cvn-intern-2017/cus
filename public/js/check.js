

function checkURL(){
  var txtInputUrl     = document.getElementById('input_url');
  var valueInputUrl   = txtInputUrl.value;
  var hostname = extractHostname(valueInputUrl);
  if(valueInputUrl == ''){
    document.getElementById("error_client").innerHTML = 'Please input your link';
    return false;
  }
  if(validateURLType(valueInputUrl) && isWhiteSpaceURL(valueInputUrl) == false && isCharacterUTF8(valueInputUrl) == false && isCheckCharacter(hostname) == false){
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
  return inputURL.test(value.trim());
}

function isCharacterUTF8(value){
  for (var i = 0, n = value.length; i < n; i++){
    if (value.charCodeAt( i ) > 127){
      return true;
    }
  }
  return false;
}
function isCheckCharacter(value){
  for (var i = 0; i < value.length; i++){
    if (value.charCodeAt(i) > 90 && value.charCodeAt(i) < 97){
      return true;
    }
  }
  return false;
}
function extractHostname(value){
  var hostname;
    //find & remove protocol (http, ftp, etc.) and get hostname
  if(value.indexOf("://") > -1){
    hostname = value.split('/')[2];
  }
  else{
    hostname = value.split('/')[0];
  }
    //find & remove port number
  hostname = hostname.split(':')[0];
    //find & remove "?"
  hostname = hostname.split('?')[0];
  return hostname;
}
